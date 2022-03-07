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
    $phonenumber = $info['phonenumber'];
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
        <tr>
            <td>Message</td>
            <td>
                <div class="send-message">
                    <form method="post">
                        <label>Send message</label>
                        <input type="text" name="message" placeholder="A message to your friend" />
                        <button type="submit" value="Send" name="sendmessage">Send</button>
                    </form>
                </div>
                <table width="50%" border="1" cellspacing="0" cellpadding="10">
                    <?php
                    if ($messages->num_rows > 0) {

                        foreach ($messages as $item) { ?>
                            <tr>
                                <td>
                                    <h4> <?php echo $item['reg_date']; ?> : <?php echo $item['noidung']; ?> </h4>
                                </td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="x">
                                        <input type="text" name="noidungupdate" value="<?php echo $item['noidung']; ?>" />
                                        <input onclick=" " type="submit" name="update" value="edit">
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } ?>
                </table>
            </td>
        </tr>
    </table>


</body>

</html>