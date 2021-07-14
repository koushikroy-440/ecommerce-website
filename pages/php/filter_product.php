<?php
    require_once("../../common-files/databases/database.php");
    $category_name = $_POST['cat_name'];
    $brand_name = $_POST['brand_name'];
    if($brand_name != 'all')
    {
    $get_products = "SELECT * FROM products WHERE category_name='$category_name' AND brands='$brand_name'";
    $response = $db->query($get_products);
    $all_data = [];
    if($response){
        while($data = $response->fetch_assoc()){
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
}
else{
    $get_products = "SELECT * FROM products WHERE category_name='$category_name'";
    $response = $db->query($get_products);
    $all_data = [];
    if($response){
        while($data = $response->fetch_assoc()){
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
}
    

?>