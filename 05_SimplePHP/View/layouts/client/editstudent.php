<!doctype html>
<html class="no-js" lang="">


<body>
    <div id="preloader"></div>
    <!-- Preloader End Here -->
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
    <div id="wrapper" class="wrapper">
        <!-- Đăng ký-->
        <div class="modal fade" id="signup" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="title-login-form">Thêm sinh vien</div>
                    </div>
                    <div class="modal-body">
                        <div class="login-form">
                            <form method="post">
                                <label>Tên đăng nhập *</label>
                                <br>
                                <input type="text" name="username" placeholder="Tên đăng nhập" value='<?php echo $info["username"] ?>' />
                                <br>
                                <label>Mật khẩu *</label>
                                <br>
                                <input type="password" name="password" placeholder="Mật khẩu" />
                                <br>
                                <label>Họ và tên *</label>
                                <br>
                                <input type="text" name="hoten" placeholder="Họ tên" value='<?php echo $info["hoten"] ?>' />
                                <br>
                                <label>Email </label>
                                <br>
                                <input type="text" name="email" placeholder="Email" value='<?php echo $info["email"] ?>' />
                                <br>
                                <label>Số điện thoại </label>
                                <br>
                                <input type="tel" name="phonenumber" placeholder="So dien thoai" value='<?php echo $info["phonenumber"] ?>' />
                                <br>
                                <label>Chức vụ </label>
                                <br>
                                <select name="role">
                                    <option value="student">Học sinh</option>
                                </select>
                                <br><br>
                                <button onclick="return confirm('Bạn có chắc không?');" type="submit" value="Edit" name="Edit">Sửa</button>
                                <button class="form-cancel" type="submit" value="" name="exit">Hủy</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Đăng ký End-->