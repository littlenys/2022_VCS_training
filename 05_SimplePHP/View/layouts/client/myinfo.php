
<!DOCTYPE html>
<html>
    <head>
        <title>Thong tin ca nhan</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../05_SimplePHP/Public/style/form.css">
    </head>
    <body>
        <?php
        if(isset($_SESSION['teacher']))
        {
            $username   = $_SESSION['teacher']['username'];
            $hoten      = $_SESSION['teacher']['hoten'];
            $email      = $_SESSION['teacher']['email'];
            $phonenumber= $_SESSION['teacher']['phonenumber'];
            $avatar     = $_SESSION['teacher']['avatar'];
        }

        if(isset($_SESSION['student']))
        {
            $username   = $_SESSION['student']['username'];
            $hoten      = $_SESSION['student']['hoten'];
            $email      = $_SESSION['student']['email'];
            $phonenumber= $_SESSION['student']['phonenumber'];
            $avatar     = $_SESSION['student']['avatar'];
        }
        ?>
        <br>
        <img src="<?php echo $avatar; ?>" alt="avatar" width="100" height="100">
        <form method="post" enctype="multipart/form-data">
                <input type="file" name="fileupload" id="fileupload">
                <input type="submit" value="Đăng ảnh" name="imageupload">
        </form>
        <div class="form">
            <form method="post">
                <label>Tên đăng nhập *</label>
                <br>
                <input type="text" name="username" placeholder="Tên đăng nhập" 
                        value='<?php echo $info["username"]?>' readonly/>
                <br>
                <label>Mật khẩu *</label>
                <br>
                <input type="password" name="password" placeholder="Mật khẩu" />
                <br>
                <label>Họ và tên *</label>
                <br>
                <input type="text" name="hoten" placeholder="Họ tên" 
                        value='<?php echo $info["hoten"]?>' readonly/>
                <br>
                <label>Email </label>
                <br>
                <input type="text" name="email" placeholder="Email" 
                        value='<?php echo $info["email"]?>'/>
                <br>
                <label>Số điện thoại  </label>
                <br>
                <input type="tel" name="phonenumber" placeholder="So dien thoai"
                        value='<?php echo $info["phonenumber"]?>' />
                <br>
                <button onclick="return confirm('Bạn có chắc không?');" type="submit" value="Edit" name="Edit">Sửa</button>
            </form>
        </div>

    </body>
</html>