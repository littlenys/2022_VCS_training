header = b'POST /wp-admin/media-new.php HTTP/1.1\r\nHost: blogtest.vnprogramming.com\r\nUser-Agent: python-requests/2.26.0\r\nAccept-Encoding: gzip, deflate\r\nAccept: */*\r\nConnection: keep-alive\r\nCookie: wordpress_d7c4b57758996eecc679e353d09e6969=test%7C1644847253%7CloQTDL2837g0ptiz0YbVc5UUgsdV9bofEDhwJqRFLqq%7C7d28b6c07678fc07f3e3e0478963c48722fc9030206df5d9ee2b1e88a92a8fc1; wordpress_logged_in_d7c4b57758996eecc679e353d09e6969=test%7C1644847253%7CloQTDL2837g0ptiz0YbVc5UUgsdV9bofEDhwJqRFLqq%7Ce0359902b699f2e65ed92012a853f06fd240effad6f20da038081d745f38b948; wordpress_test_cookie=WP%20Cookie%20check; wp-settings-2=uploader%3D1; wp-settings-time-2=1644674453\r\nContent-Length: 678\r\nContent-Type: multipart/form-data; boundary=ffbb975d4909b7ee4b6641a85b65f288\r\n\r\n'
content = b'--ffbb975d4909b7ee4b6641a85b65f288\r\nContent-Disposition: form-data; name="post_id"\r\n\r\n0\r\n--ffbb975d4909b7ee4b6641a85b65f288\r\nContent-Disposition: form-data; name="_wp_http_referer"\r\n\r\n/wp-admin/media-new.php\r\n--ffbb975d4909b7ee4b6641a85b65f288\r\nContent-Disposition: form-data; name="_wpnonce"\r\n\r\nc1bed48065\r\n--ffbb975d4909b7ee4b6641a85b65f288\r\nContent-Disposition: form-data; name="action"\r\n\r\nupload_attachement\r\n--ffbb975d4909b7ee4b6641a85b65f288\r\nContent-Disposition: form-data; name="html-upload"\r\n\r\nUpload\r\n--ffbb975d4909b7ee4b6641a85b65f288\r\nContent-Disposition: form-data; name="async-upload"; filename="test.txt"\r\n\r\nc\xc3\xb2n c\xc3\xa1i n\xe1\xbb\x8bt\r\n--ffbb975d4909b7ee4b6641a85b65f288--\r\n'

print(header.decode())
print(content.decode())
import base64

with open("D:/test.jpg", "rb") as imageFile:
    str = base64.b64encode(imageFile.read())
    print(str)