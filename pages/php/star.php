<?php
    require_once("../../common-files/databases/database.php");
    $username = base64_decode($_COOKIE['_au_']);
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $photo = $_FILES['photo'];
    $file = addslashes(file_get_contents($photo['tmp_name']));
    $update_data = "UPDATE purchase SET ratings='$rating',comment='$comment',picture='$file' WHERE product_id = '$product_id' and email = '$username'";
    $response = $db->query($update_data);
    if($response)
    {
        echo "success";
    }
    else{
        echo "can not update ratings";
    }
?>