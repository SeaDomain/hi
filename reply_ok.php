<?php
session_start();
?>

<?php
$connect = mysqli_connect('127.0.0.1', 'ddcar03', '1234', 'DB');
$number = $_GET['no'];

$username = $_SESSION['userid'];
$content = $_POST['content'];
$date = date("Y-m-d H:i:s");

    if($number && $username && $content){
        $result ="insert into comment (board_no, id, comment, date) values ('$number','$username','$content', '$date')";
       $result2 =$connect->query($result);



        echo "<script>alert('댓글이 작성되었습니다.');
        location.href='read.php?no=$number$&no=$number';</script>";

    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.');
        history.back();</script>";

    }
