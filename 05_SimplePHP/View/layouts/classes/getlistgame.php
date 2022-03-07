
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

        <br>
<br>
        <?php
        if (str_contains( $isresultcorrect, 'Incorrect')) { 
            ?>
                    <div class="Incorrect-answer-game">Incorrect. Try again :3</div>

            <?php
        }
        else if(str_contains( $isresultcorrect, 'Correct')){ ?>
            <div class="Correct-answer-game"><?php echo $isresultcorrect ?></div>

        <?php }
        ?>
        <br>
        <br>

        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Ngày tạo</th>
                <th>Người tổ chức</th>
                <th>Gợi ý</th>
                <th>Options</th>
            </tr>
    <?php
        $_POST['delete'] = NULL;
        foreach ($list as $item){ ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['reg_date']; ?></td>
                <td><?php echo $userModel->readuser($item['authorid'])->fetch_array()['hoten'] ; ?></td>
                <td><?php echo $item['goiy']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>"/>
                        <input type="text" name="answer" placeholder="answer"/>
                        <input type="submit" name="submit" value="Trả lời"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>