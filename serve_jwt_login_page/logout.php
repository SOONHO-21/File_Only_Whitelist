<?php
setcookie("jwt", "", time() - 3600); // 'jwt' 쿠키를 삭제

echo "<script>
        location.href = './login_form.php';
    </script>";
?>