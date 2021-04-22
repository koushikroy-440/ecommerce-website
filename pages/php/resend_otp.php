<?php
require('textlocal.class.php');
require_once("../../common-files/databases/database.php")
$mobile = $_POST['mobile'];
$email = strrchr($mobile,'@');
if($email) {
    $get_data = "SELECT mobile FROM users WHERE email='$mobile'";
    $response = $db->query($get_data);
    if($response)
    {
        $data = $response->fetch_assoc();
        $mobile = $data['mobile'];
    }
}
 session_start();
$textlocal = new Textlocal(false,false,'NTg1ODRkZTA2YmYwN2Y5YWFiYzQ4MmY1NjU4Njc3YWI=');

$numbers = array($mobile);
$sender = 'TXTLCL';
$otp = rand(564897,565897);
$_SESSION['otp'] = $otp;
$message = 'your otp is'.$otp;

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    echo "success";
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}

$otp = 123456;
$_SESSION['otp'] = $otp;
echo "success";
?>