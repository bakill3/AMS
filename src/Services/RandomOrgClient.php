<?php

class RandomOrgClient {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getRandomIntegers($num, $min, $max) {
        $url = 'https://api.random.org/json-rpc/4/invoke';
        $data = [
            'jsonrpc' => '2.0',
            'method' => 'generateIntegers',
            'params' => [
                'apiKey' => $this->apiKey,
                'n' => $num,
                'min' => $min,
                'max' => $max,
                'replacement' => true
            ],
            'id' => 0
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/json",
                'method' => 'POST',
                'content' => json_encode($data),
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $jsonResult = json_decode($result, true);

        return $jsonResult['result']['random']['data'] ?? null;
    }
}

function encryptMessage($message, $randomIntegers) {
    $encrypted = '';
    foreach (str_split($message) as $index => $char) {
        $shift = $randomIntegers[$index % count($randomIntegers)];
        $encrypted .= chr(ord($char) + $shift);
    }
    return base64_encode($encrypted); // Base64 encoding
}

function decryptMessage($encryptedMessage, $randomIntegers) {
    $message = base64_decode($encryptedMessage);
    $decrypted = '';
    foreach (str_split($message) as $index => $char) {
        $shift = $randomIntegers[$index % count($randomIntegers)];
        $decrypted .= chr(ord($char) - $shift);
    }
    return $decrypted;
}
