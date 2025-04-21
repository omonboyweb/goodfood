<?php
header('Content-Type: application/json');

function getUserIP() {
    $headers = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];

    foreach ($headers as $key) {
        if (array_key_exists($key, $_SERVER)) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
    }
    return 'UNKNOWN';
}

$ip = getUserIP();
$time = date("Y-m-d H:i:s");
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Logga yozish
$log = "Time: $time | IP: $ip | User-Agent: $user_agent\n";
file_put_contents(__DIR__ . "/logs.txt", $log, FILE_APPEND);

// JSON javob
echo json_encode(["status" => "logged"]);
?>
