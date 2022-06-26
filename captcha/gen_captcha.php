<?php
session_start();
include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
$captcha_url = $_SESSION['captcha']['image_src'];
$captcha_code = $_SESSION['captcha']['code'];
echo $captcha_url;
?>
