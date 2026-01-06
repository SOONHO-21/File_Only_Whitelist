<?php
    include "./base64_dencode.php";

    function create_jwt(array $payload, string $secret): string {
        $header = ['alg' => 'sha256', 'typ' => 'jwt'];
        $header_encoded = base64url_encode(json_encode($header));
        $payload_encoded = base64url_encode(json_encode($payload));

        $signature = hash_hmac('sha256', "$header_encoded.$payload_encoded", $secret, true);
        $signature_encoded = base64url_encode($signature);  // 시그니처 만들기

        return "$header_encoded.$payload_encoded.$signature_encoded";   // 생성한 JWT 토큰 반환
    }

    $id   = $_POST["id"];
    $pass = $_POST["pass"];

    include "../include/db_connect.php";

    if(isset($id) && isset($pass)) {
        $hash_pw = hash('sha256', $pass);

        $sql = "SELECT * from _mem WHERE id='$id' AND pass='$hash_pw'";
        $result = mysqli_query($con, $sql);     // 쿼리결과

        $num_match = mysqli_num_rows($result);  // 쿼리결과는 0개 아니면 1개
        $row = mysqli_fetch_assoc($result);     // 쿼리 결과 컬럼 추출

        if($num_match == 1) {     // ID, PASS 맞음
            $token = create_jwt([   // JWT 토큰생성
                'num' => $row["num"],
                'id' => $row["id"],
                'name' => $row["name"]
            ], $secret);

            $expiration = time() + (86400 * 30);    // 30일 동안 유효한 쿠키
            setcookie('jwt', $token, $expiration);

            echo "<script>
                    location.href = './main.php';
                </script>";
        }
        else {
            echo "<script>
                    window.alert('아이디 혹은 비밀번호가 틀립니다.')
                    history.go(-1)
                </script>";
            exit;
        }
        mysqli_close($con);
    }
?>