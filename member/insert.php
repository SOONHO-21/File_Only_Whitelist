<?php
    $id = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $regist_day = date("Y-m-d (H:i)");

    include "../include/db_connect.php";

    $hash_pw = password_hash($pass, PASSWORD_DEFAULT);

	// $sql = "INSERT INTO _mem (id, pass, name, email, regist_day, level)";	// 데이터 삽입 명령
	// $sql .= " values('$id', '$hash_pw', '$name', '$email', '$regist_day', 1)";
	// mysqli_query($con, $sql);	// SQL 명령 실행
    $stmt = $con->prepare("INSERT INTO _mem (id, pass, name, email, regist_day, level) values(?, ?, ?, ?, ?, 1)");
    $stmt->bind_param('sssss', $id, $hash_pw, $name, $email, $regist_day);
    $stmt->execute();
    // $result = mysqli_query($con, $sql);     // 쿼리결과
    
    mysqli_close($con);

    echo "<script>
		location.href = './login_form.php';
		</script>";
?>