<?php
$connect = mysqli_connect('127.0.0.1', 'ddcar03', '1234', 'DB') or die("connect failed");


$title = $_GET['title'];
$content = nl2br($_GET['content']);
$number = $_GET['no'];

$date = date('Y-m-d H:i:s');

$query = "update board set title='$title', content='$content', date='$date' where no =$number";
$result =  $connect->query($query);


if ($result) {
?>
    <script>
        alert("수정되었습니다.");
        location.replace("./read.php?no=<?= $number ?>");
    </script>
<?php } else {
    echo "다시 시도해주세요.";
}
?>

