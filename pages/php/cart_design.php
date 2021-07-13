<?php
    require_once ("../../common-files/databases/database.php");
    if(empty($_COOKIE['_au_']))
    {
        header("Location:../../signin.php");
        exit;
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
  <body class="bg-white">
      
      <?php
             include_once("../../asset/nav.php");
      ?>
      <div class="container" style="margin-top: 80px; margin-bottom:40px;">
            <div class="row">
                <div class="col-md-8">
                    <div class="bg-white">
                        <?php
                            $username = base64_decode($_COOKIE['_au_']);
                            $get_data = "SELECT * FROM cart WHERE username = '$username'";
                            $response = $db->query($get_data);
                            if($response->num_rows != 0)
                            {
                                while($data = $response->fetch_assoc())
                                {
                                    echo "<div class='media border mb-3 p-3 shadow-sm rounded'>
                                        <div class='media-left'>
                                            <img src='../../".$data['product_pic']."' width='100'>
                                        </div>
                                        <div class='media-body ml-4'>
                                            <h5 class='text-capitalize p-0 m-0'>".$data['product_title']."</h5>
                                            <span>".$data['product_brand']."</span><br>
                                            <span>".$data['product_price']."</span>
                                            <div class=''btn-group shadow-sm mt-2'>
                                                <button class='btn btn-primary delete-btn' product-id='".$data['product_id']."'><i class='fa fa-trash'></i></button>
                                                <button class='btn btn-success buy-btn' product-id='".$data['product_id']."'>BUY NOW</button>
                                            </div>
                                        </div>
                                    </div>";
                                }
                            }
                            else{
                                echo"<h1 class='text-center' style='font-size: 40px'><i class='fa fa-shopping-cart'></i>Your cart is empty</h1>";
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white">
                        
                    </div>
                </div>
            </div>
      </div>
      <?php
        include_once("../../asset/footer.php");
      ?>
  </body>
</html>