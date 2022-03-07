
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách sinh vien</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Danh sách bài làm của sinh viên</h1>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Đề bài</th>
                <th>Bài nộp</th>
                <th>Options</th>
            </tr>
    <?php
        foreach ($list as $item){
            $id = $item['id'];
            $submission = $userModel->viewsubmission($id)->fetch_array();
            $url = $submission['url'];
            ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $userModel->readuser($item['authorid'])->fetch_array()['hoten'] ; ?></td>
                <td><?php echo $userModel->viewassignment($item['assignmentid'])->fetch_array()['tenfile']; ?></td>
                <td><?php echo $submission['tenfile']; ?></td>
                <td>
                <p><a href="dowload.php?path=<?php echo $url ?>"> 
                <h2>Tải</h2>
                </a></p>
                <p><a href="<?php echo $url ?>" target="_blank"><h2>Xem</h2></a></p>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>