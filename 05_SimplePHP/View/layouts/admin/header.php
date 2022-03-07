<!doctype html>
<html class="no-js" lang="">
<head>
    <link rel="stylesheet" href="../05_SimplePHP/Public/style/background.css">
    <link rel="stylesheet" href="../05_SimplePHP/Public/style/form.css">
    </head>

    <body>
        <div class='helloheader' >
            <h2>
                <?php
                if(isset($_SESSION['teacher']))
                {
                    echo 'Hello '.$_SESSION['teacher']['hoten'].' teacher. Welcome to your class';
                }
                if(isset($_SESSION['student']))
                {
                    echo 'Hello '.$_SESSION['student']['hoten'].' student. Welcome to your class';
                }
                ?>
            </h2>
        </div>
    </body>
</html>