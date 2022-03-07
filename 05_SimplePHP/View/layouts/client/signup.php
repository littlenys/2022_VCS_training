<!doctype html>
<html class="no-js" lang="">

<head>
    <link rel="stylesheet" href="../05_SimplePHP/Public/style/background.css">
    <link rel="stylesheet" href="../05_SimplePHP/Public/style/form.css">
</head>

<body>
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper">
        <!-- Đăng ký-->
        <div class="modal fade" id="signup" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <div class="title-login-form">
                            <h1>Đăng ký</h1>
                        </div>
                        <div class="form">
                            <h3>
                                <?php
                                if (isset($error['username'])) { ?>
                                    <div class="alert alert-danger" style="top: 155px; z-index: 5; width: auto; left: 0px;" role="alert">
                                        <?php echo $error['username'] ?>
                                    </div>
                                <?php } else if (isset($error['password'])) { ?>
                                    <div class="alert alert-danger" style="top: 155px; z-index: 5; width: auto; left: 0px;" role="alert">
                                        <?= $error['password'] ?>
                                    </div>
                                <?php } else if (isset($error['hoten'])) { ?>
                                    <div class="alert alert-danger" style="top: 155px; z-index: 5; width: auto; left: 0px;" role="alert">
                                        <?= $error['hoten'] ?>
                                    </div>
                                <?php } else if (isset($error['username_exist'])) { ?>
                                    <div class="alert alert-danger" style="top: 155px; z-index: 5; width: auto; left: 0px;" role="alert">
                                        <?= $error['username_exist'] ?>
                                    </div>
                                <?php }
                                ?>
                            </h3>

                            <form method="post">
                                <label class="form-item-label form-item-required">Tên đăng nhập</label>
                                <input type="text" name="username" placeholder="Tên đăng nhập" />
                                <br>
                                <label class="form-item-label form-item-required">Mật khẩu</label>
                                <input type="password" name="password" placeholder="Mật khẩu" />
                                <br>
                                <label class="form-item-label form-item-required">Họ và tên</label>
                                <input type="text" name="hoten" placeholder="Họ tên" />
                                <br>
                                <label class="form-item-label">Email </label>
                                <input type="text" name="email" placeholder="Email" />
                                <br>
                                <label class="form-item-label">Số điện thoại </label>
                                <input type="tel" name="phonenumber" placeholder="So dien thoai" />
                                <br>
                                <label class="form-item-label">Chức vụ </label>
                                <select name="role">
                                    <option value="student">Học sinh</option>
                                    <option value="teacher">Giáo viên</option>
                                </select>
                                <br><br>
                                <div align="center">
                                    <button class="submit-button" type="submit" value="Login" name="signup">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Đăng ký End-->