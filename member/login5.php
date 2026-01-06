<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];

    include "../include/db_connect.php";

    if(isset($id) && isset($pass)) {
        $hash_pw = hash('sha256', $pass);

        // $sql = "
        //     SELECT * FROM _mem
        //     WHERE id='$id'
        //     AND pass='$hash_pw'
        // ";  // 개행 추가
        $stmt = $con->prepare("SELECT * from _mem WHERE id=?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        // $result = mysqli_query($con, $sql);     // 쿼리 결과
        $result = $stmt->get_result();

        // $num_match = mysqli_num_rows($result);  // 쿼리 결과는 0개 아니면 1개
        // $row = mysqli_fetch_assoc($result);     // 쿼리 결과 컬럼 추출
        $row = $result->fetch_assoc();

        if($row && password_verify($pass, $row['pass'])) {
            // 세션값 설정
            session_start();
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];

            echo "<script>
                     location.href = '../mboard/list.php';
                 </script>";
        }
        else {
            echo "<script>
                    window.alert('아이디 혹은 비밀번호가 틀립니다.')
                    history.go(-1)
                </script>";
            exit;
        }
    }
    mysqli_close($con);
?>