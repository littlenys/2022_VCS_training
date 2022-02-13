import requests
import re
import sys
f = 'D:/test.txt'
user='test'
password='test123QWE@AD'
url1='http://blogtest.vnprogramming.com/wp-login.php'
url2='http://blogtest.vnprogramming.com/wp-admin/media-new.php'
headerauth= {
        'Cookie':'wordpress_test_cookie=WP Cookie check; ROUTEID=.1',
        'Content-Type': 'application/x-www-form-urlencoded'
        }
dataauth = {
        'log':user,
        'pwd':password,
        'wp-submit':'Log In',
        'redirect_to': url2,
        'testcookie': 1
        }
image = {'async-upload':('test.txt', open(f, "rb"))}
session1=requests.session()
session1.get(url1)
r1 = session1.post(url1, headers=headerauth, data=dataauth)

test = re.search('value="[0-9a-z]{10}"', r1.text)
nonce = re.search('[0-9a-z]{10}', test.group(0))
nonce = nonce.group(0)

dataupload = {
        'post_id': '0',
        '_wp_http_referer': '/wp-admin/media-new.php',
        '_wpnonce': nonce ,
        'action': 'upload_attachement',
        'html-upload': 'Upload',
        }

import textwrap
import requests

def print_roundtrip(response, *args, **kwargs):
    format_headers = lambda d: '\n'.join(f'{k}: {v}' for k, v in d.items())
    print(textwrap.dedent('''
        ---------------- request ----------------
        {req.method} {req.url}
        {reqhdrs}

        {req.body}
    ''').format(
        req=response.request, 
        res=response, 
        reqhdrs=format_headers(response.request.headers), 
        reshdrs=format_headers(response.headers), 
    ))
import requests
import http.client as httplib

def patch_send():
    old_send= httplib.HTTPConnection.send
    def new_send( self, data ):
        print(data)
        return old_send(self, data) #return is not necessary, but never hurts, in case the library is changed
    httplib.HTTPConnection.send= new_send

patch_send()
r3 = session1.post(url2, data=dataupload, files=image, hooks={'response': print_roundtrip})
title = re.search('\<title\>.+<\/title\>', r3.text)
print(r3)
print(title.group(0))

