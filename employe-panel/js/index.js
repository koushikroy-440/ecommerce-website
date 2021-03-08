$(document).ready(function(){
   $(".stock-update-btn").click(function(){
    $(".stock-update-btn-menu").collapse('toggle');
   });
});

//dynamic request

$(document).ready(function(){
    var active_link = $(".active").attr("access-link");
    dynamic_request(active_link);
    $(".collapse-item").each(function(){
       $(this).click(function(){
           var request_link =  $(this).attr("access-link");
           dynamic_request(request_link);
       });
    });
});

//active tab 
$(document).ready(function(){
    var i;
    $(".collapse-item").each(function(){
        $(this).click(function(){
            for(i=0;i<$(".collapse-item").length;i++)
            {
                $(".collapse-item").removeClass("active");
            }
            $(this).addClass("active");
        })
    });
});

function dynamic_request(request_link) {
    $.ajax({
        type: "POST",
        url:"dynamic_pages/"+request_link,
        xhr: function(){
            var request = new XMLHttpRequest();
            request.onprogress = function(e){
            var percentege = Math.floor((e.loaded*100)/e.total);
            var loader = '<center><button style="font-size:18px"><i class="fa fa-circle-o-notch fa-spin"></i>Loading...'+percentege+'%</button></center>';
            $(".page").html(loader);
            }
            return request;
        },
        beforeSend: function(){
            var loader = '<center><button style="font-size:18px"><i class="fa fa-circle-o-notch fa-spin"></i></button></center>';
            $(".page").html(loader);
        },
        success: function(response){
        
            $(".page").html(response);
            //console.log(request_link);
            if(request_link == "create_category_design.php")
            {
                category_list();
            }
            $(".add-field-btn").click(function(){
                
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
                for(i=0;i<input_length;i++)
                {
                    input[i] = document.getElementsByClassName("input")[i].value;
                }
                var object = JSON.stringify(input);
                $.ajax({
                    type : "POST",
                    url : "php/create_category.php",
                    data : {
                        json_data : object
                    },
                    beforeSend : function ()
                    {
                        $(".create_category_loader").removeClass("d-noe");
                    },
                    success : function(response)
                    {
                            $(".create_category_loader").addClass("d-noe");
                            if(response.trim() == "done")
                            {
                                category_list();
                                var notice  = document.createElement("DIV");
                                notice.className = "alert alert-success";
                                notice.innerHTML = "<b>success !</b>";
                                $(".create_category_notice").html(notice);
                                setTimeout(function(){
                                    $(".create_category_notice").html("");
                                    $(".create-category-form").trigger('reset');
                                },3000);
                            }
                            else{
                                var notice  = document.createElement("DIV");
                                notice.className = "alert alert-success";
                                notice.innerHTML = "<b>"+response+"</b>";
                                $(".create_category_notice").html(notice);
                                setTimeout(function(){
                                $(".create_category_notice").html("");
                                    $(".create-category-form").trigger('reset');
                                },3000);
                            }
                       
                    }

                });
            

            });
                        // ================= add brand field ====================
                $(".add-brand-btn").click(function(){
                                                
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
                    if(category == "Choose category")
                    {
                                    var notice  = document.createElement("DIV");
                                    notice.className = "alert alert-success";
                                    notice.innerHTML = "<b>please choose a category</b>";
                                    $(".create-brand-notice").html(notice);
                                    setTimeout(function(){
                                        $(".create-brand-notice").html("");
                                        $(".brand-form").trigger('reset');
                                    },1000);
                    }
                    else {
                            var input = [];
                            var input_length = $(".brand-input").length;
                            
                            var i;
                            for(i=0;i<input_length;i++)
                            {
                                input[i] = document.getElementsByClassName("brand-input")[i].value;
                            }
                            var object = JSON.stringify(input);
                        
                            $.ajax({
                                type : "POST",
                                url : "php/create_brand.php",
                                data : {
                                    json_data : object,
                                    category : category
                                },
                                beforeSend : function ()
                                {
                                    $(".brand-loader").removeClass("d-none");
                                },
                                success : function(response)
                                {
                                        $(".brand-loader").addClass("d-none");
                                        if(response.trim() == "done")
                                        {
                                        
                                            var notice  = document.createElement("DIV");
                                            notice.className = "alert alert-success";
                                            notice.innerHTML = "<b>success !</b>";
                                            $(".create-brand-notice").html(notice);
                                            setTimeout(function(){
                                                $(".create-brand-notice").html("");
                                                $(".brand-form").trigger('reset');
                                            },3000);
                                        }
                                        else{
                                            var notice  = document.createElement("DIV");
                                            notice.className = "alert alert-success";
                                            notice.innerHTML = "<b>"+response+"</b>";
                                            $(".create-brand-notice").html(notice);
                                            setTimeout(function(){
                                            $(".create-brand-notice").html("");
                                                $(".brand-form").trigger('reset');
                                            },10000);
                                        }
                                
                                }
            
                            });
                        }
    
                    });

//======================== display brand =================
                        $(document).ready(function(){
                            $(".display-brand").on("change",function(){
                                var selected_cat_name = $(this).val();
                                $.ajax({
                                    type: "POST",
                                    url: "php/display_brands.php",
                                    data: {
                                        category_name : selected_cat_name
                                    },
                                    beforeSend: function(){
                                        $(".brand-display-loader").removeClass("d-none");
                                    },
                                    success: function(response){
                                        alert(response);
                                        // $(".brand-display-loader").addClass("d-none");
                                        // var table = document.createElement("table");
                                        // table.style.width = "100%";
                                        // table.style.border = "1px solid black";
                                        // var json_data = JSON.parse(response);
                                        // var i;
                                        // for(i=0; i<json_data.length; i++)
                                        // {
                                        //     var tr = document.createElement("TR");
                                        //     var td_category_name = document.createElement("TD");
                                        //     var td_brands = document.createElement("TD");
                                        //     td_category_name.innerHTML = json_data[i].category_name;
                                        //    td_brands.innerHTML = json_data[i].brands;
                                        //     table.append(tr);
                                        //     tr.append(td_category_name);
                                        //     tr.append(td_brands);
                                        //     $(".brand-list-area").html(table);
                                        // }
                                    }
                                });
                            });
                        });
                }

    });
}

