<?php
require_once "../../common-files/databases/database.php";
$check_table = "SELECT id,brand_name,domain_name,brand_email,facebook,instagram,address,phone,about_us,privacy_policy,terms_conditions,cookies FROM branding";
$response = $db->query($check_table);
$all_data = [];
if ($response) {
    $data = $response->fetch_assoc();
    array_push($all_data, $data);
    echo json_encode($all_data);
}
