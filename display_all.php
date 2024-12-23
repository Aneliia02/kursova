<?php 
require_once('includes/connect.php');
require_once('functions/common_function.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Store</title>
    <!-- Bootstrap 5.3 CSS JS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <!-- font awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<!-- navbar -->
 <div class="container-fluid p-0">
 <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
   <i class="fa-brands fa-opencart fa-2xl"></i>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"> <i class="fa-solid fa-cart-shopping"></i> <sup><?php cart_items();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_cart_price();?></a>
        </li>
      </ul>
      <form class="d-flex" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
       <!--<button class="btn btn-outline-light" type="submit">Search</button>-->
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>
<!-- calling cart function-->
<?php cart(); ?>
<!-- -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
    <?php if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
        }
        else {
          echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a></li>";
        }

        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
        }
        else {
          echo "<li class='nav-item'><a class='nav-link' href='./users_area/logout.php'>Logout</a></li>";
        }
        ?>
    </ul>
</nav>
<!-- -->
<div class="bg-light">
    <h3 class="text-center">Hidden Store</h3>
    <p class="text-center">Communications is at the heart of e-commerce and community</p>
</div>

<!-- -->

<div class="row px-1">
    <div class="col-md-10">
        <!-- products -->
        <div class="row">
        <?php
        get_all_products();
        get_unique_categories();
        get_unique_brands();
        getIPAddress();
        //$ip = getIPAddress();  
        //echo 'User Real IP Address - '.$ip; 
  ?>
           
        <!--row end --> 
         </div>
        <!--col end -->
        </div>
           
        
            
      <div class="col-md-2 bg-secondary p-0" >
        <!-- brands sidenav -->
        <ul class="navbar-nav me-auto text-center">
           <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
           </li> 
                <?php
                getbrands();
                
                ?>
           
        </ul>


        <!-- categories sidenav -->
        <ul class="navbar-nav me-auto text-center">
           <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
           </li> 
           <?php
                getcategories();
                
                ?>
        </ul>
    </div>

</div>


<!--footer-->
 
<div class="bg-info p-3 text-center">
<p>© 2024 All rights reserved</p>
</div> 

 </div>
</body>
</html>