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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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

<body class="bg-light">

  <?php
  include_once("asset/nav.php");
  ?>
  <div class="p-0 container-fluid">
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
      <h2 style="text-align: center" class="mt-2 mb-4">CATEGORY showcase</h2>

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