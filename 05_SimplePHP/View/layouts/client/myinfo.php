
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
        $hoten      = $_SESSION['teacher']['hoten'];
        $email      = $_SESSION['teacher']['email'];
        $phonenumber= $_SESSION['teacher']['phonenumber']
        $avatar     = $_SESSION['teacher']['avatar']

    }
    ?>
    <>

    </body>
</html>