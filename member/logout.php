<?php
session_start();

if(isset($_SESSION["userid"])) {
    unset($_SESSION["userid"]);
}

echo "<script>
        location.href = '../index.php';
    </script>"
?>