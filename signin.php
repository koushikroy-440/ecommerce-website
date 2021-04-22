<?php
    require_once ("common-files/databases/database.php");
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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <scrip src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></scrip>
  </head>
  <body class="bg-light">
      
      <?php
             include_once("asset/nav.php");
      ?>
      <div class="container p-5 bg-white shadow-lg border" style="margin-top:30px;">
      <h2>LOGIN WITH US</h2>
      <hr>
        <div class="row">
          <div class="col-md-6">
            <form class="signin-form">
              
              <div class="form-group">
                <label for="email">Email<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control bg-light email" name="email" placeholder="a@gmail.com" id="email">
              </div>
              <div class="form-group">
                <label for="password">password<sup class="text-danger">*</sup></label>
                <input type="password" name="password" class="form-control bg-light" placeholder="*******" id="password">
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary shadow-sm py-2">Login now</button>
                
              </div>
              <p>Don't have any account <a href="signup.php">create now</a></p>
            </form>
            <form class="d-none otp-form">
              <div class="form-group">
                <div class="btn-group border shadow-sm">
                    <button class="btn btn-light" type="button">
                      <input type="text" class="form-control otp" name="otp" placeholder="123456" >
                    </button>
                    <button class="btn btn-light verify-btn" type="button">verify</button>
                    <button class="btn btn-light resend-btn" type="button">Resend otp</button>
                </div>
              </div>

            </form>
            <div class="from-group login-notice">
            
            </div>
          </div>
          <div class="col-md-6"></div>
        </div>
      </div>
      <?php
        include_once("asset/footer.php");

      ?>
      <script>
          $(".signin-form").submit(function(e){
              e.preventDefault();
              $.ajax({
                type: "POST",
                url:"pages/php/login.php",
                data : new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function(response){
                  // console.log(response);
                  if(response.trim() == "success")
                  {
                    $(".otp-form").removeClass("d-none");
                     $(".signin-form").addClass("d-none");
                      //verify otp
                $(".verify-btn").click(function(){
                  $.ajax({
                  type: "POST",
                  url:"pages/php/verify_otp.php",
                  data:{
                     otp: $(".otp").val().trim(),
                     email: $(".email").val().trim()
                  },
                  beforeSend: function(){
                    $(this).html("please wait....");
                  },
                  success: function(response){
                    // console.log(response);
                    if(response.trim() == "success")
                    {
                        var notice = document.createElement("div");
                        notice.innerHTML = "<b>your mobile number is verified</b>";
                        notice.className = "alert alert-info";
                        $(".login-notice").html(notice);
                        setTimeout(function(){
                          window.location = "signin.php";
                        },3000)
                        
                    }
                    else{
                        $(".verify-btn").html(response);
                        setTimeout(function(){
                        $(".verify-btn").html("verify");
                        $(".otp").val("");

                        },3000);
                    }
                  }
                });
                });
                //resend otp
                $(".resend-btn").click(function(){
                    $.ajax({
                      type: "POST",
                      url:"pages/php/resend_sms.php",
                      data:{
                        mobile : $(".email").val()
                      },
                      success: function(response){
                        if(response.trim() == "success")
                        {
                            $(".resend-btn").html("otp has been send");
                        }
                        else{
                            $(".resend-btn").html(success);
                            setTimeout(function(){
                            $(".resend-btn").html("Resend otp");
                            },3000);
                        }
                      }
                    });
                });
                  }
                  else if(response.trim() == "login success")
                  {
                    window.location = "index.php";
                  }
                  else{
                    // console.log(response);
                    var message = document.createElement("div");
                   message.innerHTML = "<b>"+response+"</b>";
                    message.className = "alert alert-warning";
                    $(".login-notice").html(message);

                    setTimeout(function(){
                      $(".login-notice").html('');
                      $(".signin-notice").trigger('reset');
                    },3000);
                  }

                }
              });
          });
      
      </script>
  </body>
</html>