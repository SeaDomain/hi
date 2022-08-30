<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <style>
        table.table2 {
            border-collapse: separate;
            border-spacing: 1px;
            text-align: left;
            line-height: 1.5;
            border-top: 1px solid #ccc;
            margin: 20px 10px;
        }
  
        table.table2 tr {
            width: 50px;
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }

        table.table2 td {
            width: 100px;
            padding: 10px;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <?php
    $connect = mysqli_connect('127.0.0.1', 'ddcar03', '1234', 'DB') or die("connect failed");
    $number = $_GET['no'];
    $query = "select title, content, id, date from board where no = $number";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);

    $title = $rows['title'];
    $content = $rows['content'];
    $userid = $rows['id'];

    session_start();



    if (!isset($_SESSION['userid'])) {
    ?> <script>
            alert("권한이 없습니다.");
           location.href = 'index.php'; 
        </script>
    <?php   } else if ($_SESSION['userid'] == $userid) {
    ?>
 <form method="GET" action="modify_act.php">
            <table style="padding-top:50px" align=center width=auto border=0 cellpadding=2>
                <tr>
                    <td style="height:40; float:center; background-color:#3C3C3C">
                        <p style="font-size:25px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>게시글 수정하기</b></p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor=white>
                        <table class="table2">
                            <tr>
                                <td>작성자</td>
                                <td><input type="hidden" name="id" value="<?= $_SESSION['userid'] ?>"><?= $_SESSION['userid'] ?></td>
                            </tr>

                            <tr>
                                <td>제목</td>
                                <td><input type=text name=title size=87 value="<?= $title ?>"></td>
                            </tr>

                            <tr>
                                <td>내용</td>
                                <td><textarea name=content cols=75 rows=15><?= $content ?></textarea></td>
                            </tr>

                        </table>

                        <center>
                            <input type="hidden" name="no" value="<?= $number ?>">
                            <input style="height:26px; width:47px; font-size:16px;" type="submit" value="작
성">
                        </center>
                    </td>
                </tr>
            </table>
        </form>
    <?php   } else {
    ?> <script>
            alert("권한이 없습니다.");
           location.href ='index.php'; 
        </script>
    <?php   }
    ?>
</body>

</html>

