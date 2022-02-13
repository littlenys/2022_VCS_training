import sys
import socket

HOST = "blogtest.vnprogramming.com"
PORT = 80
PATH = "/wp-login.php"
user = 'test'
password = 'test123QWE@AD'
data = (    f"log={user}"
            f"&pwd={password}"
            f"&wp-submit=Log+In"
            f"&redirect_to=http%3A%2F%2Fblogtest.vnprogramming.com%2Fwp-admin%2F"
            f"&testcookie=1")
header = (  f"POST /wp-login.php HTTP/1.1\r\n"
            f"Host: blogtest.vnprogramming.com\r\n"
            f"Connection: keep-alive\r\n"
            f"Content-Length: 124\r\n"
            f"Content-Type: application/x-www-form-urlencoded\r\n"
            f"Cookie: wordpress_test_cookie=WP%20Cookie%20check; wp_lang=en_US\r\n\r\n" )
request = header + data
with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
    s.connect((HOST, PORT))
    s.sendall(request.encode())
    data = s.recv(1024)
    print(data)
