<?php
require_once("common-files/databases/database.php");
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body class="bg-light">

  <?php
  include_once "asset/nav.php";
  ?>
  <div class="container p-5 bg-white shadow-lg border" style="margin-top:30px;">
    <h2>CREATE AN ACCOUNT</h2>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <form class="signup-form">
          <div class="form-group">
            <label for="first_name">First Name<sup class="text-danger">*</sup></label>
            <input type="text" name="firstname" class="form-control bg-light" placeholder="First Name" id="first_name">
          </div>

          <div class="form-group">
            <label for="last_name">Last Name<sup class="text-danger">*</sup></label>
            <input type="text" name="lastname" class="form-control bg-light" placeholder="last Name" id="last_name">
          </div>

          <div class="form-group">
            <label for="email">Email<sup class="text-danger">*</sup></label>
            <input type="text" name="email" class="form-control bg-light email" placeholder="a@gmail.com" id="email">
          </div>

          <div class="form-group">
            <label for="mobile">Mobile<sup class="text-danger">*</sup></label>
            <input type="number" name="mobile" class="form-control bg-light mobile" placeholder="*****89890" id="mobile">
          </div>

          <div class="form-group">
            <label for="password">password<sup class="text-danger">*</sup></label>
            <input type="password" name="password" class="form-control bg-light" placeholder="*******" id="password">
          </div>

          <div class="form-group">
            <label for="address">Address <sup class="text-danger">*</sup></label>
            <textarea name="address" id="address" class="form-control bg-light"></textarea>
          </div>
          <div class="form-group">
            <label for="state">State<sup class="text-danger">*</sup></label>
            <input type="text" id="state" name="state" class="form-control bg-light">
          </div>

          <div class="form-group">
            <label for="country">Country<sup class="text-danger">*</sup></label>
            <input type="text" id="country" name="country" class="form-control bg-light">
          </div>

          <div class="form-group">
            <label for="pin-code">PinCode<sup class="text-danger">*</sup></label>
            <input type="number" id="pin-code" name="pin-code" class="form-control bg-light">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary register-btn shadow-sm py-2">Register now</button>

          </div>

        </form>
        <form class="d-none otp-form">
          <div class="form-group">
            <div class="btn-group border shadow-sm">
              <button class="btn btn-light" type="button">
                <input type="text" class="form-control otp" name="otp" placeholder="123456">
              </button>
              <button class="btn btn-light verify-btn" type="button">verify</button>
              <button class="btn btn-light resend-btn" type="button">Resend otp</button>
            </div>
          </div>

        </form>
      </div>
      <div class="col-md-6"></div>
    </div>
  </div>
  <?php
  include_once "asset/footer.php";

  ?>
  <script>
    $(document).ready(function() {
      $(".signup-form").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "pages/php/register.php",
          data: new FormData(this),
          processData: false,
          contentType: false,
          cache: false,
          beforeSend: function() {
            $(".register-btn").html("please wait....");
          },
          success: function(response) {
            // console.log(response);
            if (response == "success") {
              $(".otp-form").removeClass("d-none");
              $(".signup-form").addClass("d-none");
              //verify otp
              $(".verify-btn").click(function() {
                $.ajax({
                  type: "POST",
                  url: "pages/php/verify_otp.php",
                  data: {
                    otp: $(".otp").val().trim(),
                    email: $(".email").val().trim()
                  },
                  beforeSend: function() {
                    $(this).html("please wait....");
                  },
                  success: function(response) {
                    if (response.trim() == "success") {
                      window.location = "signin.php";
                    } else {
                      $(".verify-btn").html(response);
                      setTimeout(function() {
                        $(".verify-btn").html("verify");
                        $(".otp").val("");

                      }, 30000);
                    }
                  }
                });
              });
              //resend otp
              $(".resend-btn").click(function() {
                $.ajax({
                  type: "POST",
                  url: "pages/php/resend_sms.php",
                  data: {
                    mobile: $(".mobile").val()
                  },
                  success: function(response) {
                    if (response.trim() == "success") {
                      $(".resend-btn").html("otp has been send");
                    } else {
                      $(".resend-btn").html(success);
                      setTimeout(function() {
                        $(".resend-btn").html("Resend otp");
                      }, 3000);
                    }
                  }
                });
              });
            }
          }
        });
      });
    });
  </script>
</body>

</html>