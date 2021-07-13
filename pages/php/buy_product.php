<?php
require_once("../../common-files/databases/database.php");
if (empty($_COOKIE['_au_'])) {
    header("Location:../../signin.php");
    exit;
}
$id =  $_GET['product-id'];
$username = base64_decode($_COOKIE['_au_']);
$get_product = "SELECT * FROM products WHERE id = '$id' ";
$response = $db->query($get_product);
$title = "";
$brand = "";
$price = "";
$description = "";
$category = "";
$stocks = "";
$thumb_pic = "";
$front_pic = "";
$back_pic = "";
$left_pic = "";
$right_pic = "";
if ($response) {
    $data = $response->fetch_assoc();
    $title = $data['title'];
    $brand = $data['brands'];
    $price = $data['price'];
    $description = $data['description'];
    $category = $data['category_name'];
    $stocks = $data['quantity'];
    $thumb_pic = $data['thumb_pic'];
    $front_pic = $data['front_pic'];
    $back_pic = $data['back_pic'];
    $left_pic = $data['left_pic'];
    $right_pic = $data['right_pic'];
}
$cart_btn = "";
$check_cart = "SELECT * FROM cart WHERE product_id = '$id' AND username = '$username'";
$query = $db->query($check_cart);
if ($query->num_rows != 0) {
    $cart_btn = "";
} else {

    $cart_btn = "<button class='btn btn-success cart-btn' product-id='" . $data['id'] . "' product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-cart'></i> ADD TO CART</button>";
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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
</head>

<body style="background-color: #ddd">

    <?php
    include_once("../../asset/nav.php");
    $pincode = $_SESSION["pincode"];
    $check_pincode = "SELECT * FROM delivery_area WHERE pincode = '$pincode'";
    $response = $db->query($check_pincode);
    $buy_btn = "";
    $cod_btn = "";
    if ($response->num_rows != 0) {
        $data = $response->fetch_assoc();
        if ($data['payment_mode'] == "all") {
            $cod_btn = '<input type="radio" name="pay-mode" value="cod"> CASH ON DELIVERY';
        } else {
            $cod_btn = "";
        }
        if ($stocks != 0) {
            $buy_btn = '<button class="btn btn-primary purchase-btn" product-id=" ' . $id . ' " product-title="' . $title . '" product-brand="' . $brand . '" product-price="' . $price . '">BUY NOW</button>';
        } else {
            $buy_btn = '<button class="btn btn-light border shadow-sm">OUT OF STOCK</button>';
        }
    } else {
        $buy_btn = '<button class="btn btn-primary">Oops! this product is not available in your area.</button>';
    }

    ?>
    <div class="container" style="margin-top: 80px; margin-bottom:40px;">
        <a href="#" class="text-capitalize"><?php echo $category ?></a>
        >
        <a href="#" class="text-capitalize"><?php echo $brand ?></a>
        >
        <a href="#" class="text-capitalize"><?php echo $title ?></a>


        <div class="row mt-2 rounded">
            <div class="col-md-6 bg-white border " align="center">
                <img src="<?php echo "../../".$front_pic;?>" width="180" class="mt-3 mb-3 preview">
                <br>
                <img src="<?php echo "../../".$back_pic;?>" width="80" height="164" class="border shadow-sm mb-2 ml-2 thumb-pic">
                <img src="<?php echo "../../".$left_pic;?>" width="80" height="164" class="border shadow-sm mb-2 ml-2 thumb-pic">
                <img src="<?php echo "../../".$right_pic;?>" width="80" height="164" class="border shadow-sm mb-2 ml-2 thumb-pic">            
            </div>
            <div class="col-md-6 bg-white p-4" style="border-left: 2px solid #ddd;">
                <h5 class="p-0 m-0 text-uppercase"><?php echo $title ?></h5>
                <p class="p-0 m-0 text-capitalize"><?php echo $brand ?></p>
                <p class="p-0 m-0 mb-3"><i class="fa fa-rupee"></i> <?php echo $price ?></p>
                <h4 class="p-0 m-0">DESCRIPTION</h4>
                <p class="p-0 m-0"><?php echo $description ?></p>
                <h4 class="m-0 p-0 mb-2">QUANTITY</h4>
                <?php
                if ($stocks <= 5) {
                    echo "<p class='text-success font-weight-bold'>only <span class='stocks'>" . $stocks . "</span> left.</p>";
                } else {
                    echo "<p class='text-success d-none font-weight-bold'>only <span class='stocks'>" . $stocks . "</span> left.</p>";
                }
                ?>
                <input type="number" class="form-control quantity mb-3" style="width: 80px;" value="1">
                <h4>PAY MODE</h4>
                <div class="mb-2">
                    <input type="radio" name="pay-mode" value="online"> ONLINE <br>
                    <?php echo $cod_btn ?>
                </div>
                <div>
                    <?php echo $cart_btn ?>
                    <?php echo $buy_btn ?>
                </div>
                <h4>check product availability</h4>
                <div class="input-group w-75">
                    <input type="number" class="form-control pin-input" maxlength="6">
                    <div class="input-group-prepend pin_code_field" placeholder="pincode">
                        <button class="btn btn-success pincode-btn">proceed</button>
                    </div>
                </div>
                
                <p class="pincode-message mt-2"></p>

            </div>
        </div>
    </div>
    <?php
    include_once("../../asset/footer.php");
    ?>
</body>

</html>