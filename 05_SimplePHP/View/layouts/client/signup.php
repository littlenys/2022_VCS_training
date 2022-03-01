<!doctype html>
<html class="no-js" lang="">

    
<!-- Mirrored from www.radiustheme.com/demo/html/newsedge/newsedge/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Feb 2020 08:41:57 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>NewsEdge | Home 1</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="Public/client/img/favicon.png">
        <!-- Normalize CSS -->
        <link rel="stylesheet" href="Public/client/css/normalize.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="Public/client/css/main.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="Public/client/css/bootstrap.min.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="Public/client/css/animate.min.css">
        <!-- Font-awesome CSS-->
        <link rel="stylesheet" href="Public/client/css/font-awesome.min.css">
        <!-- Owl Caousel CSS -->
        <link rel="stylesheet" href="Public/client/vendor/OwlCarousel/owl.carousel.min.css">
        <link rel="stylesheet" href="Public/client/vendor/OwlCarousel/owl.theme.default.min.css">
        <!-- Main Menu CSS -->
        <link rel="stylesheet" href="Public/client/css/meanmenu.min.css">
        <!-- Magnific CSS -->
        <link rel="stylesheet" type="text/css" href="Public/client/css/magnific-popup.css">
        <!-- Switch Style CSS -->
        <link rel="stylesheet" href="Public/client/css/hover-min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="Public/client/style.css">
        <!-- For IE -->
        <link rel="stylesheet" type="text/css" href="Public/client/css/ie-only.css" />
        <!-- Modernizr Js -->
        <script src="Public/client/js/modernizr-2.8.3.min.js"></script>
    </head>

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
            <?php } else if (isset($error['full_name'])) {?>
                <div class="alert alert-danger" style="top: 155px; position: absolute; z-index: 5; width: auto; right: 0px;" role="alert">
                    <?=$error['full_name']?>
                </div>
            <?php } else if (isset($error['username_exist'])) {?>
                <div class="alert alert-danger" style="top: 155px; position: absolute; z-index: 5; width: auto; right: 0px;" role="alert">
                    <?=$error['username_exist']?>
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
                                    <label>Họ và tên *</label>
                                    <input type="text" name="hoten" placeholder="Họ tên" />
                                    <label>Email </label>
                                    <input type="text" name="email" placeholder="Email" />
                                    <label>Số điện thoại  </label>
                                    <input type="tel" name="phonenumber" placeholder="So dien thoai" />
                                    <label>Chức vụ </label>
                                    <select name="role">
                                        <option value="student">Học sinh</option>
                                        <option value="teacher">Giáo viên</option>
                                    </select>
                                    <br><br>
                                    <button type="submit" value="Login" name="signup">Đăng ký</button>
                                    <button class="form-cancel" type="submit" value="">Hủy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Đăng ký End-->