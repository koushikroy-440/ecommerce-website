<?php
    require_once ("../../common-files/php/database.php");
    $id = $_POST['id'];
    $delete_row = "DELETE FROM header_showcase WHERE id = '$id' ";
    $response = $db->query($delete_row);
    if ($response)
    {
        echo "success";
    }
    else {
        echo "unable to delete";
    }


?>