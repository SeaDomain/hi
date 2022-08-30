<?php
session_start();

$conn = mysqli_connect('127.0.0.1', 'ddcar03', '1234', 'DB') or die ("connect failed");
//아이디 비교와 비밀번호 비교가 필요한 시점이다.
// 1차로 DB에서 비밀번호를 가져온다 
// 평문의 비밀번호와 암호화된 비밀번호를 비교해서 검증한다.
$id = $_POST['ID'];
$password = $_POST['PASSWORD'];

// DB 정보 가져오기 
$sql = "SELECT * FROM TB WHERE id ='$id'";
$result = mysqli_query($conn, $sql);


$row = mysqli_fetch_array($result);

$hashedPassword = $row['pw'];

// echo $row['id'];
// DB 정보를 가져왔으니 
// 비밀번호 검증 로직을 실행하면 된다.
if (password_verify($password, $hashedPassword)) {
    // 로그인 성공
    // 세션에 id 저장

    $_SESSION['userid'] = $id;

    echo $_SESSION['userid']."님 환영합니다</br>";

?>
    <script>
    alert("로그인에 성공하였습니다.")

        location.replace("./index.php");
    </script> 
<?php     
} else { 
    // 로그인 실패  
?>
    <script> 
        alert("로그인에 실패하였습니다")
                location.href = "index.html";
    </script>
<?php
}   
?>
