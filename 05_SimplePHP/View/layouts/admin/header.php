<!doctype html>
<html class="no-js" lang="">

<head>
    <link rel="stylesheet" href="../05_SimplePHP/Public/style/background.css">
    <link rel="stylesheet" href="../05_SimplePHP/Public/style/form.css">
    <link rel="stylesheet" href="../05_SimplePHP/Public/style/style.css">
    <link rel="stylesheet" href="/05_SimplePHP/Public/style/table.css">
</head>

<body>
<?php
    if (isset($_SESSION['teacher']) || isset($_SESSION['student'])) {?>
    <div class='helloheader'>
        <h2>
            <?php
            if (isset($_SESSION['teacher'])) {
                echo 'Hello ' . $_SESSION['teacher']['hoten'] . ' teacher. Welcome to your class';
            }
            if (isset($_SESSION['student'])) {
                echo 'Hello ' . $_SESSION['student']['hoten'] . ' student. Welcome to your class';
            }
            ?>
        </h2>
    </div>
    <?php } ?>
    <div align="center">
    <a class="mr-5" href="?controller=pages&action=home" rel="nofollow" >
    <img width="100px"  src="../05_SimplePHP/Public/image/home.png" alt="HOME">
    <h2>HOME</h2>
    </a>
    </div>
</body>

</html>