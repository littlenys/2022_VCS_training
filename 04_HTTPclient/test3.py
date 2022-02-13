# importing the modules
import socket
import argparse
import re

parser = argparse.ArgumentParser(description='')
parser.add_argument('--url', help='url của trang web định lấy title',
                    default='http://blogtest.vnprogramming.com/wp-login.php')
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

def login(url, user, password, localfile):
        HOST = url.split("://")[1].split("/")[0] #"blogtest.vnprogramming.com"
        PORT = 80
        PATH = url.split(HOST)[1] #/wp-login.php

        data = (    f"log={user}"
                    f"&pwd={password}"
                    f"&wp-submit=Log+In"
                    f"&redirect_to=http%3A%2F%2Fblogtest.vnprogramming.com%2Fwp-admin%2F"
                    f"&testcookie=1")
        header = (  f"POST {PATH} HTTP/1.1\r\n"
                    f"Host: {HOST}\r\n"
                    f"Connection: keep-alive\r\n"
                    f"Content-Length: 124\r\n"
                    f"Content-Type: application/x-www-form-urlencoded\r\n"
                    f"Cookie: wordpress_test_cookie=WP%20Cookie%20check; wp_lang=en_US\r\n\r\n" )
        request = header + data
        with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
            s.connect((HOST, PORT))
            s.sendall(request.encode())
            receive_header = s.recv(1024)

            if '302' in receive_header.decode():
                print('User '+ user + ' đăng nhập thành công')

                #Get cookie
                cookies = get_cookie(receive_header)

                header = (  f"GET /wp-admin/media-new.php HTTP/1.1\r\n"
                    f"Host: {HOST}\r\n"
                    f"Connection: keep-alive\r\n"
                    f"Content-Length: 37173\r\n"
                    f"Content-Type: multipart/form-data; boundary=b1d68dc7df134170324ad348c4161521\r\n\r\n"
                    f"Cookie: {cookies}\r\n\r\n" )

                image = (f"async-upload:('test.jpg', {open(localfile, 'rb')})")
                print(header)
                # upload image
                dataupload = (
                        f"post_id : 0\r\n"
                        f"_wp_http_referer: /wp-admin/media-new.php\r\n"
                        f"_wpnonce: nonce\r\n"
                        f"action: upload_attachement\r\n"
                        f"html-upload: Upload\r\n\r\n")
                
                request = header
                s.sendall(request.encode())
                data = s.recv(1024)
                print(data)
            else:
                print('User '+ user+' đăng nhập thất bại')


        

def main(args):
    str_url = args.url
    user = args.user
    password = args.password
    localfile = args.localfile
    login(str_url, user, password, localfile)

if __name__ == '__main__':
    args = parser.parse_args()
    main(args)


'''
POST /wp-admin/media-new.php HTTP/1.1
Host: blogtest.vnprogramming.com
Connection: keep-alive
Content-Length: 436963
Cache-Control: max-age=0
Upgrade-Insecure-Requests: 1
Origin: http://blogtest.vnprogramming.com
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryIvegDIXlkrl1Za74
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Referer: http://blogtest.vnprogramming.com/wp-admin/media-new.php
Accept-Encoding: gzip, deflate
Accept-Language: vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7
Cookie: wordpress_d7c4b57758996eecc679e353d09e6969=test%7C1644594026%7CfIByupPjQDpGe6P6yqttMhCfdIBRL3EFrU2JZTsyCei%7C444d00a49ea3245766055a7eca290f3dab8bc7b71983fd70053bbf5a7cc8b895; wordpress_test_cookie=WP%20Cookie%20check; wp_lang=en_US; wordpress_logged_in_d7c4b57758996eecc679e353d09e6969=test%7C1644594026%7CfIByupPjQDpGe6P6yqttMhCfdIBRL3EFrU2JZTsyCei%7C39965e70560e194f3cf0ec6c86dea4f696224bee95296c9ad5fdce7fd3da7f14; wp-settings-time-2=1644432788; wp-settings-2=uploader%3D1

'''
