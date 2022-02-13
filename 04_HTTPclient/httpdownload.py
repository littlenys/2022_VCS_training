# importing the modules
from email import header
import socket
from bs4 import BeautifulSoup
import argparse
from PIL import Image
from io import BytesIO
parser = argparse.ArgumentParser(description='')
parser.add_argument('--url', help='url của trang web định lấy ảnh', 
                    default='http://blogtest.vnprogramming.com/')
parser.add_argument('--remotefile', help='url của ảnh định lấy',
                    default='/wp-content/uploads/2022/02/test-42.jpg')
parser.add_argument('--savepath', help='vị trí lưu',
                    default='C:/Users/Admin/Downloads')
def recvall(s):
    buf = b''
    chunk = s.recv(1024)
    while len(chunk) != 0:
        buf += chunk
        chunk = s.recv(1024)
    return buf

def dowload_image(url,imageurl, savepath):
    HOST = url.split("://")[1]
    HOST = HOST.strip('/')
    PORT = 80
    PATH = imageurl

    payload = (f"GET {PATH} HTTP/1.1\r\n"
                f"Host: {HOST}\r\n\r\n")

    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.connect((HOST,PORT))
        s.sendall(payload.encode())
        data = recvall(s)
    image_bytes = data.split(b"\r\n\r\n")[1]
    #image = Image.open(BytesIO(image_bytes))
    #image.show()
    image_name = imageurl.split("/")[-1]
    with open( savepath + "/" + image_name, 'wb') as file:
        file.write(image_bytes)
    soup = BeautifulSoup(data[0:512], 'html.parser').text
    if '200' in soup:
        ContentLength = soup.split('Content-Length')[1].split('\n')[0]
        print(f'Kích thước file ảnh {ContentLength}' )
    else:
        print("Không tồn tại file ảnh ")
        

def main(args):
    imageurl = args.remotefile
    url = args.url
    savepath = args.savepath
    dowload_image(url, imageurl, savepath)

if __name__ == '__main__':
    args = parser.parse_args()
    main(args)


