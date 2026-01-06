<?php
    include "../include/session.php";
    include "../include/db_connect.php";

    $id = $_GET["id"];

    $pass = $_POST["pass"];
    $hash_pw = password_hash($pass, PASSWORD_DEFAULT);

    $name = $_POST["name"];
    $email = $_POST["email"];

    if(isset($_FILES['profile_img']) && $_FILES['profile_img']['name'] != "") {     // modify_form.php에서 <input type="file" name="profile_img"> 코드에 근거. 프로필 사진이 있을 경우
        $upload_dir = "./profile_upload/";
        $file_name = $_FILES['profile_img']['name'];
        $file_tmp = $_FILES['profile_img']['tmp_name'];

        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = $id."_".time().".".$file_ext;

        move_uploaded_file($file_tmp, $upload_dir.$new_name);

        $stmt = $con->prepare("UPDATE _mem SET pass = ?, name = ?, email = ?, profile_img = ? WHERE id=?");
        $stmt->bind_param('sssss', $hash_pw, $name, $email, $new_name, $userid);
        $stmt->execute();
    } else {
        $stmt = $con->prepare("UPDATE _mem SET pass = ?, name = ?, email = ? WHERE id=?");
        $stmt->bind_param('ssss', $hash_pw, $name, $email, $userid);
        $stmt->execute();
    }

    // $sql = "UPDATE board SET name = '$name' WHERE id='$userid'";
    $stmt = $con->prepare("UPDATE board SET name = ? WHERE id=?");
    $stmt->bind_param('ss', $name, $userid);
    $stmt->execute();
    
    // mysqli_query($con, $sql);

    mysqli_close($con);

    // 목록 페이지로 이동
    echo "<script>
        location.href = '../index.php';
        </script>"
?>