<?php
    include "./base64_dencode.php";
    
    function verify_jwt(string $jwt): ?array {
        global $secret;

        [$header_b64, $payload_b64, $signature_b64] = explode('.', $jwt);

        $signature_check = base64url_encode(
            hash_hmac('sha256',"$header_b64.$payload_b64", $secret, true)
        );

        if(!hash_equals($signature_check, $signature_b64)) {
            return null;    // 위조된 토큰
        }

        $payload = json_decode(base64url_decode($payload_b64), true);

        if(isset($payload['exp']) && time() >= $payload['exp']) {
            return null;    // 만료된 토큰
        }

        return $payload;
    }
?>