<?php
include "../include/db_connect.php";
include "admin_check.php";

$num = $_GET['num'];

$stmt = $con->prepare("DELETE FROM _mem WHERE num = ?");
$stmt->bind_param('i', $num);
$stmt->execute();

// mysqli_query($con, $sql);

// mysqli_close($con);
echo "<script>alert('사용자 데이터가 삭제되었습니다.');location.href='user_list.php';</script>";