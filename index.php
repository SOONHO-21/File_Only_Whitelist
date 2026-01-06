<?php
    include "./include/session.php";

    if($userid)
        echo "<a href='./member/logout.php'>로그아웃<a>";
    else
        echo "<a href='./member/login_form.php'>로그인<a>";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<meta http-equiv="refresh" content="0;url=./mboard/list.php">
<title>PHP+MYSQL 웹 사이트</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
</body>
</html>