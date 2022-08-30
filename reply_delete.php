<?php
session_start();
$connect = mysqli_connect('127.0.0.1', 'ddcar03','1234','DB') or die("connect failed");
$number = $_POST['replyno'];

$bo_number = $_GET['no'];

$query = "select id from comment where no = $number";
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);

$userid = $rows['id'];

  $sql1 = "select * from comment where no='".$number."'";
           $result1 = $connect->query($sql1);

$reply =$result1->fetch_array();

$reno = $_POST['reno'];
$sql2 = "select * from board where no='".$reno."'";

$result2 = $connect->query($sql2);

$board = $result2->fetch_array();
?>
<?php


if($_SESSION['userid'] == $userid)
{
$sql = "delete from comment where no='".$number."'";
$result3 = $connect->query($sql); ?>
<script>
alert("글이 삭제되었습니다");

location.href ='read.php?no=<?php echo $board['no'];?>'
</script>
<?php } else {?>
<script>
  alert("권한이 없습니다.");
  location.href='read.php?no=<?php echo $board['no'];?>'
  </script>
<?php }
?>