//===================== category list request ========================

 $(document).ready(function(){
    category_list();
 });


 function category_list(){
    $.ajax({
    type : "POST",
    url : "php/category.php",
    success : function(response){
       var category_list = JSON.parse(response);
       var i;
       for(i=0;i<category_list.length;i++)
       {
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
           edit_btn.innerHTML = "<i class='fa fa-edit edit-icon'></i><i class='fa fa-save save-icon d-none'></i>";
           edit_btn.className = "btn btn-info";
           div.append(edit_btn);

           var delete_btn = document.createElement("BUTTON");
           delete_btn.innerHTML = "<i class='fa fa-trash delete-icon'></i>";
           delete_btn.className = "btn btn-danger";
           div.append(delete_btn);
           $(".category-area").append(ul);

           // edit category name
           edit_btn.onclick = function() {
               var parent = this.parentElement;
               var id = parent.getElementsByClassName("id")[0];
               var cat_name = parent.getElementsByClassName("name")[0];
               var save_icon = parent.getElementsByClassName("save-icon")[0];
               var edit_icon= parent.getElementsByClassName("edit-icon")[0];
               cat_name.contentEditable = true;
               cat_name.focus();
               $(save_icon).removeClass("d-none");
               $(edit_icon).addClass("d-none");
               $(".save-icon").click(function(){
                   var changed_name = cat_name.innerHTML.trim();
                   $.ajax({
                       type : "POST",
                       url : "php/edit_category_name.php",
                       
                       data : {
                           id : id.innerHTML.trim(),
                           change_name :changed_name
                       },
                       cache : false,
                       success: function(response){
                           if(response.trim() == "success"){
                               cat_name.contentEditable = false;
                               $(save_icon).addClass("d-none");
                               $(edit_icon).removeClass("d-none");
                           }
                           else{
                               alert(response);
                           }
                       }
                   });
               });
           }
 //====================== delete category =============================
           delete_btn.onclick = function(){
               var parent = this.parentElement;
               var id = parent.getElementsByClassName("id")[0].innerHTML.trim();
               $.ajax({
                   type : "POST",
                   url : "php/delete_category_name.php",
                   cache : false,
                   data : {
                       id : id
                   },
                   success : function(response){
                       if(response.trim() == "success")
                       {
                            parent.remove();
                           parent.parentElement.parentElement.parent.remove();
                       }
                       else{
                           alert(response);
                       }
                   }
               });
           }
          
       }
                            
    }
   });
}



