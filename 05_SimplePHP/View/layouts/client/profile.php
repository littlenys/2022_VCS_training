
<!DOCTYPE html>
<html>
    <head>
        <title>Thong tin ca nhan</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <?php

    
        $hoten      = $info['hoten'];
        $email      = $info['email'];
        $phonenumber= $info['phonenumber'];
        $avatar     = $info['avatar'];

    ?>
    <table width="100%" border="1" cellspacing="0" cellpadding="10">

        <tr>
            <td>Name</td>
            <th><?php echo $hoten; ?></th>
        </tr>
        <tr>
            <td>Email</td>
            <th><?php echo $email; ?></th>
        </tr>
        <tr>
            <td>Phone</td>
            <th><?php echo $phonenumber; ?></th>
        </tr>
        </table>

    </body>
</html>