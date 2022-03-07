<!DOCTYPE html>
<html>

<head>
    <title>Thong tin ca nhan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../05_SimplePHP/Public/style/form.css">
</head>

<body>
    <br>
    <div class="modal-body">
        <div class="title-login-form">
            <div class="form">
                <section class="avatar-container">
                    <img id="avatar" src="<?php echo $info["avatar"]; ?>" alt="avatar" width="100" height="100">
                    <form class="flex-y mb-1" method="post" enctype="multipart/form-data">
                        <input class="hidden" type="file" accept="image/*" name="fileupload" id="file-upload">
                        <label for="file-upload">Chọn ảnh</label>
                        <input type="hidden" value="Đăng ảnh" name="imageupload"/>
                        <button class="submit-button mt-1" type="submit" disabled>Đăng ảnh</button>
                    </form>
                    <script>
                        const fileUpload = document.getElementById("file-upload");
                        const avatar = document.getElementById("avatar");
                        const submitBtn = document.querySelector(".avatar-container button[type=submit]")
                        fileUpload.addEventListener("change", (event) => {
                            const [ file ] = event.target.files;
                            if(file) {
                                avatar.setAttribute('src', URL.createObjectURL(file))
                                submitBtn.disabled = false
                            }

                        })
                    </script>
                </section>
                <form method="post">
                    <label>Tên đăng nhập *</label>
                    <br>
                    <input type="text" name="username" placeholder="Tên đăng nhập" value='<?php echo $info["username"] ?>' readonly />
                    <br>
                    <label>Mật khẩu *</label>
                    <br>
                    <input type="password" name="password" placeholder="Mật khẩu" />
                    <br>
                    <label>Họ và tên *</label>
                    <br>
                    <input type="text" name="hoten" placeholder="Họ tên" value='<?php echo $info["hoten"] ?>' readonly />
                    <br>
                    <label>Email </label>
                    <br>
                    <input type="text" name="email" placeholder="Email" value='<?php echo $info["email"] ?>' />
                    <br>
                    <label>Số điện thoại </label>
                    <br>
                    <input type="tel" name="phonenumber" placeholder="So dien thoai" value='<?php echo $info["phonenumber"] ?>' />
                    <br>
                    <div class="text-center mt-1">
                        <button class="submit-button" onclick="return confirm('Bạn có chắc không?');" type="submit" value="Edit" name="Edit">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>