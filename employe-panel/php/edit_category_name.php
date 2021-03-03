<?php
    require_once("../../common-files/php/database.php");
    $id = $_POST['id'];
    $change_name = $_POST['change_name'];
    $update_data = "UPDATE category SET category_name = '$change_name' WHERE id = '$id' ";
    if($db->query($update_data))
    {
        echo "success";
    }
    else{
        echo "unable to change category name";
    }
?>