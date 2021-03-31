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
                <form class="header-showcase-form">
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
                    <label for="create-button">Create buttons</label>
                    <i class="fa fa-trash delete-btn close d-none"></i>
                    <div class="input-group mb-2" id="create-button">
                        <input type="url" name="btn-url" class="form-control btn-url" placeholder="https://google.com">

                        <input type="text" class="form-control btn-name" name="btn-name" placeholder="button-1">

                    </div>
                    <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text">BG COLOR</span>
                          </div>
                          <input type="color" name="btn-bgcolor" class="form-control btn-bgcolor">
                          <div class="input-group-prepend">
                            <span class="input-group-text">TEXT COLOR</span>
                          </div>
                          <input type="color" name="btn-textcolor" class="form-control btn-textcolor">
                    </div>
                    <div class="input-group my-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text">SIZE</span>
                          </div>
                          <select class="form-control btn-size">
                              <option value="16px">small</option>
                              <option value="20px">medium</option>
                              <option value="24px">large</option>
                          </select>

                          <div class="input-group-append">
                              <span class="input-group-text bg-danger add-btn text-light" style="cursor:pointer;">Add</span>
                          </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary py-2 add-showcase-btn" type="submit">Add showcase</button>
                    <button class="btn btn-primary py-2 real-preview-btn" type="button">Real preview</button>
                  </div>
                  <div class="form-group">
                      <label for="edit-title">Edit title</label>
                      <i class="fa fa-trash delete-edit d-none close"></i>
                      <select class="form-control" id="edit-title">
                          <option>choose title</option>

                          <?php
