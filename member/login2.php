<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];

    include "../include/db_connect.php";

    $sql = "SELECT * from _mem WHERE id='$id'"; // 아이디가 존재하는지 부터 체크
    $result = mysqli_query($con, $sql); // 쿼리결과

    $num_match = mysqli_num_rows($result);  // 쿼리결과는 0개 아니면 1개

    if(!$num_match) {
        echo "<script>
                window.alert('아이디 혹은 비밀번호가 틀립니다.')
                history.go(-1)
            </script>";
    }
    else {
        $row = mysqli_fetch_assoc($result);
        $db_pass = $row["pass"];    // DB에 저장된, '맞는' 비밀번호

        mysqli_close($con);

        if($pass != $db_pass) {     // 데이터를 비교
            echo "<script>
                    window.alert('아이디 혹은 비밀번호가 틀립니다.')
                    history.go(-1)
                </script>";
            exit;
        }
        else {
            // 세션값 설정
            session_start();
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];

            echo "<script>
                    location.href = '../mboard/list.php';
                </script>";
        }
    }
?>