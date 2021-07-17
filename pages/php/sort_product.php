<?php
require_once("../../common-files/databases/database.php");
if (empty($_COOKIE['_au_'])) {
    header("Location: http://localhost/ecommerce-project\pages\php\login.php");
}
$cat_name = $_POST['category'];
$brand_name = $_POST['brand'];
$sort_by = $_POST['sort_by'];
$all_data = [];
if ($brand_name == "all") {
    if ($sort_by == 'high') {
        $get_data = "SELECT * FROM products WHERE category_name = '$cat_name' ORDER BY price DESC";
        $response = $db->query($get_data);
        if ($response) {
            while ($data = $response->fetch_assoc()) {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    } else if ($sort_by == 'low') {
        $get_data = "SELECT * FROM products WHERE category_name = '$cat_name' ORDER BY price ASC";
        $response = $db->query($get_data);
        if ($response) {
            while ($data = $response->fetch_assoc()) {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    } else if ($sort_by == 'recommended') {
        $get_data = "SELECT * FROM products WHERE category_name = '$cat_name'";
        $response = $db->query($get_data);
        if ($response) {
            while ($data = $response->fetch_assoc()) {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    }
    if ($sort_by == 'new') {
        $get_data = "SELECT * FROM products WHERE category_name = '$cat_name' AND brands = '$brand_name' ORDER BY entry_date DESC";
        $response = $db->query($get_data);
        if ($response) {
            while ($data = $response->fetch_assoc()) {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    }
} else {
    if ($sort_by == 'high') {
        $get_data = "SELECT * FROM products WHERE category_name = '$cat_name' AND brands = '$brand_name' ORDER BY price DESC";
        $response = $db->query($get_data);
        if ($response) {
            while ($data = $response->fetch_assoc()) {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    } else if ($sort_by == 'low') {
        $get_data = "SELECT * FROM products WHERE category_name = '$cat_name' AND brands = '$brand_name' ORDER BY price ASC";
        $response = $db->query($get_data);
        if ($response) {
            while ($data = $response->fetch_assoc()) {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    } else if ($sort_by == 'recommended') {
        $get_data = "SELECT * FROM products WHERE category_name = '$cat_name' AND brands = '$brand_name'";
        $response = $db->query($get_data);
        if ($response) {
            while ($data = $response->fetch_assoc()) {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    }
    if ($sort_by == 'new') {
        $get_data = "SELECT * FROM products WHERE category_name = '$cat_name' AND brands = '$brand_name' ORDER BY entry_date DESC";
        $response = $db->query($get_data);
        if ($response) {
            while ($data = $response->fetch_assoc()) {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    }
}
