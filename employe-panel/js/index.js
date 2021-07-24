$(document).ready(function () {
  $(".stock-update-btn").click(function () {
    $(".stock-update-btn-menu").collapse("toggle");
  });
});

$(document).ready(function () {
  $(".homepage-design-btn").click(function () {
    $(".homepage-design-collapse").collapse("toggle");
  });
});

//dynamic request

$(document).ready(function () {
  var active_link = $(".active").attr("access-link");
  dynamic_request(active_link);
  $(".collapse-item").each(function () {
    $(this).click(function () {
      var request_link = $(this).attr("access-link");
      dynamic_request(request_link);
    });
  });
});

//active tab
$(document).ready(function () {
  var i;
  $(".collapse-item").each(function () {
    $(this).click(function () {
      for (i = 0; i < $(".collapse-item").length; i++) {
        $(".collapse-item").removeClass("active");
      }
      $(this).addClass("active");
    });
  });
});

function dynamic_request(request_link) {
  $.ajax({
    type: "POST",
    url: "dynamic_pages/" + request_link,
    xhr: function () {
      var request = new XMLHttpRequest();
      request.onprogress = function (e) {
        var percentege = Math.floor((e.loaded * 100) / e.total);
        var loader =
          '<center><button style="font-size:18px"><i class="fa fa-circle-o-notch fa-spin"></i>Loading...' +
          percentege +
          "%</button></center>";
        $(".page").html(loader);
      };
      return request;
    },
    beforeSend: function () {
      var loader =
        '<center><button style="font-size:18px"><i class="fa fa-circle-o-notch fa-spin"></i></button></center>';
      $(".page").html(loader);
    },
    success: function (response) {
      $(".page").html(response);
      if (request_link == "delivery_area_design.php") {
        delivery_area();
      }
      if (request_link == "category_showcase_design.php") {
        category_showcase();
      }
      if (request_link == "header_showcase_design.php") {
        header_showcase();
      }
      if (request_link == "branding_design.php") {
        branding_info();
      }
      if (request_link == "sales_report_design.php") {
        sales_report();
      }
      if (request_link == "keyword_planner_design.php") {
        keyword();
      }
      //====================create product =================
      $(".create-product-form").on("submit", function (e) {
        var option = $(".brands-name option");
        var i;
        var c_name;
        for (i = 0; i < option.length; i++) {
          if (option[i].innerHTML == $(".brands-name").val()) {
            c_name = $(option[i]).attr("c-name");
          }
        }
        // console.log(c_name);
        // return false;
        e.preventDefault();
        if ($(".brands-name").val() != "Choose brands") {
          $.ajax({
            type: "POST",
            url: "php/create_products.php?c_name=" + c_name,
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            xhr: function () {
              var request = new XMLHttpRequest();
              request.upload.onprogress = function () {
                var percentage = Math.floor((e.loaded * 100) / e.total);
                $(".progress-bar").css({
                  width: percentage + "%",
                });
                $(".progress-bar").html(percentage + "%");
              };
              return request;
            },
            beforeSend: function () {
              $(".create-products-progress").removeClass("d-none");
            },
            success: function (response) {
              if (response == "success") {
                $(".create-products-progress").addClass("d-none");
                $(".progress-bar").css({ width: "0" });
                $(".create-product-form").trigger("reset");
                setTimeout(function () {
                  $("#sub-modal").modal("show");
                  //send notifications
                  $(".send-btn").click(function () {
                    $.ajax({
                      type: "POST",
                      url: "php/send_notification.php",
                      beforeSend: function () {
                        $(".send-btn").html("processing....");
                      },
                      success: function (response) {
                        if (response.trim() == "success") {
                          $(".send-btn").html("success");
                          setTimeout(function () {
                            $("#sub-modal").modal({
                              show: false,
                            });
                          }, 2000);
                        }
                        else {
                          $(".send-btn").html(response);
                        }
                      }
                    });
                  });
                }, 1000);
              } else {
                alert(response);
              }
            },
          });
        } else {
          alert("please choose a brand");
        }
      });

      if (request_link == "create_category_design.php") {
        category_list();
      }
      $(".add-field-btn").click(function () {
        var placeholder = $(".input:first").attr("placeholder");
        var input = document.createElement("INPUT");
        input.type = "text";
        input.className = "form-control input mb-3";
        input.placeholder = placeholder;
        input.required = "required";
        input.style.background = "#f9f9f9";
        input.style.border = "none";
        $(".add-field-area").append(input);
      });
      $(".create-btn").click(function (e) {
        e.preventDefault();
        var input = [];
        var input_length = $(".input").length;
        var i;
        for (i = 0; i < input_length; i++) {
          input[i] = document.getElementsByClassName("input")[i].value;
        }
        var object = JSON.stringify(input);
        $.ajax({
          type: "POST",
          url: "php/create_category.php",
          data: {
            json_data: object,
          },
          beforeSend: function () {
            $(".create_category_loader").removeClass("d-noe");
          },
          success: function (response) {
            $(".create_category_loader").addClass("d-noe");
            if (response.trim() == "done") {
              category_list();
              var notice = document.createElement("DIV");
              notice.className = "alert alert-success";
              notice.innerHTML = "<b>success !</b>";
              $(".create_category_notice").html(notice);
              setTimeout(function () {
                $(".create_category_notice").html("");
                $(".create-category-form").trigger("reset");
              }, 3000);
            } else {
              var notice = document.createElement("DIV");
              notice.className = "alert alert-success";
              notice.innerHTML = "<b>" + response + "</b>";
              $(".create_category_notice").html(notice);
              setTimeout(function () {
                $(".create_category_notice").html("");
                $(".create-category-form").trigger("reset");
              }, 3000);
            }
          },
        });
      });
      // ================= add brand field ====================
      $(".add-brand-btn").click(function () {
        var placeholder = $(".brand-input:first").attr("placeholder");
        var input = document.createElement("INPUT");
        input.type = "text";
        input.className = "form-control brand-input mb-3";
        input.placeholder = placeholder;
        input.required = "required";
        input.style.background = "#f9f9f9";
        input.style.border = "none";
        $(".brand-field-area").append(input);
      });
      //===================== CREATE BRANDS ==============================
      $(".create-brand-btn").click(function (e) {
        e.preventDefault();

        var category = $(".brand-category").val();
        if (category == "Choose category") {
          var notice = document.createElement("DIV");
          notice.className = "alert alert-success";
          notice.innerHTML = "<b>please choose a category</b>";
          $(".create-brand-notice").html(notice);
          setTimeout(function () {
            $(".create-brand-notice").html("");
            $(".brand-form").trigger("reset");
          }, 1000);
        } else {
          var input = [];
          var input_length = $(".brand-input").length;

          var i;
          for (i = 0; i < input_length; i++) {
            input[i] = document.getElementsByClassName("brand-input")[i].value;
          }
          var object = JSON.stringify(input);

          $.ajax({
            type: "POST",
            url: "php/create_brand.php",
            data: {
              json_data: object,
              category: category,
            },
            beforeSend: function () {
              $(".brand-loader").removeClass("d-none");
            },
            success: function (response) {
              $(".brand-loader").addClass("d-none");
              if (response.trim() == "done") {
                var notice = document.createElement("DIV");
                notice.className = "alert alert-success";
                notice.innerHTML = "<b>success !</b>";
                $(".create-brand-notice").html(notice);
                setTimeout(function () {
                  $(".create-brand-notice").html("");
                  $(".brand-form").trigger("reset");
                }, 3000);
              } else {
                var notice = document.createElement("DIV");
                notice.className = "alert alert-success";
                notice.innerHTML = "<b>" + response + "</b>";
                $(".create-brand-notice").html(notice);
                setTimeout(function () {
                  $(".create-brand-notice").html("");
                  $(".brand-form").trigger("reset");
                }, 10000);
              }
            },
          });
        }
      });

      //======================== display brand =================
      $(document).ready(function () {
        $(".display-brand").on("change", function () {
          var selected_cat_name = $(this).val();
          var all_options = $(this)
            .html()
            .replace("<option>Choose category</option>")
            .replace("<option>" + selected_cat_name + "</option>");
          $.ajax({
            type: "POST",
            url: "php/display_brands.php",
            data: {
              category_name: selected_cat_name,
            },
            beforeSend: function () {
              $(".brand-display-loader").removeClass("d-none");
            },
            success: function (response) {
              if (
                response.trim() !=
                "<b>No brands has been created in this category</b>"
              ) {
                var table = document.createElement("table");
                table.style.width = "100%";
                //table.style.border = "1px solid black";
                table.border = "1";

                table.className = "text-center";
                var top_tr = document.createElement("tr");
                var th_cat = document.createElement("th");
                th_cat.innerHTML = "category";
                th_cat.style.height = "40px";
                th_cat.className = "bg-danger text-light";
                var th_brands = document.createElement("th");
                th_brands.innerHTML = "Brands";
                th_brands.style.height = "40px";
                th_brands.className = "bg-danger text-light";
                var th_edit = document.createElement("th");
                th_edit.innerHTML = "edit";
                th_edit.style.height = "40px";
                th_edit.className = "bg-danger text-light";
                var th_delete = document.createElement("th");
                th_delete.innerHTML = "delete";
                th_delete.style.height = "40px";
                th_delete.className = "bg-danger text-light";
                top_tr.append(th_cat);
                top_tr.append(th_brands);
                top_tr.append(th_edit);
                top_tr.append(th_delete);
                table.append(top_tr);

                $(".brand-display-loader").addClass("d-none");
                var json_data = JSON.parse(response);
                var i;
                for (i = 0; i < json_data.length; i++) {
                  var tr = document.createElement("TR");
                  var td_category_name = document.createElement("TD");
                  var td_brands = document.createElement("TD");

                  td_category_name.innerHTML =
                    "<select class='border p-2 my-1 dynamic-c-name' disabled = 'disabled' ><option>" +
                    json_data[i].category_name +
                    "</option>" +
                    all_options +
                    "</select>";
                  td_brands.innerHTML = json_data[i].brands;

                  var td_edit = document.createElement("td");
                  td_edit.innerHTML =
                    "<i class='fa fa-edit brand-edit mx-2' c-name = '" +
                    json_data[i].category_name +
                    "' b-name = '" +
                    json_data[i].brands +
                    "'></i><i class='fa fa-save brand-save d-none' c-name = '" +
                    json_data[i].category_name +
                    "' b-name = '" +
                    json_data[i].brands +
                    "'></i>";

                  var td_delete = document.createElement("td");
                  td_delete.innerHTML =
                    "<i class='fa fa-trash brand-delete' c-name = '" +
                    json_data[i].category_name +
                    "' b-name = '" +
                    json_data[i].brands +
                    "'></i>";
                  table.append(tr);
                  tr.append(td_category_name);
                  tr.append(td_brands);
                  tr.append(td_edit);
                  tr.append(td_delete);
                  $(".brand-list-area").html(table);

                  //===================== delete brands =============================
                  $(".brand-delete").each(function () {
                    $(this).click(function () {
                      var delete_icon = this;
                      var c_name = $(this).attr("c-name");
                      var b_name = $(this).attr("b-name");
                      $.ajax({
                        type: "POST",
                        url: "php/delete_brands.php",
                        data: {
                          c_name: c_name,
                          b_name: b_name,
                        },
                        success: function (response) {
                          if (response.trim() == "<b>Delete Success</b>") {
                            var row = delete_icon.parentElement.parentElement;
                            row.remove();
                          }
                        },
                      });
                    });
                  });
                  //==================== Brand Edit ==========================================
                  $(".brand-edit").each(function () {
                    $(this).click(function () {
                      $(this).addClass("d-none");
                      var edit_icon = $(this);
                      var c_name = $(this).attr("c-name");
                      var b_name = $(this).attr("b-name");
                      var row = this.parentElement.parentElement;
                      var td = row.getElementsByTagName("TD");
                      var select_tag =
                        td[0].getElementsByClassName("dynamic-c-name")[0];
                      select_tag.disabled = false;
                      td[1].contentEditable = true;
                      td[1].focus();
                      var delete_icon =
                        td[3].getElementsByClassName("brand-delete")[0];
                      var save_icon =
                        td[2].getElementsByClassName("brand-save")[0];
                      $(save_icon).removeClass("d-none");

                      save_icon.onclick = function () {
                        $.ajax({
                          type: "POST",
                          url: "php/edit_brand.php",
                          data: {
                            previous_c_name: c_name,
                            previous_b_name: b_name,
                            c_name: select_tag.value,
                            b_name: td[1].innerHTML,
                          },
                          success: function (response) {
                            if (response.trim() == "update success") {
                              $(save_icon).addClass("d-none");
                              $($edit_icon).removeClass("d-none");
                              td[1].contentEditable = false;
                              select_tag.disabled = true;
                              $(edit_icon).attr("c-name", select_tag.val);
                              $(edit_icon).attr("b-name", td[1].innerHTML);

                              $(save_icon).attr("c-name", select_tag.val);
                              $(save_icon).attr("b-name", td[1].innerHTML);

                              $(delete_icon).attr("c-name", select_tag.val);
                              $(delete_icon).attr("b-name", td[1].innerHTML);
                            }
                          },
                        });
                      };
                    });
                  });
                }
              } else {
                $(".brand-list-area").html(response);
              }
            },
          });
        });
      });
    },
  });
}

