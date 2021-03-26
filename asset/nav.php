<div class="container-fluid bg-white shadow-sm">
<nav class="container navbar navbar-expand-sm bg-white">
        <ul class="navbar-nav">
            <?php
                $data = "SELECT category_name from category";
                $response = $db->query($data);
                if($response)
                {
                   while($nav = $response->fetch_assoc())
                   {
                       echo "<li class='nav-item'><a href='#' class='nav-link text-dark text-uppercase'>".$nav['category_name']."</a></li>";
                   }
                }

            ?>
        </ul>
        <div class="btn-group ml-auto">
            <button class="btn border"><i class="fa fa-shopping-bag"></i></button>
            <button class="btn border"><i class="fa fa-search"></i></button>
            <button class="btn border"><i class="fa fa-user"></i></button>
        </div> 
</nav>
</div>