<?php
$xorkey = "PERUSAL-2017-06-26";
$sharedsalt = "32e8419a7ecb8f918c70fdadf783e3d87794fc517590053809f758b7e16d87ed";

function text2ascii($text) {
    return array_map('ord', str_split($text));
}

function xorcipher($plaintext, $key) {
    $key = text2ascii($key);
    $plaintext = text2ascii($plaintext);
    $keysize = count($key);
    $input_size = count($plaintext);
    $cipher = "";

    for ($i = 0; $i < $input_size; $i++) {
        $cipher .= chr($plaintext[$i] ^ $key[$i % $keysize]);
    }
    return $cipher;
}

function base64url_decode($data) { 
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 

if(!isset($_GET["a"]) || !isset($_GET["b"]) || !isset($_GET["c"]) || !isset($_GET["d"]) || !isset($_GET["e"])) { die("lol"); }

$ipaddr = xorcipher(base64url_decode($_GET["a"]), $xorkey);
$port = xorcipher(base64url_decode($_GET["b"]), $xorkey);
$type = xorcipher(base64url_decode($_GET["c"]), $xorkey);
$time = xorcipher(base64url_decode($_GET["d"]), $xorkey);
$batch = xorcipher(base64url_decode($_GET["e"]), $xorkey);
$validity = xorcipher(base64url_decode($_GET["v"]), $xorkey);
$built_string = $ipaddr.$time.$sharedsalt;
$validity_should_be = md5($built_string);
if(strcmp($validity,$validity_should_be) != 0) { die(); }


require_once('panel/reuse/config.php');

$dsn = "mysql:host=".PERUSAL_MYSQL_HOST.
";dbname=".PERUSAL_MYSQL_DB.
";charset=".PERUSAL_MYSQL_CHARSET.
";port=".PERUSAL_MYSQL_PORT;

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$db = new PDO($dsn, PERUSAL_MYSQL_USER, PERUSAL_MYSQL_PASS, $opt);

$stmt = $db->prepare("INSERT INTO proxies(entryip, entryport, entrytype, entrytime, exitip, exittime, batchcode) VALUES(?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$ipaddr, $port, $type, $time, $_SERVER['REMOTE_ADDR'], time(), $batch]);

?>