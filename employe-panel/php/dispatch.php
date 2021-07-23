<?php
    require_once("../../common-files/php/database.php");
    $id = $_POST['order_id'];
    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $price = $_POST['price'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $date = date('Y-m-d');
    $update_data = "UPDATE purchase SET status = 'dispatched',dispatched_date = '".$date."'  WHERE email = '$email'";
    $response = $db->query($update_data);
    if($response)
    {
        $message = "your order for ".$title." has successfully shipped.
        Delivery address
        ".$full_name."
        ".$address."
        ".$email."
        SMS update sent to
        ".$phone."
        order amount
        ".$price."
        ";
        $check_mail = mail($email,"your order has been successfully shipped.",$message);
        if($check_mail)
        {
            echo "success";
        }
        else{
            echo "unable to notify user";
        }
    }
    else{
        echo "error";
    }

?>