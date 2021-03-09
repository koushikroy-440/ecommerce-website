<?php
    require_once("../../common-files/php/database.php");
    $c_name = $_POST['c_name'];
    $b_name = $_POST['b_name'];
    $delete_row = "DELETE FROM brands WHERE category_name = '$c_name' AND brands = '$b_name'";
    $response = $db->query($delete_row);
    if($response)
    {
        echo "<b>Delete Success</b>";
    }
    else{
        echo "<b>Unable to Delete Brands Row</b>";
    }
?>