//===================== category list request ========================

$(document).ready(function () {
  //  category_list();
});

function category_list() {
  $(".category-area").html("");
  $.ajax({
    type: "POST",
    url: "php/category.php",
    success: function (response) {
      var category_list = JSON.parse(response);
      var i;
      for (i = 0; i < category_list.length; i++) {
        var id = category_list[i].id;
        var name = category_list[i].category_name;
        var ul = document.createElement("ul");
        ul.className = "list-group";
        var li = document.createElement("li");
        li.className = "list-group-item mb-3 border-0";
        ul.append(li);
        var div = document.createElement("div");
        div.className = "btn-group";
        li.append(div);
        var id_btn = document.createElement("BUTTON");
        id_btn.innerHTML = id;
        id_btn.className = "btn btn-danger id";
        div.append(id_btn);

        var name_btn = document.createElement("BUTTON");
        name_btn.innerHTML = name;
        name_btn.className = "btn btn-dark name";
        div.append(name_btn);

        var edit_btn = document.createElement("BUTTON");
        edit_btn.innerHTML =
          "<i class='fa fa-edit edit-icon'></i><i class='fa fa-save save-icon d-none'></i>";
        edit_btn.className = "btn btn-info";
        div.append(edit_btn);

        var delete_btn = document.createElement("BUTTON");
        delete_btn.innerHTML = "<i class='fa fa-trash delete-icon'></i>";
        delete_btn.className = "btn btn-danger";
        div.append(delete_btn);
        $(".category-area").append(ul);

        // edit category name
        edit_btn.onclick = function () {
          var parent = this.parentElement;
          var id = parent.getElementsByClassName("id")[0];
          var cat_name = parent.getElementsByClassName("name")[0];
          var save_icon = parent.getElementsByClassName("save-icon")[0];
          var edit_icon = parent.getElementsByClassName("edit-icon")[0];
          cat_name.contentEditable = true;
          cat_name.focus();
          $(save_icon).removeClass("d-none");
          $(edit_icon).addClass("d-none");
          $(".save-icon").click(function () {
            var changed_name = cat_name.innerHTML.trim();
            $.ajax({
              type: "POST",
              url: "php/edit_category_name.php",

              data: {
                id: id.innerHTML.trim(),
                change_name: changed_name,
              },
              cache: false,
              success: function (response) {
                if (response.trim() == "success") {
                  cat_name.contentEditable = false;
                  $(save_icon).addClass("d-none");
                  $(edit_icon).removeClass("d-none");
                } else {
                  alert(response);
                }
              },
            });
          });
        };
        //====================== delete category =============================
        delete_btn.onclick = function () {
          var parent = this.parentElement;
          var id = parent.getElementsByClassName("id")[0].innerHTML.trim();
          $.ajax({
            type: "POST",
            url: "php/delete_category_name.php",
            cache: false,
            data: {
              id: id,
            },
            success: function (response) {
              if (response.trim() == "success") {
                parent.remove();
                parent.parentElement.parentElement.parent.remove();
              } else {
                alert(response);
              }
            },
          });
        };
      }
    },
  });
}
// branding information

