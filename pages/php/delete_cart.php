<?php
    require_once("../../common-files/databases/database.php");
    $product_id = $_POST['id'];
    $username = base64_decode($_COOKIE['_au_']);
    $delete_query = "DELETE FROM cart WHERE product_id = '$product_id' AND username = '$username'";
    $response = $db->query($delete_query);
    if($response)
    {
        echo "success";
    }
?>