<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <style>
        .read_table {
            border: 1px solid #444444;
            margin-top: 30px;
        }

        .read_title {
            height: 45px;
            font-size: 23.5px;
            text-align: center;
            background-color: #3C3C3C;
            color: white;
            width: 1000px;
        }

        .read_id {
            text-align: center;
            background-color: #EEEEEE;
            width: 30px;
            height: 33px;
        }

        .read_id2 {
            background-color: white;
            width: 60px;
            height: 33px;
            padding-left: 10px;
        }

        .read_hit {
            background-color: #EEEEEE;
            width: 30px;
            text-align: center;
            height: 33px;
        }

        .read_hit2 {
            background-color: white;
            width: 60px;
            height: 33px;
            padding-left: 10px;
        }

        .read_content {
            padding: 20px;
            border-top: 1px solid #444444;
            height: 500px;
        }

.read_btn {
            width: 700px;
            height: 200px;
            text-align: center;
            margin: auto;
            margin-top: 40px;
        }

        .read_btn1 {
            height: 45px;
            width: 90px;
            font-size: 20px;
            text-align: center;
            background-color: #3C3C3C;
            border: 2px solid black;
            color: white;
            border-radius: 10px;
        }

        .read_comment_input {
            width: 700px;
            height: 500px;
            text-align: center;
            margin: auto;
        }

        .read_text3 {
            font-weight: bold;
            float: left;
            margin-left: 20px;
        }

        .read_com_id {
            width: 100px;
        }

        .read_comment {
            width: 500px;
        }
    </style>
</head>

<body>
    <?php
    $connect = mysqli_connect('127.0.0.1', 'ddcar03', '1234', 'DB');
    $number = htmlentities($_GET['no']);  // GET ?????? ??????
    session_start();
    $query ="select title, content, id, date, hit, file from board where no = $number";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);


    $hit = "update board set hit = hit + 1 where no = $number";
    $connect->query($hit);

    if (isset($_SESSION['userid'])) {
    ?><b><?php ?> 
        <button onclick="location.href='./logout.php'" style="float:right; font-size:15.5px;">????????????</button>
        <br />
    <?php
    } else {
    ?>
        <button onclick="location.href='./login.php'" style="float:right; font-size:15.5px;">?????????</button>
        <br />
    <?php
    }
    ?>

    <table class="read_table" align=center>
        <tr>
            <td colspan="4" class="read_title"><?php echo $rows['title'] ?></td>
        </tr>
        <tr>
            <td class="read_id">?????????</td>
            <td class="read_id2"><?php echo $rows['id'] ?></td>
            <td class="read_hit">?????????</td>
            <td class="read_hit2"><?php echo $rows['hit'] + 1 ?></td>
        </tr>


        <tr>
            <td colspan="4" class="read_content" valign="top">
                <?php echo $rows['content'] ?></td>
        </tr>
    </table>

 <div class="read_btn">
        <button class="read_btn1" onclick="location.href='./index.php'">??????</button>&nbsp;&nbsp;
        <?php
        if (isset($_SESSION['userid']) and $_SESSION['userid'] == $rows['id']) { ?>

  <button class="read_btn1" onclick="location.href='./modify.php?no=<?= $number ?>'">??????</button>&nbsp;&nbsp;
            <!-- ??????????????? ????????? -->
            <button class="read_btn1" a onclick="ask();">??????</button>

            <script>
                function ask() {
                    if (confirm("???????????? ?????????????????????????")) {
                        window.location = "./delete.php?no=<?= $number ?>"
                    }
                }
            </script>

<div id="board_file">
  <div>
   ?????? : <a href="./files/<?php echo $rows['file'];?>" download><?php echo $rows['file']; ?></a>
</div>
            <!-- ???????????? -->
        <?php } ?>
<div class="reply_view">
    <h3>????????????</h3>
        <?php
            $sql3 = "select * from comment where board_no='".$number."' order by no desc";
           $result2 = $connect->query($sql3);

   while ($reply = $result2->fetch_array()){
?>

        <div class="dap_lo">
            <div><b><?php echo $reply['id'];?></b></div>
            <div class="dap_to comt_edit"><?php echo nl2br("$reply[comment]"); ?></div>
            <div class="rep_me dap_to"><?php echo $reply['date']; ?></div>

        </div>



<!--?????? ?????? --!>
<div class='dat_delete'>
<form action="reply_delete.php?no=<?php echo $number; ?>" method="post">
<input type="hidden" name="replyno" value="<?php echo $reply['no']; ?>" /><input type="hidden" name="reno" value="<?php echo $number; ?>">
<input type="submit" value="??????"></p>
</form>

</div>
</div>


    <?php } ?>

    <!--- ?????? ?????? ??? -->
    <div class="dap_ins">
        <form action="reply_ok.php?no=<?echo $number?>&no=<?php echo $number ?>" method="POST">
            <input type="hidden" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="??????
???" value=<?$_SESSION['userid']?>>
            <div style="margin-top:10px; ">
                <textarea name="content" class="reply_content" id="re_content" ></textarea>
                <button id="rep_bt" class="re_bt">??????</button>

            </div>
        </form>

</div>
</div>
<!--- ?????? ???????????? -->

<div id="foot_box"> </div>
</div>
</body>

</html>

