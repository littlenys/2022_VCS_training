
<!DOCTYPE html>
<html>
    <head>
        <title>Thong tin ca nhan</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h1>Giao bài tập</h1>
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
                <input type="submit" value="Giao bài tập" name="fileupload">
        </form>
    </body>
</html>