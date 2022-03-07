<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');
		$userModel = new UserModel();
		if (!empty($_POST['fileupload'])) 
		{
			$error = $this->FileUpload($userModel);
		}
		require_once('../05_SimplePHP/View/layouts/classes/addgame.php');
	}

	public function FileUpload($userModel) {

		if (isset($_POST['fileupload'])) {
			$goiy = $_POST['goiy'];
			// Kiểm tra có dữ liệu fileupload trong $_FILES không
			// Nếu không có thì dừng
			if (!isset($_FILES["file"]))
			{
				echo "<script>alert('Dữ liệu không đúng cấu trúc')</script>";
				die;
			}

			// Kiểm tra dữ liệu có bị lỗi không
			if ($_FILES["file"]['error'] != 0)
			{
				echo "<script>alert('Dữ liệu upload bị lỗi')</script>";
				die;
			}

			// Đã có dữ liệu upload, thực hiện xử lý file upload

			//Thư mục bạn sẽ lưu file upload
			$target_dir    = "../05_SimplePHP/upload/";
			//Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
			$target_file   = $target_dir . basename($_FILES["file"]["name"]);

			$allowUpload   = true;

			$allowtypes    = array('txt');

			//Lấy phần mở rộng của file (jpg, png, ...)
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Kiểm tra kiểu file
			if (!in_array($imageFileType,$allowtypes ))
			{
				echo "<script>alert('Chỉ được upload file txt')</script>";
				$allowUpload = false;
			}

			if ($allowUpload)
			{
				// Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				{
					$id = $userModel->addgame($_SESSION['teacher']['id'], $goiy);
                    if ($id != NULL){
                        $userModel->fileattach("game", $id, md5(pathinfo($_FILES["file"]["name"])['filename']), $target_file);
                        echo "<script>alert('Đã upload thành công.')</script>";
                    }
                    else
                    {
                        echo "<script>alert('Có lỗi xảy ra khi upload file.')</script>";
                    }
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
} // end header

if(isset($_SESSION['teacher']))
{
    $header = new Header();
}
