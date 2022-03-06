<?php

class Header {
	public function __construct()
	{
		require_once('../05_SimplePHP/Model/client/UserModel.php');

		$userModel = new UserModel();
        $assignment = $this->ViewAssignment($userModel);
		if (!empty($_POST['submission']) & isset($_SESSION['student'])){
			$messagesend = $this->FileUpload($userModel);
			header("Refresh:0");
		}

		require('../05_SimplePHP/View/layouts/classes/viewassignment.php');
	}

	public function ViewAssignment($userModel) 
    {
        $id = $_GET['id'];
	    $info = $userModel->viewassignment($id)->fetch_array();
        return $info;
    }

	public function FileUpload($userModel) {

		if (isset($_POST['submission'])) {
			$assignmentid = $_POST['assignmentid'];
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

			if ($allowUpload)
			{
				// Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				{
					$id = $userModel->addsubmission($_SESSION['student']['id'], $assignmentid);
                    if ($id != NULL){
                        $userModel->fileattach("submission", $id, $_FILES["file"]["name"], $target_file);
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


if(isset($_SESSION['teacher']) or isset($_SESSION['student']))
{
    $header = new Header();
}
