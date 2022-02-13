# importing the modules
import socket
from bs4 import BeautifulSoup
import argparse
parser = argparse.ArgumentParser(description='')
parser.add_argument('--url', help='url của trang web định lấy title', default='http://blogtest.vnprogramming.com/')

def get_title(url):
    HOST = url.split("://")[1].split('/')[0] #"blogtest.vnprogramming.com"
    PORT = 80
    PATH = url.split(HOST)[1]

    payload = (f"GET {PATH} HTTP/1.1\r\n"
                f"Host: {HOST}\r\n\r\n")

    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.connect((HOST,PORT))
        s.sendall(payload.encode())
        data = s.recv(1024)

    soup = BeautifulSoup(data, 'html.parser')
    print(f"Title: {soup.title.string}")

def main(args):
    str_url = args.url
    get_title(str_url)

if __name__ == '__main__':
    args = parser.parse_args()
    main(args)


