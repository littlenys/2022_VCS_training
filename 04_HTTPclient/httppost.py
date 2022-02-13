# importing the modules
from email import header
import socket
import argparse

parser = argparse.ArgumentParser(description='')
parser.add_argument('--url', help='url của trang web định lấy title', 
                    default='http://blogtest.vnprogramming.com/wp-login.php')
parser.add_argument('--user', help='tên đăng nhập', 
                    default='test')
parser.add_argument('--password', help='mật khẩu', 
                    default='test123QWE@AD')

def login(url, user, password):
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
            data = s.recv(1024)
            #print(data.decode())
            if 'HTTP/1.1 302 Found' in data.decode(): 
                print('User '+ user + ' đăng nhập thành công')
            else:
                print('User '+ user+' đăng nhập thất bại')

def main(args):
    str_url = args.url
    user = args.user
    password = args.password
    login(str_url, user, password)

if __name__ == '__main__':
    args = parser.parse_args()
    main(args)