function branding_info() {
  $(document).ready(function () {
    $("#about-us").on("input", function () {
      var length = $(this).val().length;
      $(".about-us-count").html(length);
    });

    $("#privacy-policy").on("input", function () {
      var length = $(this).val().length;
      $(".privacy-policy-count").html(length);
    });

    $("#terms-conditions").on("input", function () {
      var length = $(this).val().length;
      $(".terms-conditions-count").html(length);
    });

    $("#cookies").on("input", function () {
      var length = $(this).val().length;
      $(".cookies-count").html(length);
    });

    //branding details
    $(document).ready(function () {
      $(".branding-form").on("submit", function (e) {
        e.preventDefault();
        var file = document.getElementById("brand-logo");
        var file_size;
        if (file.value == "") {
          file_size = 0;
        } else {
          file_size = file.files[0].size;
        }
        if (file_size < 200000) {
          $.ajax({
            type: "POST",
            url: "php/branding.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            catch: false,
            success: function (response) {
              alert(response);
            },
          });
        } else {
          alert("please upload less than 200kb file");
        }
      });
    });

    //branding details control

    $(document).ready(function () {
      $.ajax({
        type: "POST",
        url: "php/check_branding_table.php",
        success: function (response) {
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
          $(
            ".branding-from input,.branding-from textarea,.branding-form button"
          ).prop("disabled", true);
          $(".brand_edit").click(function () {
            $(
              ".branding-from input,.branding-from textarea,.branding-form button"
            ).prop("disabled", false);
            $("#brand-logo").removeAttr("required");
          });
        },
      });
    });
  });
}

