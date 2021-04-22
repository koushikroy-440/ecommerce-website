<?php
// require('textlocal.class.php');

 session_start();
// $textlocal = new Textlocal(false,false,'NTg1ODRkZTA2YmYwN2Y5YWFiYzQ4MmY1NjU4Njc3YWI=');

// $numbers = array($mobile);
// $sender = 'TXTLCL';
// $otp = rand(564897,565897);
// $_SESSION['otp'] = $otp;
// $message = 'your otp is'.$otp;

// try {
//     $result = $textlocal->sendSms($numbers, $message, $sender);
//     echo "success";
// } catch (Exception $e) {
//     die('Error: ' . $e->getMessage());
// }

$otp = 123456;
$_SESSION['otp'] = $otp;
echo "success";
?>