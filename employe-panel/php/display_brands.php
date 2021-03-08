<?php
require_once("../../common-files/php/database.php");
$category_name = $_POST['category_name'];
$get_data = "SELECT * FROM brans WHERE category_name = '$category_name'";
$response = $db->query($get_data);
$result = [];
while($data = $response -> fetch_assoc())
{
     array_push($result, $data);
}

echo json_encode($result);
?>