<?php
require_once "common-files/databases/database.php";
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="pages/js/index.js"></script>

  <style>
    .carousel-caption {
      line-height: 80px;
      height: 100%;
    }

    @media (max-width:576px) {
      #top-slider h1 {
        font-size: 180% !important;
      }

      #top-slider h4 {
        font-size: 100% !important;
      }

      #top-slider button a {
        font-size: 15px !important;
      }

      #category-showcase img {
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
      }
    }

    @media (max-width: 768px) {
      #top-slider h1 {
        font-size: 180% !important;
      }

      #top-slider h4 {
        font-size: 100% !important;
      }

      #top-slider button a {
        font-size: 15px !important;
      }

      .carousel-caption {
        justify-content: center !important;
        line-height: 80px;
        height: 100%;
      }
    }
  </style>
</head>

<body class="bg-white">

  <?php
  include_once("asset/nav.php");
  ?>
  <div class="p-0 container-fluid mt-5">
    <div class="carousel slide" data-ride="carousel" id="top-slider">
      <div class="carousel-inner">
        <?php
        $showcase = "SELECT * FROM header_showcase";
        $response = $db->query($showcase);
        if ($response) {
          while ($data = $response->fetch_assoc()) {
            $h_align = $data['h_align'];
            $text_align = "";
            if ($h_align == "center") {
              $text_align = "text-center";
            } else {

              $text_align = "text-center";
            }
            $v_align = $data['v_align'];
            $title_color = $data['title_color'];
            $title_size = $data['title_size'];
            $subtitle_color = $data['subtitle_color'];
            $subtitle_size = $data['subtitle_size'];
            echo "<div class='carousel-item carousel-item-control'>";
            $image = "data:image/png;base64," . base64_encode($data['title_image']);
            echo "<img src='" . $image . "'class='w-100'>";
            echo "<div class='carousel-caption d-flex h-100' style='justify-content:" . $h_align . ";align-items:" . $v_align . "'>";
            echo "<div>";
            echo "<h1 style='color:" . $title_color . ";font-size:" . $title_size . "'>" . $data['title_text'] . "</h1>";
            echo "<h4 style='color:" . $subtitle_color . ";font-size:" . $subtitle_size . "'>" . $data['subtitle_text'] . "</h4>";
            echo $data['buttons'];
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
        }

        ?>
      </div>
    </div>
  </div>
  <!-- category showcase -->
  <div>

    <div class="container animated fadeIn" id="category-showcase">
      <h2 style="text-align: center" class="mt-4 mb-4">CATEGORY showcase</h2>

      <div class="row">
        <?php

        $dir = ['top-left', 'bottom-left', 'top-right', 'bottom-right'];
        $top_left_image = "";
        $top_left_label = "";

        $bottom_left_image = "";
        $bottom_left_label = "";

        $center_image = "";
        $center_label = "";

        $top_right_image = "";
        $top_right_label = "";

        $bottom_right_image = "";
        $bottom_right_label = "";
        $i;
        for ($i = 0; $i < count($dir); $i++) {
          $get_data = "SELECT * FROM category_showcase WHERE direction = '$dir[$i]' ";
          $response = $db->query($get_data);
          if ($response) {
            $data = $response->fetch_assoc();
            if ($dir[$i] == 'top-left') {
              $top_left_image = "data:image/png;base64," . base64_encode($data['image']);
              $top_left_label = $data['label'];
            } else if ($dir[$i] == 'bottom-left') {
              $bottom_left_image = "data:image/png;base64," . base64_encode($data['image']);
              $bottom_left_label = $data['label'];
            } else if ($dir[$i] == 'center') {
              $center_image = "data:image/png;base64," . base64_encode($data['image']);
              $center_label = $data['label'];
            } else if ($dir[$i] == 'top-right') {
              $top_right_image = "data:image/png;base64," . base64_encode($data['image']);
              $top_right_label = $data['label'];
            } else if ($dir[$i] == 'bottom-right') {
              $bottom_right_image = "data:image/png;base64," . base64_encode($data['image']);
              $bottom_right_label = $data['label'];
            }
          }
        }
        echo "<div class='col-md-4'>
                      <div class='position-relative mb-3'>
                        <button class='btn bg-white p-2 shadow-lg border' style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000'>" . $top_left_label . "</button>
                        <img src='" . $top_left_image . "' width='100%'>
                      </div>

                      <div class='position-relative mb-3'>
                        <button class='btn bg-white p-2 shadow-lg border' style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000'>" . $bottom_left_label . "</button>
                        <img src='" . $bottom_left_image . "' width='100%'>
                      </div>

                    </div>";
        echo "
                      <div class='col-md-4'>
                        <div class='position-relative mb-3'>
                        <button class='btn bg-white p-2 shadow-lg border' style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000'>" . $center_label . "</button>
                        <img src='" . $center_image . "'  width='100%'>
                        </div>
                      </div>
                    ";

        echo "<div class='col-md-4'>
                      <div class='position-relative mb-3'>
                        <button class='btn bg-white p-2 shadow-lg border' style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000'>" . $top_right_label . "</button>
                        <img src='" . $top_right_image . "' width='100%'>
                      </div>

                      <div class='position-relative mb-3'>
                        <button class='btn bg-white p-2 shadow-lg border' style='position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000'>" . $bottom_right_label . "</button>
                        <img src='" . $bottom_right_image . "' width='100%'>
                      </div>
                      
                    </div>";

        ?>
      </div>
    </div>
  </div>

  <!-- end category showcase -->
  <div class="container-fluid">
    <h4 class="text-center my-4">PRODUCTS FOR YOU</h4>
    <div class="row">
      <?php
      $get_data = "SELECT * FROM products ORDER BY RAND() LIMIT 12";
      $response = $db->query($get_data);
      if ($response) {
        while ($data = $response->fetch_assoc()) {
          $id = $data['id'];
          echo "<div class='col-md-3 py-5' align='center'>";
          echo "<img src='" . $data['thumb_pic'] . "' width='250' height='316'><br>";
          echo "<span class='font-weight-bold text-uppercase'>" . $data['brands'] . "</span><br> ";
          //display start of 
          $one = [];
          $two = [];
          $three = [];
          $four = [];
          $five = [];
          $get_data = "SELECT * FROM purchase WHERE product_id = '$id' AND ratings <> 0";
          $star_response = $db->query($get_data);
          if ($star_response) {
            while ($rating_data = $star_response->fetch_assoc()) {
              if ($rating_data['ratings'] == 1) {
                array_push($one, 1);
              } else if ($rating_data['ratings'] == 2) {
                array_push($two, 2);
              } else if ($rating_data['ratings'] == 3) {
                array_push($three, 3);
              } else if ($rating_data['ratings'] == 4) {
                array_push($four, 4);
              } else if ($rating_data['ratings'] == 5) {
                array_push($five, 5);
              }
            }
          }
          $count_one = count($one);
          $count_two = count($two);
          $count_three = count($three);
          $count_four = count($four);
          $count_five = count($five);

          $all_length = [$count_one, $count_two, $count_three, $count_four, $count_five];
          $max = "0";
          for ($i = 0; $i < count($all_length); $i++) {
            if ($all_length[$i] > $max) {
              $max = $all_length[$i];
            }
          }
          if ($max == $count_one) {
            for ($i = 0; $i < 1; $i++) {
              echo "<i class='fa fa-star text-warning'></i>";
            }
            $rest_star = 5 - 1;
            for ($i = 0; $i < $rest_star; $i++) {
              echo "<i class='fa fa-star-0 text-warning'></i>";
            }
          } else if ($max == $count_two) {
            for ($i = 0; $i < 2; $i++) {
              echo "<i class='fa fa-star text-warning'></i>";
            }
            $rest_star = 5 - 2;
            for ($i = 0; $i < $rest_star; $i++) {
              echo "<i class='fa fa-star-0 text-warning'></i>";
            }
          } else if ($max == $count_three) {
            for ($i = 0; $i < 3; $i++) {
              echo "<i class='fa fa-star text-warning'></i>";
            }
            $rest_star = 5 - 3;
            for ($i = 0; $i < $rest_star; $i++) {
              echo "<i class='fa fa-star-0 text-warning'></i>";
            }
          } else if ($max == $count_four) {
            for ($i = 0; $i < 4; $i++) {
              echo "<i class='fa fa-star text-warning'></i>";
            }
            $rest_star = 5 - 4;
            for ($i = 0; $i < $rest_star; $i++) {
              echo "<i class='fa fa-star-0 text-warning'></i>";
            }
          } else if ($max == $count_five) {
            for ($i = 0; $i < 5; $i++) {
              echo "<i class='fa fa-star text-warning'></i>";
            }
          }
          
          echo "<br><span>" . $data['title'] . "</span> <br>";
          echo "<span><i class='fa fa-rupee'> </i>" . $data['price'] . "</span>";
          echo "<br><button class='btn btn-success cart-btn' product-id='" . $data['id'] . "' product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-cart'></i> ADD TO CART</button> 
                <button class='btn btn-primary buy-btn' product-id='" . $data['id'] . "'  product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-bag'></i> SHOP NOW</button>";
          echo "</div>";
        }
      }

      ?>

    </div>
  </div>
  <?php
  include_once("asset/footer.php");

  ?>
  <script>
    $(document).ready(function() {
      var carousel_item = document.querySelector(".carousel-item-control");
      $(carousel_item).addClass("active");
    });
  </script>
</body>

</html>