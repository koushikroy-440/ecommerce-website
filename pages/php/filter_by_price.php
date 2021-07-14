<?php
require_once("../../common-files/databases/database.php");
$cat_name = $_POST['cat_name'];
$min = $_POST['min'];
$max = $_POST['max'];
$get_data = "SELECT * FROM products WHERE category_name='$cat_name' AND price BETWEEN $min AND $max";
$response = $db->query($get_data);
$all_data = [];
if($response)
{
    while($data = $response->fetch_assoc())
    {
        array_push($all_data,$data);
    }
    echo json_encode($all_data);
}

?>