// ================================== header showcase ==========================
function header_showcase() {
  $(document).ready(function () {
    $(".target").each(function () {
      $(this).click(function (event) {
        var element = event.target;
        var index_number = $(element).index();
        sessionStorage.setItem("index_number", index_number);
        var i;
        for (i = 0; i < $(".target").length; i++) {
          $(".target").css({
            border: "",
            width: "",
            boxShadow: "",
            padding: "",
          });
        }
        $(this).css({
          border: "2px solid red",
          width: "fit-Content",
          boxShadow: "0px 0px 3px grey",
          padding: "2px",
        });
      });

      $(this).on("dblclick", function () {
        var i;
        for (i = 0; i < $(".target").length; i++) {
          $(".target").css({
            border: "",
            width: "",
            boxShadow: "",
            padding: "",
          });
        }
      });
    });

    $(".color-selector").on("change", function () {
      var color = this.value;
      var in_number = Number(sessionStorage.getItem("index_number"));
      var element = document.getElementsByClassName("target")[in_number];
      element.style.color = color;
    });

    $(".font-size").on("input", function () {
      var size = this.value;
      var in_number = Number(sessionStorage.getItem("index_number"));
      var element = document.getElementsByClassName("target")[in_number];
      element.style.fontSize = size + "%";
    });
  });

  //title image upload
  $(document).ready(function () {
    $("#title-image").on("change", function () {
      var file = this.files[0];
      if (file.size < 200000) {
        var url = URL.createObjectURL(file);
        var image = new Image();
        image.src = url;
        image.onload = function () {
          var o_width = image.width;
          var o_height = image.height;
          if (o_width < 1920 && o_height < 978) {
            image.style.width = "100%";
            image.style.position = "absolute";
            image.style.top = "0";
            image.style.left = "0";
            $(".showcase-preview").append(image);
          } else {
            alert("please choose another files");
          }
        };
      } else {
        alert("please upload less than 200kb file");
      }
    });
  });
  //textarea maxlength
  $(document).ready(function () {
    $("#title-text").on("input", function () {
      var length = this.value.length;
      $(".showcase-title").html(this.value);
      $(".title-limit").html(length);
    });

    $("#subtitle-text").on("input", function () {

      var length = this.value.length;
      $(".showcase-subtitle").html(this.value);
      $(".subtitle-limit").html(length);
    });

    //add Showcase
    $(".header-showcase-form").submit(function (e) {
      e.preventDefault();
      var title = document.querySelector(".showcase-title");
      var subtitle = document.querySelector(".showcase-subtitle");
      var file = document.querySelector("#title-image").files[0];
      var title_size = "";
      var title_color = "";
      if (title.style.fontSize == "") {
        title_size = "300%";
      } else {
        title_size = title.style.fontSize;
      }

      if (title.style.color == "") {
        title_color = "black";
      } else {
        title_color = title.style.color;
      }
      var subtitle_size = "";
      var subtitle_color = "";
      if (subtitle.style.fontSize == "") {
        subtitle_size = "300%";
      } else {
        subtitle_size = subtitle.style.fontSize;
      }

      if (subtitle.style.color == "") {
        subtitle_color = "black";
      } else {
        subtitle_color = subtitle.style.color;
      }

      var flex_box = document.querySelector(".showcase-preview");
      var h_align = "";
      var v_align = "";
      if (flex_box.style.justifyContent == "") {
        h_align = "flex-start";
      } else {
        h_align = flex_box.style.justifyContent;
      }

      if (flex_box.style.alignItems == "") {
        v_align = "flex-start";
      } else {
        v_align = flex_box.style.alignItems;
      }
      var css_data = {
        title_size: title_size,
        title_color: title_color,
        subtitle_size: subtitle_size,
        subtitle_color: subtitle_color,
        h_align: h_align,
        v_align: v_align,
        title_text: title.innerHTML,
        subtitle_text: subtitle.innerHTML,
        button: $(".title-buttons").html().trim(),
        option: $("#edit-title").val(),
      };
      var formdata = new FormData();
      formdata.append("file_data", file);
      formdata.append("css_data", JSON.stringify(css_data));

      //console.log(css_data);
      $.ajax({
        type: "POST",
        url: "php/header_showcase.php",
        data: formdata,
        contentType: false,
        processData: false,
        catch: false,
        success: function (response) {
          alert(response);
        },
      });
    });
  });
  //alignment
  $(document).ready(function () {
    $(".alignment").each(function () {
      $(this).click(function () {
        var align_position = $(this).attr("align-position");
        var align_value = $(this).attr("align-value");
        //alert(align_position);
        if (align_position == "h") {
          $(".showcase-preview").css({
            justifyContent: align_value,
          });
        } else if (align_position == "v") {
          alignItems = align_value;
        }
      });
    });
  });

  //================add btn =============================
  $(document).ready(function () {
    $(".add-btn").click(function () {
      var button = document.createElement("button");

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
      if (button_length == 0 || button_length == 1) {
        $(".title-buttons").append(button);
      } else {
        alert("only two button are allowed");
      }
    });
  });

  $(document).ready(function () {
    $(".real-preview-btn").click(function () {
      var file = document.querySelector("#title-image").files[0];
      var form_data = new FormData();
      form_data.append("photo", file);
      var flex_box = document.querySelector(".showcase-preview");
      var h_align = "";
      var v_align = "";
      if (flex_box.style.justifyContent == "") {
        h_align = "flex-start";
      } else {
        h_align = flex_box.style.justifyContent;
      }

      if (flex_box.style.alignItems == "") {
        v_align = "flex-start";
      } else {
        v_align = flex_box.style.alignItems;
      }
      var array = [$(".title-box").html().trim(), h_align, v_align];
      form_data.append("data", JSON.stringify(array));
      $.ajax({
        type: "POST",
        url: "php/preview.php",
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
          var page = window.open("about:blank");
          page.document.open();
          page.document.write(response);
          page.document.close();
        },
      });
    });
  });

  //edit title
  $(document).ready(function () {
    var showcase_preview = $(".showcase-preview").html();
    $("#edit-title").on("change", function () {
      if ($(this).val() != "choose title") {
        $.ajax({
          type: "POST",
          url: "php/edit_title.php",
          data: {
            id: $(this).val(),
          },
          success: function (response) {
            $("#title-image").removeAttr("required");
            var selected_value = $("#edit-title").val();
            $(".add-showcase-btn").html("Save edit");
            $(".add-showcase-btn").removeClass("bg-primary");
            $(".add-showcase-btn").addClass("bg-danger");
            $(".delete-edit").removeClass("d-none");
            $(".delete-edit").click(function () {
              $.ajax({
                type: "POST",
                url: "php/delete_title.php",
                data: {
                  id: $("#edit-title").val(),
                },
                success: function (response) {
                  if (response.trim() == "success") {
                    $(".add-showcase-btn").html("Add showcase");
                    $(".add-showcase-btn").removeClass("bg-danger");
                    $(".add-showcase-btn").addClass("bg-primary");
                    $(".header-showcase-form").trigger("reset");
                    $(".showcase-preview").html(showcase_preview);
                    $(".delete-edit").addClass("d-none");
                    var op = $("#edit-title option");
                    op[0].selected = "selected";
                    var i;
                    for (i = 0; i < op.length; i++) {
                      if (op[i].value == selected_value) {
                        op[i].remove();
                      }
                    }
                  }
                },
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
              color: all_data[2],
              fontSize: all_data[3],
            });

            $(".showcase-subtitle").html(all_data[4]);
            $(".showcase-subtitle").css({
              color: all_data[5],
              fontSize: all_data[6],
            });
            $(".title-buttons").html(all_data[9]);
            $("#title-text").val(all_data[1]);
            $("#subtitle-text").val(all_data[4]);

            //edit btn button
            $(".title-btn").each(function () {
              $(this).click(function () {
                sessionStorage.setItem("btn-key", $(this).index());
                $(".delete-btn").removeClass("d-none");
                var url = $(this).children().attr("href");
                $(".btn-url").val(url);
                var name = $(this).children().html();
                $(".btn-name").val(name);
                var color = $(this)
                  .css("backgroundColor")
                  .replace("rgb(", "")
                  .replace(")", "");
                var rgb = color.split(",");
                var i;
                var color_code = "";
                for (i = 0; i < rgb.length; i++) {
                  var hex_code = Number(rgb[i]).toString(16);
                  color_code +=
                    hex_code.length == 1 ? "0" + hex_code : hex_code;
                }
                $(".btn-bgcolor").val("#" + color_code);

                var text_color = $(this)
                  .children()
                  .css("color")
                  .replace("rgb(", "")
                  .replace(")", "");
                var text_rgb = text_color.split(",");
                var i;
                var text_color_code = "";
                for (i = 0; i < text_rgb.length; i++) {
                  var text_hex_code = Number(text_rgb[i]).toString(16);
                  text_color_code +=
                    text_hex_code.length == 1
                      ? "0" + text_hex_code
                      : text_hex_code;
                }
                $(".btn-textcolor").val("#" + text_color_code);

                var btn_size = $(this).children().css("fontSize");
                for (i = 0; i < $(".btn-size").children().length; i++) {
                  var option = $(".btn-size").children();
                  if (option[i].value == btn_size) {
                    option[i].selected = true;
                  }
                }
              });
            });
            $(".btn-name").on("input", function () {
              var index_no = Number(sessionStorage.getItem("btn_key"));
              var selected_btn =
                document.getElementsByClassName("title-btn")[index_no];
              selected_btn.getElementsByTagName("A")[0].innerHTML = this.value;
            });

            $(".btn-bgcolor").on("change", function () {
              var index_no = Number(sessionStorage.getItem("btn_key"));
              var selected_btn =
                document.getElementsByClassName("title-btn")[index_no];
              selected_btn.style.backgroundColor = this.value;
            });

            $(".btn-textcolor").on("change", function () {
              var index_no = Number(sessionStorage.getItem("btn_key"));
              var selected_btn =
                document.getElementsByClassName("title-btn")[index_no];
              selected_btn.getElementsByTagName("A")[0].style.color =
                this.value;
            });
            $(".btn-size").on("change", function () {
              var index_no = Number(sessionStorage.getItem("btn_key"));
              var selected_btn =
                document.getElementsByClassName("title-btn")[index_no];
              selected_btn.getElementsByTagName("A")[0].fontSize = this.value;
            });

            $(".delete-btn").on("click", function () {
              var index_no = Number(sessionStorage.getItem("btn_key"));
              var selected_btn =
                document.getElementsByClassName("title-btn")[index_no];
              selected_btn.remove();
              $(".btn-url,.btn-name").val("");
              $(".btn-bgcolor,.btn-textcolor").val("#000000");
              var op = $(".btn-size option");
              op[0].selected = "selected";
              $(".delete-btn").addClass("d-none");
            });
          },
        });
      } else {
        $("#title-image").Attr("required");
        $(".add-showcase-btn").html("Add showcase");
        $(".add-showcase-btn").removeClass("bg-danger");
        $(".add-showcase-btn").addClass("bg-primary");
        $(".header-showcase-form").trigger("reset");
        $(".showcase-preview").html(showcase_preview);
        $(".delete-edit").addClass("d-none");
      }
    });
  });
}
// ==================== category showcase =================
function category_showcase() {
  $(document).ready(function () {
    $(".upload-icon").each(function () {
      $(this).on("change", function () {
        var upload_icon = this;
        var dummy_pic =
          upload_icon.parentElement.parentElement.parentElement.getElementsByTagName(
            "img"
          )[0];
        var input =
          upload_icon.parentElement.parentElement.getElementsByTagName(
            "INPUT"
          )[1];
        var set_btn =
          upload_icon.parentElement.parentElement.getElementsByClassName(
            "set-btn"
          )[0];
        var dummy_pic_width = dummy_pic.naturalWidth;
        var dummy_pic_height = dummy_pic.naturalHeight;
        var file = upload_icon.files[0];
        var url = URL.createObjectURL(file);

        var image = new Image();
        image.src = url;

        var upload_width = "";
        var upload_height = "";
        image.onload = function () {
          upload_width = image.width;
          upload_height = image.height;
          if (
            dummy_pic_width == upload_width &&
            dummy_pic_height == upload_height
          ) {
            input.oninput = function () {
              if (this.value.length >= 1) {
                set_btn.disabled = false;
                set_btn.onclick = function () {
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
                    beforeSend: function () {
                      set_btn.innerHTML = "please wait";
                    },
                    success: function (response) {
                      if (response.trim() == "success") {
                        dummy_pic.src = url;
                        set_btn.innerHTML = "SET";
                        $(upload_icon.parentElement.parentElement).addClass(
                          "d-none"
                        );

                        dummy_pic.ondblclick = function () {
                          $(
                            upload_icon.parentElement.parentElement
                          ).removeClass("d-none");
                        };
                      }
                    },
                  });
                };
              } else {
                set_btn.disabled = true;
              }
            };
          } else {
            alert("please upload " + dummy_pic_width + "/" + dummy_pic_height);
          }
        };
      });
    });
  });
  $(document).ready(function () {
    var img = $("img");
    var i;
    for (i = 0; i < img.length; i++) {
      if (img[i].src.indexOf("base64") != -1) {
        var set_btn = img[i].parentElement.getElementsByClassName("set-btn")[0];
        // alert(set_btn.length);
        set_btn.disabled = false;
        $(set_btn).each(function () {
          $(this).click(function () {
            set_btn = this;
            var input = this.parentElement.getElementsByTagName("INPUT");
            var file = input[0].files[0];
            var text = input[1].value;
            var dummy_pic =
              this.parentElement.parentElement.getElementsByTagName("img")[0];
            var url = dummy_pic.src;
            if (input[0].files[0] != "") {
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
              beforeSend: function () {
                set_btn.innerHTML = "please wait";
              },
              success: function (response) {
                if (response.trim() == "success") {
                  dummy_pic.src = url;
                  set_btn.innerHTML = "SET";
                  $(set_btn.parentElement).addClass("d-none");

                  dummy_pic.ondblclick = function () {
                    $(set_btn.parentElement).removeClass("d-none");
                  };
                }
              },
            });
          });
        });
      }
    }
  });
}

