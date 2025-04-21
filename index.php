    <?php
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    else return $_SERVER['REMOTE_ADDR'];
}

$ip = getUserIP();
$time = date("Y-m-d H:i:s");
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Ma'lumotlarni logga yozish
$log = "Time: $time | IP: $ip | User-Agent: $user_agent\n";
file_put_contents("logs.txt", $log, FILE_APPEND);

// JSON javob (optional)
echo json_encode(["status" => "logged"]);
?>
