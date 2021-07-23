<?php
    require_once("../common-files/php/database.php");
    $id = $_GET['id'];
    $price = $_GET['price'];
    $brand = $_GET['brand'];
    $title = $_GET['title'];
    $quantity = $_GET['quantity'];
    // echo $quantity;
    $full_name = "";
    $phone = "";
    $username = base64_decode($_COOKIE['_au_']);
    $address = "";
    $state = "";
    $country = "";
    $mode = $_GET['mode'];
    $pin_code = "";
    $date = date("Y-m-d");
    $time = time('H-i-s');
    $stock = "";
    $message = "";
    //get stocks 
    $get_stocks = "SELECT quantity FROM products WHERE id = '$id' AND brands = '$brand'";
    $response = $db->query($get_stocks);
    if($response)
    {
        $data = $response->fetch_assoc();
        $stock = $data['quantity'] - $quantity;

    }
    $get_data = "SELECT * FROM users WHERE  email = '$username'";
    $response = $db->query($get_data);
    if($response){
        $data = $response->fetch_assoc();
        $address = $data['address'];
        $state = $data['state'];
        $country = $data['country'];
        $pin_code = $data['pincode'];
        $full_name = $data['firstname'] + $data['lastname'];
        $phone = $data['mobile'];
        $purchase_entry = "SELECT * FROM purchase";
        $response = $db->query($purchase_entry);
        if($response){
            $insert_data = "INSERT INTO purchase (product_id,title,quantity,brand,price,fullname,email,phone,address,country,pincode,state,purchase_date,purchase_time,payment_mode)
                VALUES('$id','$title','$quantity','$brand','$price','$full_name','$username','$phone','$address','$country','$pin_code','$state','$date','$time','$mode');
                ";
                $response = $db->query($insert_data);
                if($response){
                    //delete product form cart table
                     $delete_cart = "DELETE FROM cart WHERE product_id = '$id' AND username = '$username'";
                     $response = $db->query($delete_cart);
                     if($response){
                         //update stocks
                         $update = "UPDATE products SET quantity = '$stock' WHERE title  = '$title' AND brands = '$brand'";
                         $response = $db->query($update);
                         if($response){
                             $message = "success";
                         } 
                         else{
                             $message = "unable to update stock";
                         }
                     }
                     else{
                         $message = "success";
                     }
                }
                else{
                    $message = "unable to insert data in purchase table ***";
                }
        }
        else{
            $create_table = "CREATE TABLE purchase(
                id INT(11) NOT NULL AUTO_INCREMENT,
                product_id INT(25),
                title VARCHAR(150),
                quantity VARCHAR(10),
                brand VARCHAR(150),
                price INT(50),
                fullname VARCHAR(150),
                email VARCHAR(50),
                phone INT(20),
                address VARCHAR(250),
                state VARCHAR(50),
                country VARCHAR(150),
                pincode INT(10),
                payment_mode VARCHAR(50),
                purchase_date DATE,
                purchase_time TIME,
                ratings INT(6) DEFAULT 0,
                comment MEDIUMTEXT NULL,
                picture MEDIUMBLOB,
                status VARCHAR(50) DEFAULT 'processing',
                dispatched_date DATE NULL,
                PRIMARY KEY(id)
            )";
            $response = $db->query($create_table);
            if($response){
                $insert_data = "INSERT INTO purchase(product_id,title,quantity,brand,price,fullname,email,phone,address,country,pincode,state,purchase_date,purchase_time,payment_mode)
                VALUES('$id','$title','$quantity','$brand','$price','$full_name','$username','$phone','$address','$country','$pin_code','$state','$date','$time','$mode');
                ";
                $response = $db->query($insert_data);
                if($response){
                     //delete product form cart table
                     $delete_cart = "DELETE FROM cart WHERE product_id = '$id' AND username = '$username'";
                     $response = $db->query($delete_cart);
                     if($response){
                         //update stocks
                         $update = "UPDATE products SET quantity = '$stock' WHERE title  = '$title' AND brands = '$brand'";
                         $response = $db->query($update);
                         if($response){
                             $message = "success";
                         } 
                         else{
                             $message = "unable to update stock";
                         }
                     }
                     else{
                         $message = "success";
                     }
                }
                else{
                    $message = "unable to insert data in purchase table";
                }
                
            }
            else{
                echo "unable to create table";
            }
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body class="bg-light">
      
      <?php
             include_once("../asset/nav.php");
             $full_name = $_SESSION['name'];
             $phone = $_SESSION['mobile'];
      ?>
      <div class="container" style="margin-top:100px">
        <div class="jumbotron bg-white border-top border-bottom border-right" style="border-left:4px solid green">
            <center>
                <?php
                    if($message == "success")
                    {
                       echo ' <i class="fa fa-check-circle" aria-hidden="true" style="font-size: 100px;color: green"></i>';
                         
                    }
                    else{
                       echo ' <i class="fa fa-times-circle" aria-hidden="true" style="font-size: 100px;color: red"></i>';

                    }
                               
                ?>
                             <h2><?php echo $message; ?></h2>
                             <p>FOR MORE INFO OPEN YOUR EMAIL</p>
                             <button type="button" class="btn btn-success" href="http://localhost/ecommerce-project/index.php?">purchase more</button>
            </center>
        
        </div>
      
      </div>
      <?php
        include_once("../asset/footer.php");
      ?>

  </body>
</html>