//delivery area
function delivery_area() {
  //get states
  $("document").ready(function () {
    $(".country").on("change", function () {
      $(".state").html('');
      var option = $(".country option");
      var i;
      for (i = 0; i < option.length; i++) {
        if (option[i].innerHTML == $(".country").val()) {
          var country_id = $(option[i]).attr("country_id");
          $.ajax({
            type: "POST",
            url: "php/get_states.php",
            data: {
              country_id: country_id
            },
            success: function (response) {
              var states = JSON.parse(response.trim());
              // console.log(states);
              var j;
              for (j = 0; j < states.length; j++) {
                var option = "<option state_id=" + states[j].id + ">" + states[j].name + "</option>";
                $(".state").append(option);
              }
            }
          });
        }
      }
    });
  });

  //get cities
  $("document").ready(function () {
    $(".state").on("change", function () {
      $('.city').html('');
      var option = $(".state option");
      for (var i = 0; i < option.length; i++) {
        if (option[i].innerHTML == $(".state").val()) {
          var state_id = $(option[i]).attr("state_id");
          $.ajax({
            type: "POST",
            url: "php/get_cities.php",
            data: {
              state_id: state_id
            },
            success: function (response) {
              var cities = JSON.parse(response.trim());
              for (var j = 0; j < cities.length; j++) {
                var option = "<option>" + cities[j].name + "</option>";
                $(".city").append(option);
              }
            }
          });
        }
      }
    });
  });
  //get PinCode
  $(document).ready(function () {
    $(".city").on("change", function () {
      var city = $(this).val();
      $.ajax({
        type: "GET",
        url: "https://api.postalpincode.in/postoffice/" + city,
        success: function (response) {
          if (response[0].PostOffice.length != 0 || response[0].PostOffice.length == 0) {
            var length = response[0].PostOffice.length - 1;
            $(".pin_code").val(response[0].PostOffice[length].Pincode);
          }
          // console.log(response);
          // alert(length);

        }
      });
    });
  });
  //set area 
  $(document).ready(function () {
    $(".set_area_form").submit(function (e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "php/set_area.php",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
          if (response.trim() == "success") {
            $(".set_area_form").trigger('reset');
          }
        }
      });
    });
  });
}

