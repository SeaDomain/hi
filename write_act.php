<?php
session_start();
$connect = mysqli_connect("127.0.0.1", "ddcar03", "1234", "DB") or die("fail");

$id = $_SESSION['userid'];                //Writer
$title = $_POST['title'];               //Title
$content = nl2br($_POST['content']);           //Content
$date = date('Y-m-d H:i:s');            //Date

$tmpfile =  $_FILES['file']['tmp_name'];
$o_name = $_FILES['file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['file']['name']);

$ext = explode(".", strtolower($filename));

 $cnt = count($ext)-1;
 if($ext[$cnt] === ""){
   if(preg_match("/php|php3|php4|htm|inc|html|phar/", $ext[$cnt-1])){
           echo "업로드할 수 없는 파일 유형입니다.";
       exit();
   }
 } else if(preg_match("/php|php3|php4|htm|inc|html|phar/", $ext[$cnt])){
         echo "업로드할 수 없는 파일 유형입니다.";
            exit();
         

         

 } 
 else {
$upload = move_uploaded_file($tmpfile, "./files/$o_name");
 }
$query = "insert into board (title, content, id, date, hit, file) 

        values('$title', '$content', '$id', '$date', 0,'$o_name')";




$result = $connect->query($query);
if ($result) {
?> <script>
        alert("<?php echo "게시글이 등록되었습니다." ?>");
        location.href = 'index.php';

    </script>
<?php

} else {

        echo "게시글 등록에 실패하였습니다.";


}

mysqli_close($connect);
?>
