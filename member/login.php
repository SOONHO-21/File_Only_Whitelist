<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];

    include "../include/db_connect.php";

    if(isset($id) && isset($pass)) {
        $sql = "SELECT * from _mem WHERE id='$id' AND pass='$pass'";
        $result = mysqli_query($con, $sql);     // 쿼리결과

        $num_match = mysqli_num_rows($result);  // 쿼리결과는 0개 아니면 1개
        $row = mysqli_fetch_assoc($result);     // 쿼리 결과 컬럼 추출

        $user = $result->fetch_assoc();

        mysqli_close($con);

        if($num_match == 1) {     // 데이터를 비교
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
?>