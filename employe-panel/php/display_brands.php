<?php
require_once "../../common-files/php/database.php";
$category_name = $_POST['category_name'];
$get_data = "SELECT * FROM brands WHERE category_name = '$category_name'";
$response = $db->query($get_data);
$result = [];
if ($response->num_rows != 0) {
    while ($data = $response->fetch_assoc()) {
        array_push($result, $data);
    }

    echo json_encode($result);
} else {
    echo "<b>No brands has been created in this category</b>";
}
