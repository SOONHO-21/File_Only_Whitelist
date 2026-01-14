<?php
    include "../include/session.php";
    include "../include/db_connect.php";

    $num = $_GET["num"];    // 게시글 번호
    $page = $_GET["page"];  // 게시글 소속 페이지

    $ripple_content = $_POST["ripple_content"];
    $ripple_content = htmlspecialchars($ripple_content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i)");

    if(!$userid) {
        echo "
            <script>
                window.alert('댓글 기능은 로그인 후 이용하세요.')
                history.go(-1)
            </script>
            ";
        exit;   // PHP 스크립트 실행 정지하고 탈출
    }

    $stmt = $con->prepare("INSERT INTO ripple (parent, id, name, public_id, content, regist_day) VALUES(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssss', $num, $userid, $username, $public_id, $ripple_content, $regist_day);
    $stmt->execute();

    mysqli_close($con);

    // 목록 페이지로 이동
	echo "<script>
        location.href = 'view.php?num=$num&page=$page';
        </script>";
?>