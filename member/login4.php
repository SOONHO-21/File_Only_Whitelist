<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];

    include "../include/db_connect.php";

    if(isset($id) && isset($pass)) {
        // $sql = "SELECT * from _mem WHERE id='$id'"; // 아이디가 존재하는지 부터 체크
        $stmt = $con->prepare("SELECT * from _mem WHERE id=?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        // $result = mysqli_query($con, $sql); // 쿼리결과
        $result = $stmt->get_result();

        // $num_match = mysqli_num_rows($result);  // 쿼리결과는 0개 아니면 1개
        $row = $result->fetch_assoc();

        // if(!$num_match) {
        //     echo "<script>
        //             window.alert('아이디 혹은 비밀번호가 틀립니다.')
        //             history.go(-1)
        //         </script>";
        // }
        // else {
        //     $row = mysqli_fetch_assoc($result);
        //     $db_pass = $row["pass"];    // DB에 저장된, '맞는' 비밀번호

        //     $hash_pw = hash('sha256', $pass);

        //     mysqli_close($con);

        //     if($hash_pw == $db_pass) {     // 데이터를 비교
        //         // 세션값 설정
        //         session_start();
        //         $_SESSION["userid"] = $row["id"];
        //         $_SESSION["username"] = $row["name"];
        //         $_SESSION["userlevel"] = $row["level"];

        //         echo "<script>
        //                 location.href = '../mboard/list.php';
        //             </script>";
        //     }
        //     else {
        //         echo "<script>
        //                 window.alert('아이디 혹은 비밀번호가 틀립니다.')
        //                 history.go(-1)
        //             </script>";
        //     }
        // }

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