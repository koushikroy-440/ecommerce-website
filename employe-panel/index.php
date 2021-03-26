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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <script type="text/javascript" src="js/index.js"></script>
  </head>
  <body>
      <div class="container-fluid">
        <div class="sidebar">
        <button class="btn w-100 text-left" style="font-size:20px">
        <i class="fa fa-image"></i>
        Branding details
        </button>

        <button class="btn w-100 text-left stock-update-btn" style="font-size:20px">
        <i class="fa fa-shopping-cart"></i>
        Stock update
        <i class="fa fa-angle-down close mt-2"></i>
        </button>
        <ul class="collapse show stock-update-btn-menu">
            <li class="border-left p-2 collapse-item active" access-link="create_category_design.php">Create category</li>
            <li class="border-left p-2 collapse-item" access-link="create_brands_design.php">Create brand</li>
            <li class="border-left p-2 collapse-item" access-link="create_products_design.php">Create products</li>
        </ul>
        </div>
        <div class="page">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8 bg-white rounded">
                <form class="form-horizontal branding-form p-4">
                  <div class="form-group">
                    <label for="brand-name"><b>Enter brand name</b> <i class="fa fa-edit brand_edit" style="cursor:pointer"> Edit Brand details</i></label>
                    <input type="text" class="form-control brand-name" name="brand-name" id="brand-name">
                  </div>

                  <div class="form-group">
                    <label for="brand-logo"><b>upload brand logo</b></label>
                    <input type="file" class="form-control brand-logo" name="brand-logo" id="brand-logo">
                  </div>
                
                  <div class="form-group">
                    <label for="domain-name"><b>enter domain name</b></label>
                    <input type="text" class="form-control domain-name" name="domain-name" id="domain-name">
                  </div>

                  <div class="form-group">
                    <label for="brand-email"><b>email</b></label>
                    <input type="text" class="form-control brand-email" name="brand-email" id="brand-email">
                  </div>

                  <div class="form-group">
                    <label for="social-handles"><b>social handles</b></label>
                    <input type="text" class="form-control facebook" name="facebook" id="facebook">
                    <br>
                    <input type="text" class="form-control instagram" name="instagram" id="instagram">

                  </div>

                  <div class="form-group">
                    <label for="address"><b>address</b></label>
                    <textarea name="address" id="address" class="form-control address" maxlength="200" name="address" cols="10" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                    <label for="phone"><b>phone</b></label>
                    <input type="text" class="form-control phone" name="phone" id="phone">
                  </div>

                  <div class="form-group">
                    <label for="about-us"><b>about us </b><small class="about-us-count"> 0</small><small>/5000</small></label>
                    <textarea name="about-us" id="about-us" class="form-control about-us" name="about-us" cols="10" rows="8" maxlength="5000"></textarea>
                    </div>

                  <div class="form-group">
                    <label for="privacy-policy"><b>privacy-policy </b><small class="privacy-policy-count"> 0</small><small>/5000</small></label>
                    <textarea name="privacy-policy" id="privacy-policy" maxlength="5000" class="form-control privacy-policy" name="privacy-policy" cols="10" rows="8"></textarea>
                    </div>

                    <div class="form-group">
                    <label for="terms-conditions"><b>terms and conditions </b><small class="terms-conditions-count"> 0</small><small>/5000</small></label>
                    <textarea name="terms-conditions" id="terms-conditions" class="form-control terms-conditions" name="terms-conditions" cols="10" rows="8" maxlength="5000"></textarea>
                    </div>

                    <div class="form-group">
                    <label for="cookies"><b>cookies terms and conditions </b><small class="cookies-count"> 0</small><small>/5000</small></label>
                    <textarea name="cookies" id="cookies" class="form-control cookies" cols="10" rows="8" name="cookies" maxlength="5000"></textarea>
                    </div>
                    
                    <button class="btn btn-primary" type="submit">update</button>
                </form>

                
              </div>
              <div class="col-md-2"></div>
            </div>

        </div>
      </div>
    // count length
    <script type="text/javascript">
    $(document).ready(function(){

      $("#about-us").on("input", function(){
        var length = $(this).val().length;
        $(".about-us-count").html(length);
      });

      $("#privacy-policy").on("input", function(){
        var length = $(this).val().length;
        $(".privacy-policy-count").html(length);
      });

      $("#terms-conditions").on("input", function(){
        var length = $(this).val().length;
        $(".terms-conditions-count").html(length);
      });

      $("#cookies").on("input", function(){
        var length = $(this).val().length;
        $(".cookies-count").html(length);
      });

      //branding details
      $(document).ready(function(){
        $(".branding-form").on("submit",function(e){
          e.preventDefault();
          var file = document.getElementById("brand-logo");
          var file_size;
          if(file.value == "")
          {
            file_size = 0;
          }
          else{
            file_size = file.files[0].size;
          }
          if(file_size<200000)
          {
          $.ajax({
            type: "POST",
            url: "php/branding.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            catch : false,
            success: function(response){
              alert(response);
            }
          });
        }
        else{
          alert("please upload less than 200kb file");
        }
        });
      });

      //branding details control

      $(document).ready(function(){
        $.ajax({
          type: "POST",
          url: "php/check_branding_table.php",
          success: function(response){
            var all_data = JSON.parse(response.trim());
            $("#brand-name").val(all_data[0].brand_name);
            $("#domain-name").val(all_data[0].domain_name);
            $("#brand-email").val(all_data[0].brand_email);
            $("#facebook").val(all_data[0].facebook);
            $("#instagram").val(all_data[0].instagram);
            $("#address").val(all_data[0].address);
            $("#phone").val(all_data[0].phone);
            $("#about-us").val(all_data[0].about_us);
            $("#privacy-policy").val(all_data[0].privacy_policy);
            $("#terms-conditions").val(all_data[0].terms_conditions);
            $("#cookies").val(all_data[0].cookies);
            $(".branding-from input,.branding-from textarea,.branding-form button").prop("disabled",true);
            $(".brand_edit").click(function(){
              $(".branding-from input,.branding-from textarea,.branding-form button").prop("disabled",false);
              $("#brand-logo").removeAttr("required");
            });
          }
        });
      });



    });
    </script>

  </body>
</html>