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
      <button class="btn w-100 mb-2 text-left collapse-item active" access-link="delivery_area_design.php" style="font-size:20px">
        <i class="fa fa-map-marker"></i>
        Delivery area
      </button>

      <button class="btn w-100 text-left collapse-item active" access-link="sales_report_design.php" style="font-size:20px">
        <i class="fa fa-shopping-bag"></i>
        Sales report
      </button>
    </div>

  </div>
  <div class="page">
        <div class="row">
          <div class="col-md-6">
            <div class="jumbotron bg-white py-3">
              <h4>KEYWORD PLANNER</h4>
              <form class="keyword-form">
                  <div class="form-group">
                    <label for="p-keyword" >Primary Keyword</label>
                    <select class="form-control p-keyword" id="p-keyword" name="p-keyword" name="p-keyword">
                      <option value="">CHOOSE PRIMARY KEYWORD</option>
                      <?php
                        $get_data = "SELECT * FROM category";
                        $response = $db->query($get_data);
                        if($response)
                        {
                          while($data = $response->fetch_assoc())
                          {
                              echo "<option>".$data['category_name']."</option>";
                          }
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="s-keyword" >Secondary keyword</label>
                    <textarea class="form-control s-keyword" required name="s-keyword" id="s-keyword" rows="5" ></textarea>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">submit</button>
                  </div>

              </form>
            </div>
          </div>
          <div class="col-md-6"></div>
        </div>
  </div>
  <script>
    $(document).ready(function(){
      $(".keyword-form").submit(function(e){
          e.preventDefault();
          if($(".p-keyword").val() != "CHOOSE PRIMARY KEYWORD")
          {
              $.ajax({
                type: "POST",
                url: "php/keyword.php",
                data: new FormData(this),
                processData: false,
                contentType:false,
                cache: false,
                success: function(response){
                  alert(response);
                }
              });
          }
          else{
            alert("please choose a keyword");
          }
      });
    });

    //appear secondary key

    $(document).ready(function(){
      $(".p-keyword").on("change", function(){
        if($(this).val() != "CHOOSE PRIMARY KEYWORD")
        {
          var p_key = $(this).val();
          $.ajax({
            type: "POST",
            url: "php/appear_secondary_key.php",
            data:{
              p_key : p_key,
            },
            success: function(response){
              $(".s-keyword").val(response.trim());
              // console.log(response);
            }
          });
        }
      });
    });
  </script>
 
</body>

</html>