//sales report
function sales_report() {
  $(document).ready(function () {
    $(".dispatch_btn").each(function () {
      $(this).click(function () {
        var clicked_btn = this;
        var order_id = $(this).attr("order_id");
        var title = $(this).attr("title");
        var quantity = $(this).attr("quantity");
        var full_name = $(this).attr("full_name");
        var email = $(this).attr("email");
        var price = $(this).attr("amount");
        var phone = $(this).attr("phone");
        var address = $(this).attr("address");
        $.ajax({
          type: "POST",
          url: "php/dispatch.php",
          data: {
            order_id: order_id,
            title: title,
            quantity: quantity,
            full_name: full_name,
            email: email,
            price: price,
            phone: phone,
            address: address
          },
          beforeSend: function () {
            $(clicked_btn).html('wait....');
          },
          success: function (response) {
            if (response.trim() == "success") {
              $(clicked_btn).html('dispatched');
              //show dispatched item
              var item_no = Number(sessionStorage.getItem("count")) + 1;
              sessionStorage.setItem("count", item_no);
              $(".d_all_btn").html(item_no + " items dispatched");
              //complete dispatch
              var all_item_count = Number($(".s-no").length);
              if (all_item_count == item_no) {
                $(".d_all_btn").html('complete');
                sessionStorage.removeItem("count");
                setTimeout(function () {
                  $(".d_all_btn").html('dispatch all');
                }, 2000);
              }
            }
            alert(response);
          }
        });

      });

    });
  });
  $(document).ready(function () {
    $(".d_all_btn").click(function () {
      var status = $(".status");
      var i, message = "dispatch all";
      for (i = 0; i < status.length; i++) {
        if (status[i].innerHTML == "processing") {
          var dispatch_btn = $(".dispatch_btn");

          for (i = 0; i < dispatch_btn.length; i++) {
            dispatch_btn[i].click();
          }
        }
        else {
          message = "No item";
        }
      }
      $(".d_all_btn").html(message);

    });
  });

  //export to xls
  $(document).ready(function () {
    $(".choose_format").on('change', function () {
      if ($(this).val() == "xls") {
        window.location = "php/export_to_xls.php";
      }
      else if ($(this).val() == "pdf") {
        window.location = "php/dompdf.php";
      }
    });
  });
  //sort by 
  $(document).ready(function () {
    $(".sort-by").on("change", function () {
      $(".table-responsive").html("");
      if ($(this).val() != "all-data") {
        var option = $(this).val();
        $.ajax({
          type: "POST",
          url: "php/sort_by.php",
          data: {
            option: option,
          },
          success: function (response) {
            if (response.trim() != "order now found") {
              var table = document.createElement("table");
              table.className = "w-100 purchase-table text-center border table table-bordered";
              table.innerHTML = "<tr> <th>S/No</th><th>PRODUCT_ID</th><th>TITLE</th><th>QUANTITY</th><th>PRICE</th><th>ADDRESS</th><th>STATE</th><th>COUNTRY</th><th>PINCODE</th><th>PURCHASE DATE</th><th>CUSTOMER NAME</th><th>USERNAME</th><th>MOBILE</th><th>STATUS</th><th>ACTION</th></tr>";
              $(".table-responsive").append(table);
              var all_data = JSON.parse(response.trim());
              var i;
              for (i = 0; i < all_data.length; i++) {
                var tr = document.createElement("tr");
                var id_td = document.createElement("td");
                id_td.innerHTML = all_data[i].id;
                tr.append(id_td);

                var product_id_td = document.createElement("td");
                product_id_td.innerHTML = all_data[i].product_id;
                tr.append(product_id_td);

                var title_td = document.createElement("td");
                title_td.innerHTML = all_data[i].title;
                tr.append(title_td);

                var quantity_td = document.createElement("td");
                quantity_td.innerHTML = all_data[i].quantity;
                tr.append(quantity_td);

                var price_td = document.createElement("td");
                price_td.innerHTML = all_data[i].price;
                tr.append(price_td);

                var address_td = document.createElement("td");
                address_td.innerHTML = all_data[i].address;
                tr.append(address_td);

                var state_td = document.createElement("td");
                state_td.innerHTML = all_data[i].state;
                tr.append(state_td);

                var country_td = document.createElement("td");
                country_td.innerHTML = all_data[i].country;
                tr.append(country_td);

                var pincode_td = document.createElement("td");
                pincode_td.innerHTML = all_data[i].pincode;
                tr.append(pincode_td);

                var purchase_date_td = document.createElement("td");
                purchase_date_td.innerHTML = all_data[i].purchase_date;
                tr.append(purchase_date_td);

                var fullname_td = document.createElement("td");
                fullname_td.innerHTML = all_data[i].fullname;
                tr.append(fullname_td);

                var email_td = document.createElement("td");
                email_td.innerHTML = all_data[i].email;
                tr.append(email_td);

                var phone_td = document.createElement("td");
                phone_td.innerHTML = all_data[i].phone;
                tr.append(phone_td);

                var status_td = document.createElement("td");
                status_td.innerHTML = all_data[i].status;
                tr.append(status_td);

                if (all_data[i].status == 'processing') {
                  var action_button = document.createElement("button");
                  action_button.className = 'btn btn-success dispatch_btn';
                  $(action_button).html('dispatch');
                  $(action_button).attr("order_id", all_data[i].id);
                  $(action_button).attr("title", all_data[i].title);
                  $(action_button).attr("quantity", all_data[i].quantity);
                  $(action_button).attr("full_name", all_data[i].fullname);
                  $(action_button).attr("email", all_data[i].email);
                  $(action_button).attr("phone", all_data[i].phone);
                  $(action_button).attr("amount", all_data[i].amount);
                  $(action_button).attr("address", all_data[i].address);
                  var action_td = document.createElement('td');
                  action_td.append(action_button);
                  tr.append(action_td);
                  action_button.onclick = function () {
                    var clicked_btn = this;
                    var order_id = $(this).attr("order_id");
                    var title = $(this).attr("title");
                    var quantity = $(this).attr("quantity");
                    var full_name = $(this).attr("full_name");
                    var email = $(this).attr("email");
                    var price = $(this).attr("amount");
                    var phone = $(this).attr("phone");
                    var address = $(this).attr("address");
                    $.ajax({
                      type: "POST",
                      url: "php/dispatch.php",
                      data: {
                        order_id: order_id,
                        title: title,
                        quantity: quantity,
                        full_name: full_name,
                        email: email,
                        price: price,
                        phone: phone,
                        address: address
                      },
                      beforeSend: function () {
                        $(clicked_btn).html('wait....');
                      },
                      success: function (response) {
                        if (response.trim() == "success") {
                          $(clicked_btn).html('dispatched');
                          //show dispatched item
                          var item_no = Number(sessionStorage.getItem("count")) + 1;
                          sessionStorage.setItem("count", item_no);
                          $(".d_all_btn").html(item_no + " items dispatched");
                          //complete dispatch
                          var all_item_count = Number($(".s-no").length);
                          if (all_item_count == item_no) {
                            $(".d_all_btn").html('complete');
                            sessionStorage.removeItem("count");
                            setTimeout(function () {
                              $(".d_all_btn").html('dispatch all');
                            }, 2000);
                          }
                        }
                        alert(response);
                      }
                    });
                  }

                }
                else if (all_data[i].status == 'dispatched') {
                  var action_button = document.createElement("button");
                  action_button.innerHTML = "already dispatched on" + all_data[i].dispatched_date;
                  action_button.className = 'btn btn-danger';
                  var action_td = document.createElement('td');
                  action_td.append(action_button);
                  tr.append(action_td);
                }

                table.appendChild(tr);

              }
            }
          }
        });
      }
    });
  });
}


