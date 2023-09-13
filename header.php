<?php
   if (session_status()!= PHP_SESSION_ACTIVE)
   	session_start();
   
   require_once 'Functions/MyFunctions.php';
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Coffee Shop</title>
      <link rel="stylesheet" href="./styles/home.css">
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,900;1,400;1,500;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
   </head>
   <body>
      <header>
         <a href="./home.php#about" class="logo">
         <img src="images/logo.png" alt="">
         </a>
         <i class="fas fa-bars" id="menu-icon"></i>
         <ul class="navbar">
            <li id="home"><a href="./home.php">Home</a></li>
            <li><a href="./home.php#products">Products</a></li>
            <li id="reviews"><a href="./home.php#customers">Reviews</a></li>
            <li id="join"><a href="./findjoinabout.php?page=joinus">JOIN US</a></li>
            <li id="abouticon"><a href="./home.php#about">About</a></li>
         </ul>
         <div class="header-icons">
            <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="commander.php" id="shopping">
            <i class="fas fa-shopping-cart" id="cart-btn"></i>
            <span id="cart-count" style="font-size: 20px;"><?php echo total_cart($_SESSION['cart']); ?> Euro</span>
            </a>
            <?php }?>
            <form method="post" action="home.php#products">
               <input type="submit" name="search" value="search" class="search">
               <input type="text" placeholder="Search drinks, stores..." name="criteria">
            </form>
            <div>
               <a href="./traduction.php" id="lang">
               <button style="padding: 5px;"><i class="fas fa-globe" style="font-size: 20px; margin: 5px;"></i></button>
               </a>
            </div>
            <a href="<?php if (!isset($_SESSION['user_id'])) { echo "./login.php"; } else { echo "./account.php"; } ?>"><button class="header-btn" style="text-decoration: none;"><i class="fa-solid fa-user"></i></button></a>
            <?php if (isset($_SESSION['user_uid']) && isset($_SESSION['user_id'])) { ?>
            <a href="./login.php?logout=true"><button class="header-btn"><i class="fa fa-sign-out"></i></button></a>
            <?php } ?>
         </div>
      </header>
   </body>
</html>
