<?php
    function base64url_encode(string $data): string {
        // 일반적인 변형은 'URL 경로 세그먼트'나 '쿼리 매개변수'에서 문제를 일으킬 수 있는 문자를 피하기 위해 패딩을 생략하고 '+/'를 '-_'로 바꾸는 "Base64 URL 안전"
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function base64url_decode(string $data): string {
        return base64_decode(strtr($data, '-_', '+/'));     // 인코딩 때 '+/' -> '-_' 이렇게 바꾸었으니 디코딩은 역으로 수행
    }

    $secret = 'my-secret-key';
?>