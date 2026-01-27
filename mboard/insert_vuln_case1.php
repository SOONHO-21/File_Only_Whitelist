<?php
    include "../include/session.php";

    if(!$userid) {
        echo "
            <script>
                alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                history.go(-1);
            </script>
        ";
        exit;
    }

    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $is_html = $_POST['is_html'] ?? 'n';    // HTML 쓰기

    $subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');  // XSS 방어. HTML 특수문자 변환

    if($is_html !== 'y'){
        $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    }

    $regist_day = date("Y-m-d (H:i)");

    $upload_dir = './data/';    // 첨부파일 저장 디렉토리
    $upload_dir = realpath($upload_dir);

    $allowed_Extensions = ['txt', 'jpg', 'jepg', 'webp', 'png', 'hwp', 'pdf', 'docx', 'doc', 'docm']; // 화이트리스트로 허용할 확장자
    $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif', 'text/plain');

    # 원래는 이렇게 되어야 맞다.
    // $fileExtension = strtolower(pathinfo($_FILES['upfile']['name'], PATHINFO_EXTENSION));   // 소문자로 파일명 변환 후 확장자 추출
    // $fileName = basename($_FILES['upfile']['name']);     // 파일 이름 추출

    $upfile_name = $_FILES['upfile']['name'];
    $upfile_tmp_name = $_FILES['upfile']["tmp_name"];
    $upfile_type = $_FILES['upfile']["type"];
    $upfile_size = $_FILES['upfile']["size"];
    $upfile_error = $_FILES['upfile']["error"];

    if($upfile_name && !$upfile_error) {
        # 취약한 구현
        $file = explode(".", $upfile_name);     // 업로드 파일명과 확장자 분리. 배열 형태로 $file에 저장
        $fileExtension = $file[1];

        $random_num = bin2hex(random_bytes(8));
        $copied_file_name = $random_num . "_" . $upfile_name;   // 파일명을 올바르게 바꾸지도 않음

        if(!in_array($fileExtension, $allowed_Extensions) || !in_array($upfile_type, $allowed_mime_types)) {     // 확장자 필터링
            echo "
                <script>
                    alert('허용되지 않는 확장자입니다. 파일 업로드를 차단합니다.');
                    history.go(-1);
                </script>
            ";
            exit;
        }
        else if($upfile_size > 10000000) {  // 파일 용량 필터링
            echo "
                <script>
                    alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
                    history.go(-1);
                </script>
            ";
            exit;
        }
        else {
            // 확장자가 블랙리스트에 없고, 파일 사이즈가 10MB이하면 업로드 진행
            $uploaded_file = $upload_dir . DIRECTORY_SEPARATOR . $copied_file_name;
            if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                echo"
                    <script>
                        alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                    </script>
                ";
                exit;
            }
        }
    }
    else {
        $upfile_name      = "";
		$upfile_type      = "";
		$copied_file_name = "";
    }

    include "../include/db_connect.php";

    $stmt = $con->prepare("INSERT INTO board (id, name, public_id, subject, content, is_html, regist_day, file_name, file_type, file_copied) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssssss', $userid, $username, $public_id, $subject, $content, $is_html, $regist_day, $upfile_name, $upfile_type, $copied_file_name);

    $stmt->execute();

    mysqli_close($con);

    // 목록 페이지로 이동
    echo "<script>
            location.href = 'list.php';
        </script>"
?>