<?php
include "../include/db_connect.php";
include "admin_check.php";

$num = $_GET['num'];

$stmt = $con->prepare("DELETE FROM board WHERE num = ?");
$stmt->bind_param('i', $num);
$stmt->execute();

mysqli_close($con);

echo "<script>alert('게시글이 삭제되었습니다.');location.href='board_list.php';</script>";