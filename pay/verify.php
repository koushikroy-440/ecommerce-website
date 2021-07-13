<?php

require('config.php');

session_start();
$id = $_GET['id'];
$price = $_GET['price'];
$brand = $_GET['brand'];
$title = $_GET['title'];
$quantity = $_GET['quantity'];
$full_name = $_SESSION['name'];
$phone = $_SESSION['mobile'];
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    header("Location:purchase.php?id=".$id."&price=".$price."&brand=".$brand."&title=".$title."&quantity=".$quantity."&name=".$full_name."&phone=".$phone."&mode=online");
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

 echo $html;
 
?>
