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
     <script type="text/javascript" src="js/indexf.js"></script>
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
        <div class="page">
            <div class="row">
              <div class="col-md-4 p-4 bg-white rounded-lg shadow-sm">
                <form class="header showcase-form">
                  <div class="form-group">
                    <label for="title-image">Title image<span> 200kb (1920*978)</span></label>
                    <input type="file" accept="image/*" class="form-control" name="title-image" id="title-image" required="required">
                  </div>
                  <div class="form-group">
                    <label for="title-text">Title text <span class="title-limit">0</span><span>/40</span></label>
                    <textarea class="form-control" rows="1" id="title-text" name="title-text" maxlength="40" required="required"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="subtitle-text">subtitle text <span class="subtitle-limit">0</span><span>/100</span></label>
                    <textarea class="form-control" rows="5" id="subtitle-text" name="subtitle-text" maxlength="100"  required="required"></textarea>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary py-2" type="submit">Add showcase</button>
                  </div>
                 
                </form>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-7 p-4 bg-white rounded-lg shadow-sm position-relative showcase-preview d-flex">
              <div class="title-box">  
              <h1 class="showcase-title target">TITLE</h1>
                <h4 class="showcase-subtitle target">SUBTITLE</h4>
                  </div>
                <div class="showcase-formating d-flex justify-content-around align-items-center">
                  <div class="btn-group">
                      <button class="btn btn-light">color</button>
                      <button class="btn btn-light">
                      <input type="color" class="color-selector" name="color-selector">
                      </button>
                  </div>

                  <div class="btn-group">
                      <button class="btn btn-light">Font size</button>
                      <button class="btn btn-light">
                      <input type="range" min="100" max="500"class="font-size" name="font-size">
                      </button>
                  </div>

                 
                      <button class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                      <span>Alignment</span>

                        <div class="dropdown-menu">
                          <span class="dropdown-item alignment" align-position="h" align-value="flex-start">LEFT</span>
                          <span class="dropdown-item alignment" align-position="h" align-value="flex-end">RIGHT</span>
                          <span class="dropdown-item alignment" align-position="h" align-value="center">CENTER</span>
                          <span class="dropdown-item alignment" align-position="v" align-value="flex-start">TOP</span>
                          <span class="dropdown-item alignment" align-position="v" align-value="center">V-CENTER</span>
                          <span class="dropdown-item alignment" align-position="v" align-value="flex-end">BOTTOM</span>
                        </div>
                      </button>
                      

                </div>
              </div>
            
            </div>
        </div>
      </div>
      <script>
        $(document).ready(function(){
          $(".target").each(function(){
            $(this).click(function(event){
              var element = event.target;
              var index_number = $(element).index();
              sessionStorage.setItem('index_number',index_number);
              var i;
              for (i = 0; i <$(".target").length; i++) {
                $(".target").css({
                  border : "",
                  width : "",
                boxShadow : "",
                padding : ""
                });
              }
              $(this).css({
                border : "2px solid red",
                width : "fit-Content",
                boxShadow : "0px 0px 3px grey",
                padding : "2px"
              });
          });

          $(this).on('dblclick',function(){
            
            var i;
              for (i = 0; i <$(".target").length; i++) {
                $(".target").css({
                  border : "",
                  width : "",
                boxShadow : "",
                padding : ""
                });
              }
          });
          
          

          });
         
          $(".color-selector").on("change",function(){
                  var color = this.value;
                  var in_number = Number(sessionStorage.getItem('index_number'));
                  var element = document.getElementsByClassName("target")[in_number];
                  element.style.color = color;
              });

              $(".font-size").on("input",function(){
                  var size = this.value;
                  var in_number = Number(sessionStorage.getItem('index_number'));
                  var element = document.getElementsByClassName("target")[in_number];
                  element.style.fontSize = size+"%";
                  
              });
        });

        //title image upload
        $(document).ready(function(){
           $("#title-image").on("change",function(){
             var file = this.files[0];
             if(file.size < 200000)
             {
                var url = URL.createObjectURL(file);
                var image = new Image();
                image.src = url;
                image.onload = function(){
                  var o_width = image.width;
                  var o_height = image.height;
                  if(o_width < 1920 && o_height < 978)
                  {
                    image.style.width = "100%";
                    $(".showcase-preview").append(image);
                  }
                  else{
                    alert("please choose another files");
                  }
                }
             }
             else{
               alert("please upload less than 200kb file");
             }
           })
        });
        //textarea maxlength
        $(document).ready(function(){
          $("#title-text").on("input", function(){
            var length = this.value.length;
            $(".showcase-title").html(this.value);
            $(".title-limit").html(length);

          });

          $("#subtitle-text").on("input", function(){
            var length = this.value.length;
            $(".showcase-subtitle").html(this.value);
            $(".subtitle-limit").html(length);

          });

          //add Showcase
          $(".showcase-form").submit(function(e){
            e.preventDefault();
            var title = document.querySelector(".showcase-title");
            var subtitle = document.querySelector(".showcase-subtitle");
            var file = document.querySelector("#title-image").files[0];
            var title_size = "";
            var title_color = "";
            if(title.style.fontSize == "")
            {
              title_size = "300%";
            }
            else{
              title_size = title.style.fontSize;
            }

            if(title.style.color == "")
            {
              title_color = "black";
            }
            else{
              title_color = title.style.color;
            }
            var subtitle_size = "";
            var subtitle_color = "";
            if(subtitle.style.fontSize == "")
            {
              subtitle_size = "300%";
            }
            else{
              subtitle_size = subtitle.style.fontSize;
            }

            if(subtitle.style.color == "")
            {
              subtitle_color = "black";
            }
            else{
              subtitle_color = subtitle.style.color;
            }

            var flex_box = document.querySelector(".showcase-preview");
            var h_align = "";
            var v_align = "";
            if(flex_box.style.justifyContent == ""){
              h_align = "flex-start";
            }
            else{
              h_align = flex_box.style.justifyContent;
            }

            if(flex_box.style.alignItems == ""){
              v_align = "flex-start";
            }
            else{
              v_align = flex_box.style.alignItems;
            }
            var css_data = {
              title_size : title_size,
              title_color : title_color,
              subtitle_size : subtitle_size,
              subtitle_color : subtitle_color,
              h_align : h_align,
              v_align : v_align,
              title_text :title.innerHTML,
              subtitle_text :subtitle.innerHTML
            };
            var formdata = new FormData();
            formdata.append("file_data",file);
            formdata.append("css_data",JSON.stringify(css_data));

            console.log(css_data);
            $.ajax({
              type: "POST",
              url : "php/header_showcase.php",
              data : formdata,
              contentType : false,
              processData: false,
              catch : false,
              success: function(response){
                  alert(response);
              }
            });
          });
        });
        //alignment 
        $(document).ready(function(){
          $(".alignment").each(function(){
            $(this).click(function(){
              var align_position = $(this).attr("align-position");
              var align_value = $(this).attr("align-value");
              //alert(align_position);
              if(align_position == "h")
              {
                $(".showcase-preview").css({
                  justifyContent: align_value,
                });
              }
              else if(align_position == "v"){
                alignItems = align_value;
              
               }
               
            });
          });
        });
      </script>

  </body>
</html>