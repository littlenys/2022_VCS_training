<!DOCTYPE html>
<html>

<head>
    <title>Danh sách sinh vien</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="text-center">Danh sách bài tập</h1>
    <table width="100%" border="1" cellspacing="0" cellpadding="10">
        <col style="width:10%">
        <col style="width:30%">
        <col style="width:25%">
        <col style="width:25%">
        <col style="width:10%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Tên</th>
                <th>Hạn</th>
                <th class="table-col--action">Options</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $_POST['delete'] = NULL;
            foreach ($list as $item) { ?> 
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $userModel->readuser($item['authorid'])->fetch_array()['hoten']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['due']; ?></td>
                <td class="table-col--action">
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                        <input type="hidden" name="read" value="Xem" />
                        <button class="" type="submit">Xem</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>

</html>