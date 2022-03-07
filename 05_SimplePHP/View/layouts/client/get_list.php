<!DOCTYPE html>
<html>

<head>
    <title>Danh sách sinh vien</title>
    <meta charset="UTF-8">
</head>

<body>
    <h1 class="text-center">Danh sách sinh vien</h1>
    <div class="action-bar justify-end pr-2">
        <a class="link-button" href="?controller=pages&action=addstudent">
            Thêm sinh viên
        </a>
    </div>
    <table class="mt-3" width="100%" border="1" cellspacing="0" cellpadding="10">
        <col style="width:5%">
        <col style="width:25%">
        <col style="width:25%">
        <col style="width:25%">
        <col style="width:20%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th class="table-col--action">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $_POST['delete'] = NULL;
            require_once('../05_SimplePHP/Model/client/UserModel.php');
            $userModel = new UserModel();
            $list = $userModel->getallstudents();
            foreach ($list as $item) { ?>
                <tr class="table-row">
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['hoten']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['phonenumber']; ?></td>
                    <td class="table-col--action">
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                            <input type="hidden" name="update" value="Sửa" />
                            <button class="button btn-warn" type="submit">Sửa</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                            <input type="hidden" name="delete" value="Xóa" />
                            <button class="button btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit">Xóa</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                            <input type="hidden" name="read" value="Xem" />
                            <button class="button" type="submit">Xem</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>