$get_data = "SELECT * FROM header_showcase";
$response = $db->query($get_data);
$count = 0;
if ($response) {

    while ($data = $response->fetch_assoc()) {
        $count += 1;
        echo "<option value=" . $data['id'] . ">" . $count . "</option>";
    }
}
?>
                      </select>

                  </div>

                </form>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-7 p-4 bg-white rounded-lg shadow-sm position-relative showcase-preview d-flex" style="height:380px;">
                  <div class="title-box">
                  <h1 class="showcase-title target">TITLE</h1>
                  <h4 class="showcase-subtitle target">SUBTITLE</h4>
                  <div class="title-buttons my-3">


                  </div>
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
                    image.style.position = "absolute";
                    image.style.top = "0";
                    image.style.left = "0";
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
          $(".header-showcase-form").submit(function(e){
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
              subtitle_text :subtitle.innerHTML,
              button : $(".title-buttons").html().trim()
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

        //================add btn =============================
        $(document).ready(function(){
          $(".add-btn").click(function(){
            var button  = document.createElement("button");

            button.className = "btn mr-2 title-btn";
            var a = document.createElement("a");
            a.href = $(".btn-url").val();
            a.innerHTML = $(".btn-name").val();
            a.style.color = $(".btn-textcolor").val();
            a.style.fontSize = $(".btn-size").val();
            button.style.backgroundColor = $(".btn-bgcolor").val();
            button.append(a);
            $(".title-buttons").append(button);

            var title_button = document.querySelector(".title-buttons");
            var title_child = title_button.getElementsByTagName("button");
            var button_length = title_child.length;
            if(button_length == 0 || button_length == 1){
              $(".title-buttons").append(button);
            }
            else{
              alert("only two button are allowed");
            }
          });
        });

        $(document).ready(function(){
          $(".real-preview-btn").click(function(){
          var file = document.querySelector("#title-image").files[0];
          var form_data = new FormData();
          form_data.append("photo",file);
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
          var array = [$(".title-box").html().trim(),h_align,v_align];
          form_data.append("data",JSON.stringify(array));
          $.ajax({
            type: "POST",
            url: "php/preview.php",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response){

                var page = window.open("about:blank");
                page.document.open();
                page.document.write(response);
                page.document.close();

            }

          });
        });
        });

        //edit title
        $(document).ready(function(){
          var showcase_preview = $(".showcase-preview").html();
          $("#edit-title").on("change", function(){
            if($(this).val() != "choose title"){
              
                $.ajax({
                  type: "POST",
                  url: "php/edit_title.php",
                  data: {
                    id : $(this).val(),
                  },
                  success: function(response)
                  {
                    var selected_value = $("#edit-title").val();
                    $(".add-showcase-btn").html("Save edit");
                    $(".add-showcase-btn").removeClass("bg-primary");
                    $(".add-showcase-btn").addClass("bg-danger");
                    $(".delete-edit").removeClass("d-none");
                    $(".delete-edit").click(function(){
                      $.ajax({
                        type: "POST",
                        url: "php/delete_title.php",
                        data:{
                          id: $("#edit-title").val(),
                        },
                        success: function(response)
                        {
                            if(response.trim() == "success")
                            {
                              $(".add-showcase-btn").html("Add showcase");
                              $(".add-showcase-btn").removeClass("bg-danger");
                              $(".add-showcase-btn").addClass("bg-primary");
                              $(".header-showcase-form").trigger("reset");
                              $(".showcase-preview").html(showcase_preview);
                              $(".delete-edit").addClass("d-none");
                              var op = $("#edit-title option");
                              op[0].selected = "selected";
                              var i;
                              for(i=0;i<op.length;i++)
                              {
                                if(op[i].value == selected_value)
                                {
                                  op[i].remove();
                                }
                              }
                
                            }
                        }
                      });
                    });
                    var all_data = JSON.parse(response.trim());
                    var image = document.createElement("img");
                    image.src = all_data[0];
                    image.style.width = "100%";
                    image.style.position = "absolute";
                    image.style.top = "0";
                    image.style.left = "0";
                    $(".showcase-preview").append(image);
                    $(".showcase-title").html(all_data[1]);
                    $(".showcase-title").css({
                      color : all_data[2],
                      fontSize : all_data[3]
                    });

                    $(".showcase-subtitle").html(all_data[4]);
                    $(".showcase-subtitle").css({
                      color : all_data[5],
                      fontSize : all_data[6]
                    });
                    $(".title-buttons").html(all_data[9]);
                    $("#title-text").val(all_data[1]);
                    $("#subtitle-text").val(all_data[4]);

                    //edit btn button
                    $(".title-btn").each(function(){
                      $(this).click(function(){

                        sessionStorage.setItem("btn-key",$(this).index());
                        $(".delete-btn").removeClass("d-none");
                        var url = $(this).children().attr("href");
                        $(".btn-url").val(url);
                        var name = $(this).children().html();
                        $(".btn-name").val(name);
                        var color = $(this).css("backgroundColor").replace("rgb(",'').replace(")",'');
                        var rgb = color.split(",");
                        var i;
                        var color_code = "";
                        for(i=0;i<rgb.length;i++)
                        {
                            var hex_code = Number(rgb[i]).toString(16);
                            color_code += hex_code.length == 1 ? "0"+hex_code : hex_code;

                        }
                        $(".btn-bgcolor").val("#"+color_code);


                        var text_color = $(this).children().css("color").replace("rgb(",'').replace(")",'');
                        var text_rgb = text_color.split(",");
                        var i;
                        var text_color_code = "";
                        for(i=0;i<text_rgb.length;i++)
                        {
                            var text_hex_code = Number(text_rgb[i]).toString(16);
                            text_color_code += text_hex_code.length == 1 ? "0"+text_hex_code : text_hex_code;

                        }
                        $(".btn-textcolor").val("#"+text_color_code);

                        var btn_size = $(this).children().css('fontSize');
                        for(i=0;i<$(".btn-size").children().length;i++){
                          var option = $(".btn-size").children();
                          if(option[i].value == btn_size)
                          {
                            option[i].selected = true;
                          }
                        }

                      });
                    });
                    $(".btn-name").on("input",function(){
                      var index_no = Number(sessionStorage.getItem("btn_key"));
                      var selected_btn = document.getElementsByClassName("title-btn")[index_no];
                      selected_btn.getElementsByTagName("A")[0].innerHTML = this.value;
                    });

                    $(".btn-bgcolor").on("change",function(){
                      var index_no = Number(sessionStorage.getItem("btn_key"));
                      var selected_btn = document.getElementsByClassName("title-btn")[index_no];
                      selected_btn.style.backgroundColor = this.value;
                    });

                    $(".btn-textcolor").on("change",function(){
                      var index_no = Number(sessionStorage.getItem("btn_key"));
                      var selected_btn = document.getElementsByClassName("title-btn")[index_no];
                      selected_btn.getElementsByTagName("A")[0].style.color = this.value;
                    });
                    $(".btn-size").on("change",function(){
                      var index_no = Number(sessionStorage.getItem("btn_key"));
                      var selected_btn = document.getElementsByClassName("title-btn")[index_no];
                      selected_btn.getElementsByTagName("A")[0].fontSize = this.value;

                    });

                    $(".delete-btn").on("click",function(){
                      var index_no = Number(sessionStorage.getItem("btn_key"));
                      var selected_btn = document.getElementsByClassName("title-btn")[index_no];
                      selected_btn.remove();
                      $(".btn-url,.btn-name").val("");
                      $(".btn-bgcolor,.btn-textcolor").val("#000000");
                      var op = $(".btn-size option");
                      op[0].selected = "selected";
                      $(".delete-btn").addClass("d-none");
                    });

                  }
                });
            }
            else{
              $(".add-showcase-btn").html("Add showcase");
              $(".add-showcase-btn").removeClass("bg-danger");
              $(".add-showcase-btn").addClass("bg-primary");
              $(".header-showcase-form").trigger("reset");
              $(".showcase-preview").html(showcase_preview);
              $(".delete-edit").addClass("d-none");

            }
          });
        });
      </script>

  </body>
</html>
