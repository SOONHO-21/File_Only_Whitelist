<?php
include "../include/db_connect.php";
include "admin_check.php";

$sql = "SELECT num, name, subject, regist_day FROM board ORDER BY num DESC";
$result = mysqli_query($con, $sql);
?>
<h2>게시판 관리</h2>
<table>
<tr><th>번호</th><th>제목</th><th>작성자</th><th>등록일</th><th>관리</th></tr>
<?php while($row = mysqli_fetch_assoc($result)) {?>
<tr>
    <td><?=$row['num']?></td>
    <td><?=$row['name']?></td>
    <td><?=$row['subject']?></td>
    <td><?=$row['regist_day']?></td>
    <td><a href="board_delete.php?num=<?=$row['num']?>" onclick="return confirm('정말 삭제하시겠습니까?')">글 삭제</a></td>
</tr>
<?php } ?>
</table>