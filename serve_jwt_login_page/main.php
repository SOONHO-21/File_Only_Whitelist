<?php
    include "./verify_jwt.php";

    if(!isset($_COOKIE['jwt']) || $_COOKIE['jwt'] == null) {
        echo "<script>
                window.alert('로그인하세요.')
                location.href = './login_form.php';
            </script>";
        exit;
    } else {
        $token = $_COOKIE['jwt'];

        $data = verify_jwt($token);

        if($data) {
            echo "쿠키의 값: ".$_COOKIE['jwt'];
        } else {
            echo "<script>
                    window.alert('유효하지 않은 쿠키입니다.')
                    location.href = './login_form.php';
                </script>";
                setcookie("", "", time() - 3600, "/");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <button type="button" class="navyBtn" onClick="location.href='./logout.php'">로그아웃</button>
</body>
</html>