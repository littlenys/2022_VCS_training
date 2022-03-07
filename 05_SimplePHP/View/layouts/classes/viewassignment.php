
<!DOCTYPE html>
<html>
    <head>
        <title>Thong tin ca nhan</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <?php
        $assignmentid = $assignment['id'];
        $name      = $assignment['tenfile'];
        $url       = $assignment['url'];
    ?>
        <div class="modal-body" >
        <div class="title-login-form">
        <div class="form">
    <h1> <?php echo $name ?> </h1>
    <p><a href="dowload.php?path=<?php echo $url ?>"> 
        <img src="../05_SimplePHP/Public/image/assignment.png" alt="Assignment" width="100" height="100">
    </a></p>
    <p><a href="<?php echo $url ?>"><h2>Xem</h2></a></p>
    </div>
</div>
</div>
<br>
    <div class="modal-body" >
        <div class="title-login-form">
        <div class="form">
    <h1>Nộp bài tập</h1>
    <form method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file">
            <input type="hidden" name="assignmentid" value="<?php echo $assignmentid; ?>"/>
            <input type="submit" value="Nộp bài tập" name="submission">
        </form>
</div>
</div>
</div>
    </body>
</html>