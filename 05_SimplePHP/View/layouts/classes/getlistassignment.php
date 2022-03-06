
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách sinh vien</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    </head>
    <body>
        <h1>Danh sách bài tập</h1>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Tên</th>
                <th>Hạn</th>
                <th>Options</th>
            </tr>
    <?php
        $_POST['delete'] = NULL;
        foreach ($list as $item){ ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $userModel->readuser($item['authorid'])->fetch_array()['hoten'] ; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['due']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>"/>
                        <input type="submit" name="read" value="Xem"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>