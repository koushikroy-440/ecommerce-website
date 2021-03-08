<?php
    echo '<div class="row animated animate__fadeInDown">
    <div class="col-md-4 py-2 bg-white  rounded-lg shadow-sm">
        <h5 class="my-3">CREATE CATEGORY
        <i class="fa fa-circle-o-notch close fa-spin d-none create_category_loader" aria-hidden="true" style="font-size:18px"></i>
        </h5>
        <form class="create-category-form">

            <input type="text" class="input form-control mb-3" placeholder="Mobile" style="border:none;background-color:#f9f9f;" required="required">
            <div class="add-field-area mb-3"></div>
            <button type="button" class="btn btn-primary mb-3 add-field-btn">
            <i class="fa fa-plus"></i>
            Add field
            </button>
            <button type="submit" class="btn btn-danger mb-3 create-btn">
            <i class="fa fa-plus"></i>
            Create
            </button>
            <div class="create_category_notice my-2">
            
            </div>
        </form>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-6 py-2 bg-white rounded-lg shadow-sm">
        <h5>CATEGORY LIST</h5>
        <hr>
        <div class="category-area overflow-auto" style="height:300px;">
        
        </div>
    </div>
</div>
';

?>