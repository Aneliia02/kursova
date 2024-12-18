<?php 
require_once('includes/connect.php');
require_once('functions/common_function.php');


?>
<style>
    .cart_image{
        width: 80px;
        height: 80px;
        object-fit: contain;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Store - Cart Details</title>
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
          <a class="nav-link" href="cart.php"> <i class="fa-solid fa-cart-shopping"></i> <sup> <?php cart_items();?></sup></a>
        </li>
       
      </ul>
     
    </div>
  </div>
</nav>
<!-- calling cart function-->
<?php cart(); ?>
<!-- -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
        </li> -->
        
        <!-- <li class="nav-item">
          <a class="nav-link" href="./users_area/user_login.php">Login</a>
        </li> -->
        <?php
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
        }
        else {
          echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a></li>";
        }

       
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='./users_area/user_login.php'>Login</a>
            </li>";
        }
        else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='./users_area/logout.php'>Logout</a>
            </li>";
        }
        ?>
    </ul>
</nav>
<!-- -->
<div class="bg-light">
    <h3 class="text-center">Hidden Store</h3>
    <p class="text-center">Communications is at the heart of e-commerce and community</p>
</div>

<!-- table -->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th colspan="2">Operations</th>
                </tr>
            </thead>
            <tbody>
                <!-- php -->
                 <?php
                 //global $con;  
                 $ip=getIPAddress();
                 $total_price=0;
                 $cart_query="Select * from `cart_detials` where ip_address='$ip'";
                 $result_query=mysqli_query($con,$cart_query);
                 $result_count=mysqli_num_rows($result_query);
                 if($result_count>0){
                 while($row=mysqli_fetch_array($result_query)){
                   $product_id=$row['product_id'];
                   $product_query="Select * from `products` where product_id='$product_id'";
                   $result_product_query=mysqli_query($con,$product_query);
                   while($row_product_price=mysqli_fetch_array($result_product_query)){
                     $product_price=array($row_product_price['product_price']);
                     $price_table=$row_product_price['product_price'];
                     $product_title=$row_product_price['product_title'];
                     $product_image1=$row_product_price['product_image1'];
                     $product_values=array_sum($product_price);
                     $total_price+=$product_values;
                     
                 ?>
                <tr>
                    <td><?php echo $product_title;?></td>
                    <td><img src="./images/<?php echo $product_image1;?>" alt="" class="cart_image"></td>
                    <td> <input type="text" name="qty" class="form-input w-50"></td>
                    <?php
                    $ip=getIPAddress();
                    if(isset($_POST['update_cart'])){
                        $quantity=$_POST['qty'];
                        $update_cart= "update `cart_detials` set quantity='$quantity' where ip_address='$ip'";
                        $result_product_query=mysqli_query($con,$update_cart);
                        $total_price=$total_price*$quantity;
                    }

                    ?>
                    <td><?php echo $price_table;?>/-</td>
                    <td><input type="checkbox"></td>
                    <td>
<!--                        <button class="bg-info p-3 px-3 py-2 border-0 mx-3">Update</button>
 -->                        <input type="submit" value="Update Card" class="bg-info p-3 px-3 py-2 border-0 mx-3" name="update_cart">
                            <button class="bg-info p-3 px-3 py-2 border-0 mx-3">Remove</button>
                    </td>
                </tr>
                <?php 
                    } } } 
                    else{
                      echo "<h2 class='text-center text-danger'>Your Cart is Empty</h2>";
                  }
                ?>
            </tbody>
        </table>
        <!-- subtotal -->
         <div class="d flex md-5">
            <h4 classs="ph-3">Subtotal: <strong class="text-info "><?php echo $total_price;?>/-</strong>
            </h4>
            <button class="bg-info p-3 px-3 py-2 border-0 mx-3"><a href="./index.php" class='text-light text-decoration-none'>Continue Shopping</a></button>
            <button class='bg-secondary p-3 py-2 border-0'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>                  
         </div>
    </div>
</div>
</form>

<!-- end table -->
<!--footer-->
 
<div class="bg-info p-3 text-center">
<p>© 2024 All rights reserved</p>
</div> 

 </div>
</body>
</html> 