<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');
		$userModel = new UserModel();
		if (!empty($_POST['imageupload'])) 
		{
			$error = $this->ImageUpload($userModel);
		}
        $id = $_SESSION['student']['id'];
		$error = $this->Edit($userModel);
	    $info = $userModel->readuser($id)->fetch_array();
		require_once('../05_SimplePHP/View/layouts/client/myinfo.php');
	}

	public function ImageUpload($userModel) {
        $username = $password = NULL;
		$error = array();
		$error['username'] = $error['password'] = NULL;
		echo "start";
		if (isset($_POST['imageupload'])) {
			echo "up";
		 // Kiểm tra có dữ liệu fileupload trong $_FILES không
			// Nếu không có thì dừng
			if (!isset($_FILES["fileupload"]))
			{
				echo "<script>alert('Dữ liệu không đúng cấu trúc')</script>";
				die;
			}

			// Kiểm tra dữ liệu có bị lỗi không
			if ($_FILES["fileupload"]['error'] != 0)
			{
				echo "<script>alert('Dữ liệu upload bị lỗi')</script>";
				die;
			}

			// Đã có dữ liệu upload, thực hiện xử lý file upload

			//Thư mục bạn sẽ lưu file upload
			$target_dir    = "D:/VCS_training/05_SimplePHP/upload/";
			//Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
			$target_file   = $target_dir . basename($_FILES["fileupload"]["name"]);

			$allowUpload   = true;

			//Lấy phần mở rộng của file (jpg, png, ...)
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Cỡ lớn nhất được upload (bytes)
			$maxfilesize   = 800000;

			////Những loại file được phép upload
			$allowtypes    = array('jpg', 'png', 'jpeg', 'gif');


			if(isset($_POST["submit"])) {
				//Kiểm tra xem có phải là ảnh bằng hàm getimagesize
				$check = getimagesize($_FILES["fileupload"]["tmp_name"]);
				if($check !== false)
				{
					echo "<script>alert('Đây là file ảnh - " . $check["mime"] . ".')</script>";
					$allowUpload = true;
				}
				else
				{
					echo "<script>alert('Không phải file ảnh.')</script>";
					$allowUpload = false;
				}
			}

			// Kiểm tra kiểu file
			if (!in_array($imageFileType,$allowtypes ))
			{
				echo "<script>alert('Chỉ được upload các định dạng JPG, PNG, JPEG, GIF')</script>";
				$allowUpload = false;
			}


			if ($allowUpload)
			{
				// Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
				if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file))
				{
					echo "<script>alert('Đã upload thành công.')</script>";

					$_SESSION['student']['avatar'] = $target_file;
					$userModel->updatestudentavatar($_SESSION['student']['id'],$target_file);
				}
				else
				{
					echo "<script>alert('Có lỗi xảy ra khi upload file.')</script>";
				}
			}
			else
			{
				echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...')</script>";
			}
		}
	} // end upload

	public function Edit($userModel) {
        $id = $_SESSION['student']['id'];
        $username = $password = $hoten = $email = $phonenumber = $avatar = $role = NULL;
        $role = "student";
		$error = array();
		$error['username'] = $error['password'] = $error['hoten'] = $error['username_exist'] = $error['hoten'] = NULL;

		if (isset($_POST['Edit'])) {
			if (empty($_POST['username'])) {
				$error['username'] = '* Cần điền tên đăng nhập';
			} else {
				$username = $_POST['username'];
			}
            if (empty($_POST['password'])) {
			} else {
				$password = md5($_POST['password']);
			}
			if (empty($_POST['hoten'])) {
				$error['hoten'] = '* Cần điền họ tên';
			} else {
				$hoten = $_POST['hoten'];
			}
            if (empty($_POST['email'])) {
			} else {
				$email = $_POST['email'];
			}
            if (empty($_POST['phonenumber'])) {
			} else {
				$phonenumber = $_POST['phonenumber'];
			}


			$userModel->updatestudentforstudent($id, $password, $email, $phonenumber);
            } // end post edit
    }// end function edit
} // end header

if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
