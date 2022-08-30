<?php
$connect = mysqli_connect('127.0.0.1', 'ddcar03', '1234', 'DB') or die("connect failed");

$id = $_POST['id'];
$pw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
$name = $_POST['name'];

//id 중복 확인
$query1 = "select * from TB where id='$id'";
$result1 = $connect->query($query1);
$count = mysqli_num_rows($result1);

if ($count) {      //만약 중복된 id가 있다면
?><script>
        alert('이미 존재하는 ID입니다.');
        history.back();
    </script>
    <?php } else {  //없다면
    //입력받은 데이터를 DB에 저장
    $query = "insert into TB(id, pw, name) values('$id', '$pw', '$name')";

    $result = $connect->query($query);

    //저장이 되었다면 (result = true) 가입 완료
    if ($result) {
    ?> <script>
            alert('회원가입에 성공하였습니다.');
            location.replace("index.html");
        </script>

    <?php } else {
    ?> <script>
            alert("회원가입에 실패하였습니다.");
location.replace("index.html");
</script>
<?php } 
}         
mysqli_close($connect);
?>   