//keyword
function keyword() {
  $(document).ready(function () {
    $(".keyword-form").submit(function (e) {
      e.preventDefault();
      if ($(".p-keyword").val() != "CHOOSE PRIMARY KEYWORD") {
        $.ajax({
          type: "POST",
          url: "php/keyword.php",
          data: new FormData(this),
          processData: false,
          contentType: false,
          cache: false,
          success: function (response) {
            alert(response);
          }
        });
      }
      else {
        alert("please choose a keyword");
      }
    });
  });

  //appear secondary key

  $(document).ready(function () {
    $(".p-keyword").on("change", function () {
      if ($(this).val() != "CHOOSE PRIMARY KEYWORD") {
        var p_key = $(this).val();
        $.ajax({
          type: "POST",
          url: "php/appear_secondary_key.php",
          data: {
            p_key: p_key,
          },
          success: function (response) {
            $(".s-keyword").val($(".s-keyword").val() + response.trim());
            // console.log(response);
          }
        });
      }
    });
  });
  $(document).ready(function () {
    $(".copy-btn").click(function () {
      var tags = "";
      $(".tags").each(function () {
        tags += $(this).text();
        $(".s-keyword").val(tags) + " , ";
      });
    });
  });

  $(document).ready(function () {
    $(".copy-btn-brands").click(function () {
      var tags = "";
      $(".tags").each(function () {
        tags += $(this).text();
        $(".brands-s-keyword").val(tags) + " , ";
      });
    });
  });

  //appear brands
  $(document).ready(function () {
    $(".brands-category").on("change", function () {
      if ($(this).val() != "Choose") {
        var cat_name = $(this).val();
        $.ajax({
          type: "POST",
          url: "php/show_brands.php",
          data: {
            cat_name: cat_name,
          },
          success: function (response) {
            $("#brands-p-keyword").html(response + $("#brands-p-keyword").val());
            // alert(response);
          }
        });
      }
    });
  });

  $(document).ready(function () {
    $(".brand-form").submit(function (e) {
      e.preventDefault();
      if ($(".brands-p-keyword").val() != "Choose primary key") {
        $.ajax({
          type: "POST",
          url: "php/keyword.php",
          data: new FormData(this),
          processData: false,
          contentType: false,
          cache: false,
          success: function (response) {
            alert(response);
          }
        });
      }
      else {
        alert("please choose a keyword");
      }
    });
  });

  //delete keyword
  $(document).ready(function () {
    $(".delete-keyword").click(function () {
      var tags = [];
      // alert();
      $(".tags").each(function (i) {
        tags[i] = $(this).text().trim();
      });
      $.ajax({
        type: "POST",
        url: "php/delete_keyword.php",
        data: {
          tags: JSON.stringify(tags),
        },
        success: function (response) {
          if (response.trim() == "success") {
            window.location = location.href;
          }
          // alert(response);
        }
      });
    });
  });
}

