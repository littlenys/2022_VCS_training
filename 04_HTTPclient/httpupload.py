import socket
import os
import argparse
import re
import json
import mimetypes
from random import sample
from string import ascii_letters, digits

parser = argparse.ArgumentParser(description='')
parser.add_argument('--url', help='url của trang web định lấy title',
                    default='http://blogtest.vnprogramming.com')
parser.add_argument('--localfile', help='vị trí file để upload',
                    default='D:/test.jpg')
parser.add_argument('--user', help='tên đăng nhập',
                    default='test')
parser.add_argument('--password', help='mật khẩu',
                    default='test123QWE@AD')

def get_cookie(respone):
    header_recv = respone.split(b"\r\n\r\n")[0].decode().splitlines()
    cookie_list = []
    for line in header_recv:
        if line[:10] == "Location: ":
            break
        if line[:12] == "Set-Cookie: " in line:
            cookie_list.append(re.split(";|\\s", line)[1])
    cookie = "; ".join(cookie_list)
    return cookie

def gen_mutipart_header(POST, HOST, cookies, boundary, length):
    return (    f'POST {POST} HTTP/1.1\r\n'
                f'Host: {HOST}\r\n'
                f'Accept-Encoding: gzip, deflate\r\n'
                f'Accept: */*\r\n'
                f'Connection: keep-alive\r\n'
                f'Cookie: {cookies}\r\n'
                f'Content-Length: {length}\r\n'
                f'Content-Type: multipart/form-data; boundary={boundary}\r\n\r\n')

def gen_header_get(POST,HOST,cookies):
    return (    f'GET {POST} HTTP/1.1\r\n'
                f'Cookie: {cookies}\r\n'
                f'Host: {HOST}\r\n\r\n'
                )

def recvall(s):
    buf = b''
    chunk = s.recv(1024)
    while len(chunk) != 0:
        buf += chunk
        chunk = s.recv(1024)
    return buf

def gen_boundary():
    return ''.join(sample(ascii_letters + digits,32))

def login(HOST, PORT, user, password):
    PATH = "/wp-login.php"
    data = (    f"log={user}"
                f"&pwd={password}"
                f"&wp-submit=Log+In"
                f"&redirect_to=http%3A%2F%2Fblogtest.vnprogramming.com%2Fwp-admin%2F"
                f"&testcookie=1")
    header = (  f"POST {PATH} HTTP/1.1\r\n"
                f"Host: {HOST}\r\n"
                f"Connection: keep-alive\r\n"
                f"Content-Length: {len(data)}\r\n"
                f"Content-Type: application/x-www-form-urlencoded\r\n"
                f"Cookie: wordpress_test_cookie=WP%20Cookie%20check; wp_lang=en_US\r\n\r\n" )
    request = header + data
    cookies = ""
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.connect((HOST, PORT))
        s.sendall(request.encode())
        receive_header = s.recv(2048)
        if 'HTTP/1.1 302 Found' in receive_header.decode(): 
            cookies = get_cookie(receive_header)
            return cookies
        else:
            print("Login failed")
            return None
    

def get_wpnonce(HOST, PORT, cookies):
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.connect((HOST, PORT))
        header = gen_header_get("/wp-admin/media-new.php/",HOST,cookies)
        s.sendall(header.encode())
        receive = recvall(s)
        html = receive.decode()
        re_wpnonce = re.search('name="_wpnonce" value="[\w\d]{10}"', html)
        wpnonce = str(re_wpnonce).split("\"")[3]
    return wpnonce

def upload_image(HOST, PORT, cookies, wpnonce, localfile):
    filename = localfile.split('/')[-1]
    mimetype = mimetypes.MimeTypes().guess_type(localfile)
    image = open(localfile, 'rb').read()

    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.connect((HOST, PORT))
        boundary = gen_boundary()
        content = (
            f"--{boundary}\r\n"
            f'Content-Disposition: form-data; name="post_id"\r\n\r\n'

            f'0\r\n'
            f"--{boundary}\r\n"
            f'Content-Disposition: form-data; name="_wp_http_referer"\r\n\r\n'

            f'/wp-admin/media-new.php\r\n'
            f"--{boundary}\r\n"
            f'Content-Disposition: form-data; name="_wpnonce"\r\n\r\n'

            f"{wpnonce}\r\n"
            f"--{boundary}\r\n"
            f'Content-Disposition: form-data; name="action"\r\n\r\n'

            f'upload_attachement\r\n'
            f"--{boundary}\r\n"
            f'Content-Disposition: form-data; name="html-upload"\r\n\r\n'

            f'Upload\r\n'
            f"--{boundary}\r\n"
            f'Content-Disposition: form-data; name="async-upload"; filename="{filename}"\r\n'
            f'Content-Type: {mimetype}\r\n\r\n'
        )
        end = f"\r\n--{boundary}--"
        all_content = content.encode() + image + end.encode()
        header = gen_mutipart_header("/wp-admin/media-new.php", HOST, cookies, boundary, len(all_content) )
        request = header.encode() + all_content
        s.sendall(request)
        response = recvall(s).decode()

        try:
            attachment_id = re.search('X-WP-Upload-Attachment-ID: \d+', response).group().split(': ')[1]
            print('Upload success.')
            return attachment_id
        except:
            print('Upload failed')
            return None

def get_image_url(HOST, PORT, cookies, attachment_id  ):
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        boundary = gen_boundary()
        content = f'--{boundary}\r\nContent-Disposition: form-data; name=\"action\"\r\n\r\nquery-attachments\r\n--{boundary}\r\nContent-Disposition: form-data; name=\"post_id\"\r\n\r\n0\r\n--{boundary}\r\nContent-Disposition: form-data; name=\"query[orderby]\"\r\n\r\ndate\r\n{boundary}\r\nContent-Disposition: form-data; name=\"query[order]\"\r\n\r\nDESC\r\n--{boundary}\r\nContent-Disposition: form-data; name=\"query[posts_per_page]\"\r\n\r\n10\r\n--{boundary}\r\nContent-Disposition: form-data; name=\"query[paged]\"\r\n\r\n1\r\n--{boundary}--'
        header = gen_mutipart_header("/wp-admin/admin-ajax.php", HOST, cookies, boundary, len(content) )
        request = header.encode() + content.encode()
        try:
            s.connect((HOST, PORT))
            s.sendall(request)
            response = recvall(s).decode('utf-8')
            json_data = re.search('\{[\s\S]*\}', response).group()
            data = json.loads(json_data)
            if data['success'] == True:
                list_item = data['data']
                item = list(filter(lambda x: (str(x['id']) == attachment_id), list_item))[0]
                attachment_url = item['url']
                print('File upload url: ', attachment_url)
            return attachment_url
        except:
            print('error when get list media uploaded')
            return None

def main(args):
    str_url = args.url
    user = args.user
    password = args.password
    localfile = args.localfile
    if (os.path.exists(localfile)):
        HOST = str_url.split("://")[1].split("/")[0] #"blogtest.vnprogramming.com"
        PORT = 80
        cookies = login(HOST, PORT, user, password)
        if (cookies != None): #If success login
            wpnonce = get_wpnonce(HOST, PORT, cookies)
            attachment_id = upload_image(HOST, PORT, cookies, wpnonce, localfile)
            url = get_image_url(HOST, PORT, cookies, attachment_id)
    else:
        print("localfile does not exist")

if __name__ == '__main__':
    args = parser.parse_args()
    main(args)