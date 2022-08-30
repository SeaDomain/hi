<?php
$connect = mysqli_connect('127.0.0.1', 'ddcar03', '1234', 'DB') or die("connect failed");
$number = $_GET['no'];

$query = "select id from board where no = $number";
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);

$userid = $rows['id'];

session_start();

$URL = "./index.php";
?>

<?php
if (!isset($_SESSION['userid'])) {
?> <script>
        alert("권한이 없습니다.");
       locatino.href='index.php'; 
    </script>

<?php } else if ($_SESSION['userid'] == $userid) {
    $query1 = "delete from board where no = $number";
    $result1 = $connect->query($query1); ?>
    <script>
        alert("게시글이 삭제되었습니다.");
        location.href ='index.php';
    </script>

<?php } else { ?>
    <script>
        alert("권한이 없습니다.");
        location.href ='index.php';
    </script>
<?php }
?>
