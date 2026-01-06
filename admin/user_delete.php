<?php
include "../include/db_connect.php";
include "admin_check.php";

$num = $_GET['num'];

$sql = "DELETE FROM _mem WHERE num=$num";
mysqli_query($con, $sql);

mysqli_close($con);
echo "<script>alert('사용자 데이터가 삭제되었습니다.');location.href='user_list.php';</script>";