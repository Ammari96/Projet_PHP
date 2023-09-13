<?php
   // Démarrage d'une nouvelle session et définition des variables pour les frais de livraison, le total, et les produits dans le panier
   session_start();
   include_once 'Functions/MyFunctions.php';
   
   // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
   if (!isset($_SESSION['user_id']))
   {
   	header("location: ./login.php");
   	exit();
   }
   
   // Vérifie si le formulaire a été soumis avec une option sélectionnée
   
   if (isset($_POST['addtocart']))
   {
   if (isset($_POST['option'])) {
     // Récupère l'option du formulaire
     $option = $_POST['option'];
     // Divise l'option en ses composants
     $split_option=explode(";",$option);
     // Récupère l'id de l'option, le nom du produit, le nom de l'option, le prix et l'image à partir de l'option divisée
     $option_id=$split_option[0];
     $product_name=$split_option[1];
     $option_name=$split_option[2];
     $price=$split_option[3];
     $image=$split_option[4];
     // Ajoute l'option sélectionnée au panier dans la session
     $_SESSION['cart'][]=['option_id'=> $option_id,'product_name'=>$product_name,'option_name'=>$option_name,'price'=>$price,'image'=>$image];
   		
     // Redirige vers la page d'accueil avec un message indiquant que tout s'est bien passé
     header("Location: ./home.php?error=none");
     exit();
   }
  
   header("Location: ./home.php?error=none");
     exit();
   }
   
   if (isset($_POST['checkout']))
   {
    if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone'])) {
       $name = $_POST['name'];
       $address = $_POST['address'];
       $phone = $_POST['phone'];
   	$description=create_command($_SESSION['cart'], $_SESSION['user_id'], $name, $address,$phone);	
       //$body=nl2br("Hello dear customer, You have now passed your order. A few minutes and it will be there. And here are your Order details : Name: $name . Phone number: $phone. Order description: $description. Thank you for choosing KYUFI .");
       
   	header("Location: ./home.php?error=orderpassed");
       exit();   
   }
   }
   
   $delivery=4.95;
   $total=0;
   $products = $_SESSION['cart'];
   $nproducts=count($products);
   ?>
<?php if($nproducts == 0): ?>
<!--Si le panier est vide, affichez un message et une image-->
<div style="display: flex; flex-direction: column; align-items: center;">
   <h2 style="color: red; margin-top: 100px">Your cart is currently empty.</h2>
   <img src="./images/empty.png" alt="" style="margin-top: 50px; width: 150px; height: auto;">
   <a href="./home.php"><button class="btn1" style="margin-top: 50px; background-color: rgb(176, 73, 17); color: white; width: 300px; height: 40px;     border-radius: 0.3rem;;font-weight: 500;  ">Add something to cart</button></a>
</div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Checkout</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="" crossorigin="anonymous"/>
      <link rel="stylesheet" href="./styles/commander.css">
      <link rel="stylesheet" href="./styles/home.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
      <link href="@import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,900;1,400;1,500;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100;300;400;500;700&display=swap');" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
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
         <div class="header-icons" style="height: 40px">
            <button id="shopping" style="font-size: 12px">
            <i class="fas fa-shopping-cart" id="cart-btn"></i>
            <span id="cart-count"> <?php echo $nproducts ?> </span>
            </button>
            <button id="search-btn" style="font-size: 14px">
            <i class="fas fa-search"></i>
            </button>
            <input style="width:180px; font-size:15px" id="search-input" onkeyup="search()" type="text" placeholder="Search drinks, stores...">
            <button id="lang">
            <i class="fas fa-globe" style="font-size: 16px"></i>
            </button>
            <a href="<?php if (!(isset($_SESSION['user_id']))) { echo "./login.php"; } else { echo "account.php"; } ?>">
            <button style="font-size: 14px" class="header-btn"><i class="fa-solid fa-user"></i></button>
            </a>
            <?php if ((isset($_SESSION['user_id']))) { ?>
            <a href="./login.php?logout=true">
            <button style="font-size: 14px" class="header-btn"><i class="fa fa-sign-out"></i></button>
            </a>
            <?php } ?>
         </div>
      </header>
      <?php if($nproducts > 0): ?>
      <div class='container'>
      <!-- Si le panier n'est pas vide, affichez les articles dans le panier et proposez une option pour passer la commande-->
      <div class='window'>
         <div class='order-info'>
            <div class='order-info-content'>
               <table>
               <h2><b> Order Summary</b></h2>
               <div class='line'></div>
               <?php 
                  $total=0;
                  foreach($products as $item){
                              $total=$total+$item['price'];
                              echo"
                              <table class='order-table'>
                                  <tbody>
                                  <tr>
                                      <td><img src='"; 
                                      echo $item['image']."' class='full-width'></img>
                                      </td>
                                      <td>
                                          <br> <span class='thin'>";
                                              echo $item['product_name'].
                                                      
                                              
                                      "</td>
                  
                                  </tr>
                                  <tr>
                                      <td>
                                          <div class='price'> ";
                                              
                                              echo "€".$item['price'].
                                              
                                          "</div>
                                
                                      </td>
                                  </tr>
                                  </tbody>
                                  </table>
                                  <div class='line'></div>";
                                  }
                                  $totalfinal=$total+$delivery;
                                  ?>
            </div>
            <div class='total'>
               <span style='float:left;'>
                  <div class='thin dense'><b>Delivery :</b></div>
                  <h6><b>TOTAL  :</b></h6>
               </span>
               <span style='float:right; text-align:right;'>
                  <b>
                     <div class='thin dense' ><?php echo "EURO  ".$delivery ?></div>
                     EURO<span id='total'>
                     <?php  echo $totalfinal ?>
                  </b>
                  </span>
            </div>
            </span>
         </div>
         <div class='credit-info'>
            <form method='POST' action='./commander.php'>
               <input type="hidden" name="checkout" value="true">
               <div class='credit-info-content'>
               
                  <img src='https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png' height='80' class='credit-card-image' id='credit-card-image' />
                  Delivery Name :
                  <input class='input-field' type='text' name='name' required /> 
                  <hr>
                  Delivery Address :
                  <input class='input-field' type='text' name='address' required />
                  <table class='half-input-table'>
                     <hr>
                     <tr>
                        <td>Delivery Phone Number: </td>
                        <td><br><input class='input-field' type='text' name='phone' required /></td>
                     </tr>
					 <button class='pay-btn' type='submit' name='checkoutsubmit' >Place your Order</button>
                  </table>
               </div>
            </form>
         </div>
         <?php endif; ?>
      </div>
   </body>
</html>