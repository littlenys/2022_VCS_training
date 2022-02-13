1. GET 
Thực hiện GET trang chủ và in ra title của trang.
Tên chương trình: httpget
Ví dụ: 
python httpget.py --url http://blogtest.vnprogramming.com/
Ouput: 
Title: anhtudsvk4
2. POST 
Thực hiện POST vào trang đăng nhập để đăng nhập vào một tài khoản. In ra đăng nhập thành công hay thất bại.
Tên chương trình: httppost
Ví dụ:
python httppost.py --url http://blogtest.vnprogramming.com/wp-login.php --user test --password test123QWE@AD
Output: 
User test đăng nhập thành công 
Hoặc User test đăng nhập thất bại
3. upload
Thực hiện upload một file ảnh lên Media Library. In ra đường dẫn file được upload.
Tên chương trình: httpupload
Ví dụ:
python httpupload.py --url ttp://blogtest.vnprogramming.com/ --user test --password test123QWE@AD --localfile D:/test.png
Output: 
Upload success. File upload url: https://45.32.110.240/wp-content/uploads/2020/09/test.png
Hoặc Upload failed.
4. download
Thực hiện GET để download một file ảnh trên máy chủ, hiển thị kích thước của file ảnh download được.
Tên chương trình: httpdownload
Ví dụ:
python httpdownload.py --url ttp://blogtest.vnprogramming.com/ --remote-file /wp-content/uploads/2020/09/test.png
Output: 
Kích thước file ảnh: 14574 bytes
Hoặc Không tồn tại file ảnh

