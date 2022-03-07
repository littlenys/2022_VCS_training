
<!DOCTYPE html>
<html>
    <head>
        <title>Giao bai tap</title>
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
        ?>
        <br>
        <h1 class="text-center">Giao bài tập</h1>
        <div class="modal-body" >
        <div class="title-login-form">
        <div class="form">
        <form method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="file">
                <br>
                <label>Tên bài tập</label>
                <br>
                <input type="text" name="name" value="Bài tập về nhà"  />
                <br>
                <label>Hạn nộp bài</label>
                <br>
                <?php   $datetime = new DateTime('tomorrow');?>
                <input type="datetime" name="due" value="<?php echo $datetime->format('Y-m-d H:i:s'); ?>"  />
                <input class="submit-button" type="submit" value="Giao bài tập" name="fileupload">
        </form>
    </div>
    </div>
    </div>

    </body>
</html>