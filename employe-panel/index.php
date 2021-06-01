<?php
require_once "../common-files/databases/database.php";  
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--============= Bootstrap CSS ======= -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--============= fa fa-icon cdn ================-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--============= css pages========= -->
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/animate.css">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/indexs.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="sidebar">
      <button class="btn w-100 text-left collapse-item active" access-link="branding_design.php" style="font-size:20px">
        <i class="fa fa-image"></i>
        Branding details
      </button>

      <button class="btn w-100 text-left homepage-design-btn" style="font-size:20px">
        <i class="fa fa-home"></i>
        homepage design
        <i class="fa fa-angle-down close mt-2"></i>
      </button>

      <ul class="collapse homepage-design-collapse">
        <li class="border-left p-2 collapse-item" access-link="header_showcase_design.php">Header Showcase</li>
        <li class="border-left p-2 collapse-item" access-link="category_showcase_design.php">Category Showcase</li>

      </ul>

      <button class="btn w-100 text-left stock-update-btn" style="font-size:20px">
        <i class="fa fa-shopping-cart"></i>
        Stock update
        <i class="fa fa-angle-down close mt-2"></i>
      </button>
      <ul class="collapse stock-update-btn-menu">
        <li class="border-left p-2 collapse-item" access-link="create_category_design.php">Create category</li>
        <li class="border-left p-2 collapse-item" access-link="create_brands_design.php">Create brand</li>
        <li class="border-left p-2 collapse-item" access-link="create_products_design.php">Create products</li>
      </ul>
    </div>

  </div>
  <div class="page">
    <div class="row">
      <?php

      $dir = ['top-left', 'bottom-left', 'top-right', 'bottom-right'];
      $top_left_image = "../common-files/images/small_sample.jpg";
      $top_left_label = "";

      $bottom_left_image = "../common-files/images/small_sample.jpg";
      $bottom_left_label = "";

      $center_image = "../common-files/images/large_sample.jpg";
      $center_label = "";

      $top_right_image = "../common-files/images/small_sample.jpg";
      $top_right_label = "";

      $bottom_right_image = "../common-files/images/small_sample.jpg";
      $bottom_right_label = "";
      $i;
      for ($i = 0; $i < count($dir); $i++) {
        $get_data = "SELECT * FROM category_showcase WHERE direction = '$dir[$i]' ";
        $response = $db->query($get_data);
        if ($response) {
          $data = $response->fetch_assoc();
          if ($dir[$i] == 'top-left') {
            if($response->num_rows != 0) {
              $top_left_image = "data:image/png;base64," . base64_encode($data['image']);
              $top_left_label = $data['label'];
            }
          }
           else if ($dir[$i] == 'bottom-left') {
            if($response->num_rows != 0) {

            $bottom_left_image = "data:image/png;base64," . base64_encode($data['image']);
            $bottom_left_label = $data['label'];
            }

          }
           else if ($dir[$i] == 'center') {
            if($response->num_rows != 0) {

            $center_image = "data:image/png;base64," . base64_encode($data['image']);
            $center_label = $data['label'];
            }
          } 
          else if ($dir[$i] == 'top-right') {
            if($response->num_rows != 0) {

            $top_right_image = "data:image/png;base64," . base64_encode($data['image']);
            $top_right_label = $data['label'];
            }
          }
           else if ($dir[$i] == 'bottom-right') {
            if($response->num_rows != 0) {
            $bottom_right_image = "data:image/png;base64," . base64_encode($data['image']);
            $bottom_right_label = $data['label'];
            }
          }
        }
      }
      ?>
      <div class="col-md-4">
        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0" >
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value="<?php echo $top_left_label ?>">
            </button>
            <button class="btn btn-dark set-btn" img_dir="top-left" disabled="disabled">
              SET
            </button>
          </div>
          <img src="<?php echo $top_left_image ?>" alt="small sample" class="w-100 mb-3">
        </div>


        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0" >
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value="<?php echo $bottom_left_label ?>">
            </button>
            <button class="btn btn-dark set-btn" img_dir="bottom-left" disabled="disabled">
              SET
            </button>
          </div>
          <img src="<?php echo $bottom_left_image ?>" alt="small sample" class="w-100 mb-3">
        </div>

      </div>
      <div class="col-md-4">
        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0">
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value="<?php echo $center_label ?>">
            </button>
            <button class="btn btn-dark set-btn" img_dir="center" disabled="disabled">
              SET
            </button>
          </div>
          <img src="<?php echo $center_image ?>" alt="large sample" class="w-100 mb-3">
        </div>
      </div>


      <div class="col-md-4">

        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0">
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value="<?php echo $top_right_label ?>">
            </button>
            <button class="btn btn-dark set-btn" img_dir="top-right" disabled="disabled">
              SET
            </button>
          </div>
          <img src="<?php echo $top_right_image ?>" alt="small sample" class="w-100 mb-3">
        </div>

        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0">
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value="<?php echo $bottom_right_label ?>">
            </button>
            <button class="btn btn-dark set-btn" img_dir="bottom-right" disabled="disabled">
              SET
            </button>
          </div>
          <img src="<?php echo $bottom_right_image ?>" alt="small sample" class="w-100 mb-3">
        </div>

      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $(".upload-icon").each(function() {
        $(this).on('change', function() {
          var upload_icon = this;
          var dummy_pic = upload_icon.parentElement.parentElement.parentElement.getElementsByTagName("img")[0];
          var input = upload_icon.parentElement.parentElement.getElementsByTagName("INPUT")[1];
          var set_btn = upload_icon.parentElement.parentElement.getElementsByClassName("set-btn")[0];
          var dummy_pic_width = dummy_pic.naturalWidth;
          var dummy_pic_height = dummy_pic.naturalHeight;
          var file = upload_icon.files[0];
          var url = URL.createObjectURL(file);

          var image = new Image();
          image.src = url;

          var upload_width = "";
          var upload_height = "";
          image.onload = function() {
            upload_width = image.width;
            upload_height = image.height;
            if (dummy_pic_width == upload_width && dummy_pic_height == upload_height) {
              input.oninput = function() {
                if (this.value.length >= 1) {
                  set_btn.disabled = false;
                  set_btn.onclick = function() {
                    var form_data = new FormData();
                    form_data.append("photo", file);
                    form_data.append("text", input.value);
                    form_data.append("direction", $(set_btn).attr("img_dir"));
                    $.ajax({
                      type: "POST",
                      url: "php/category_showcase.php",
                      data: form_data,
                      contentType: false,
                      processData: false,
                      cache: false,
                      beforeSend: function() {
                        set_btn.innerHTML = "please wait";
                      },
                      success: function(response) {
                        if (response.trim() == "success")

                        {

                          dummy_pic.src = url;
                          set_btn.innerHTML = "SET";
                          $(upload_icon.parentElement.parentElement).addClass("d-none");

                          dummy_pic.ondblclick = function() {
                            $(upload_icon.parentElement.parentElement).removeClass("d-none");
                          }
                        }
                      }
                    });
                  }
                } else {
                  set_btn.disabled = true;
                }
              }
            } else {
              alert("please upload " + dummy_pic_width + "/" + dummy_pic_height);
            }
          }

        });
      });
    });
    $(document).ready(function() {
      var img = $("img");
      var i;
      for(i=0;i<img.length;i++) {
        if(img[i].src.indexOf("base64") != -1)
        {
          var set_btn = img[i].parentElement.getElementsByClassName("set-btn")[0];
          // alert(set_btn.length);
          set_btn.disabled = false;
          $(set_btn).each(function() {
            $(this).click(function(){
              set_btn = this;
              var input = this.parentElement.getElementsByTagName("INPUT");
              var file = input[0].files[0];
              var text = input[1].value;
              var dummy_pic = this.parentElement.parentElement.getElementsByTagName("img")[0];
              var url = dummy_pic.src;
            if(input[0].files[0] != "" )
            {
              url = URL.createObjectURL(input[0].files[0]);
            }
            var form_data = new FormData();
                    form_data.append("photo", file);
                    form_data.append("text", text);
                    form_data.append("direction", $(set_btn).attr("img_dir"));
                    $.ajax({
                      type: "POST",
                      url: "php/category_showcase.php",
                      data: form_data,
                      contentType: false,
                      processData: false,
                      cache: false,
                      beforeSend: function() {
                        set_btn.innerHTML = "please wait";
                      },
                      success: function(response) {
                        if (response.trim() == "success")

                        {

                          dummy_pic.src = url;
                          set_btn.innerHTML = "SET";
                          $(set_btn.parentElement).addClass("d-none");

                          dummy_pic.ondblclick = function() {
                            $(set_btn.parentElement).removeClass("d-none");
                          }
                        }
                      }
                    });
            });
          });
         
        }
      }
    });
  </script>
</body>

</html>