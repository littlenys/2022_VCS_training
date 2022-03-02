<!doctype html>
<html class="no-js" lang="">


    <body>
        <div id="preloader"></div>
        <!-- Preloader End Here -->
        <?php  
            if (isset($error['username'])) {?>
                <div class="alert alert-danger" style="top: 155px; position: absolute; z-index: 5; width: auto; right: 0px;" role="alert">
                    <?php echo $error['username']?>
                </div>
            <?php } else if (isset($error['password'])) {?>
                <div class="alert alert-danger" style="top: 155px; position: absolute; z-index: 5; width: auto; right: 0px;" role="alert">
                    <?=$error['password']?>
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
                            <div class="title-login-form">Đăng ký</div>
                        </div>
                        <div class="modal-body">
                            <div class="login-form">
                                <form method="post">
                                    <label>Tên đăng nhập *</label>
                                    <input type="text" name="username" placeholder="Tên đăng nhập" />
                                    <label>Mật khẩu *</label>
                                    <input type="password" name="password" placeholder="Mật khẩu" />
                                    <button type="submit" value="Login" name="signup">Đăng nhap</button>
                                    <button class="form-cancel" type="submit" value="">Hủy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Đăng ký End-->