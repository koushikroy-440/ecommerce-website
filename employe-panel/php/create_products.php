<?php
require_once "../../common-files/php/database.php";
$dir;

$c_name = $_GET['c_name'];
$product_title = $_POST['title'];

$product_description = $_POST['product-description'];

$brands = $_POST['brands'];
$message = "";
$date = date("Y-m-d");
//get category name
$get_cat_name = "SELECT category_name FROM brands WHERE brands = '$brands'";
$response = $db->query($get_cat_name);
if ($response) {
    $data = $response->fetch_assoc();
}
$price = $_POST['price'];

$quantity = $_POST['quantity'];

$get_data = "SELECT * FROM products";

$response = $db->query($get_data);

$all_files = [$_FILES['thumb'], $_FILES['front'], $_FILES['back'], $_FILES['left'], $_FILES['right']];
$file_path = ['thumb_pic', 'front_pic', 'back_pic', 'left_pic', 'right_pic'];
$length = count($all_files);

$check_dir = is_dir("../../stocks/" . $data['category_name'] . "/" . $brands . "/" . $product_title);
if ($check_dir) {
    echo "folder already exist";
    exit;
} else {
    $dir = mkdir("../../stocks/" . $data['category_name'] . "/" . $brands . "/" . $product_title);
}

if ($response) {
    $store_data = "INSERT INTO products(category_name,title,brands,description,price,quantity,entry_date)
        VALUES('$c_name','$product_title','$brands','$product_description','$price','$quantity','$date');
        ";
    $response = $db->query($store_data);
    if ($response) {
        $current_id = $db->insert_id;
        if ($dir) {
            for ($i = 0; $i < $length; $i++) {
                $file = $all_files[$i];

                $file_name = $file['name'];

                $location = $file['tmp_name'];
                $current_url = "stocks/" . $data['category_name'] . "/" . $brands . "/" . $product_title . "/" . $file_name;
                if (move_uploaded_file($location, "../../stocks/" . $data['category_name'] . "/" . $brands . "/" . $product_title . "/" . $file_name)) {
                    $update_path = "UPDATE products SET $file_path[$i] = '$current_url' WHERE id = '$current_id' ";
                    $response = $db->query($update_path);
                    if ($response) {
                        $message = "success";

                    } else {
                        $message = "unable to update file path";

                    }
                }
            }
            echo $message;
        }
    } else {
        echo "unable to store data product table";
    }
} else {
    $create_table = "CREATE TABLE products(
                id INT NOT NULL AUTO_INCREMENT,
                category_name VARCHAR(50),
                brands VARCHAR(50),
                title VARCHAR(100),
                description VARCHAR(200),
                price FLOAT(20),
                quantity INT(10),
                thumb_pic VARCHAR(100) NULL,
                front_pic VARCHAR(100) NULL,
                back_pic VARCHAR(100) NULL,
                left_pic VARCHAR(100),
                right_pic VARCHAR(100) NULL,
                entry_date DATE NULL,
                PRIMARY KEY (id)
            )";

    $response = $db->query($create_table);
    if ($response) {
        $store_data = "INSERT INTO products(category_name,title,brands,description,price,quantity,entry_date)
                VALUES('$c_name','$product_title','$brands','$product_description','$price','$quantity','$date');
                ";
        $response = $db->query($store_data);
        if ($response) {
            $current_id = $db->insert_id;
            if ($dir) {
                for ($i = 0; $i < $length; $i++) {
                    $file = $all_files[$i];

                    $file_name = $file['name'];

                    $location = $file['tmp_name'];
                    $current_url = "stocks/" . $data['category_name'] . "/" . $brands . "/" . $product_title . "/" . $file_name;
                    if (move_uploaded_file($location, "../../stocks/" . $data['category_name'] . "/" . $brands . "/" . $product_title . "/" . $file_name)) {
                        $update_path = "UPDATE products SET $file_path[$i] = '$current_url' WHERE id = '$current_id' ";
                        $response = $db->query($update_path);
                        if ($response) {
                            $message = "success";

                        } else {
                            $message = "unable to update file path";

                        }
                    }
                }
                echo $message;
            }
        } else {
            echo "unable to store data in products table";
        }
    } else {
        echo "unable to store data in table";
    }
}
