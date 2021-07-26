<?php
require_once("../../common-files/php/database.php");
$get_category = "SELECT * FROM category";
$response = $db->query($get_category);
$category_list = [];
if ($response) {
    while ($data = $response->fetch_assoc()) {
        // $category_list = [$data['id'],$data['category_name']];
        // echo json_encode($category_list);
        array_push($category_list, $data);
    }
    echo json_encode($category_list);
} else {
    echo "no category table found";
}
