<?php 
error_reporting(E_ALl);
require __DIR__ . "/vendor/autoload.php";
$qrcode = new QrReader('115.jpg');
$text = $qrcode->text();
print_r($text);
?>
