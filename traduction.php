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
         <a href="./traduction.php#about" class="logo">
         <img src="images/logo.png" alt="">
         </a>
         <i class="fas fa-bars" id="menu-icon"></i>
         <ul class="navbar">
            <li id="home"><a href="./traduction.php">Accueil</a></li>
            <li><a href="./traduction.php#products">Produits</a></li>
            <li id="reviews"><a href="./traduction.php#customers">Avis</a></li>
            <li id="join"><a href="./findjoinabout.php?page=joinus">Rejoignez-nous</a></li>
            <li id="abouticon"><a href="./traduction.php#about">A propos</a></li>
         </ul>
         <div class="header-icons">
            <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="commander.php" id="shopping">
            <i class="fas fa-shopping-cart" id="cart-btn"></i>
            <span id="cart-count" style="font-size: 20px;"><?php echo total_cart($_SESSION['cart']); ?> Euro</span>
            </a>
            <?php }?>
            <form method="post" action="traduction.php#products">
               <input type="submit" name="search" value="search" class="search">
               <input type="text" placeholder="Search drinks, stores..." name="criteria">
            </form>
            <div>
               <a href="./home.php" id="lang">
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

<?php
    
   
   if (isset($_POST['search']))
   $products=findProductsCriteria($_POST['criteria']);
   else $products=findAllProducts();
   
   
   if (isset($_GET['upto']))
   	$upto=$_GET['upto'];
   else $upto=9;
   
   ?>
<html>
   <body>
      <section class="home" id="home">
         <div class="home-text">
            <h1>Commencez <br> votre journée <br> avec un <br> café</h1>
            <br>
            <p> <b> La bonne humeur d'aujourd'hui est sponsorisée par notre café.</b></p>
            <br>
            <a href="traduction.php#products" class="btn" id="fbtn">Achetez maintenant</a>
            <a href="./findjoinabout.php?page=findus" class="btn">Magasin le plus proche</a>
         </div>
         <?php
            ?>
         <div class="product-list">
            <?php 
               $c=0;
               foreach($products as $product){
               $c++;
               if ($c>8) break;
               ?>
            <div class="product">
               <a href="" class="product-link">
                  <img src="<?php echo $product['product_image'];?>" alt="" class="product-image">
                  <div class="product-details">
                     <p class="product-name"><b><?php echo $product['product_name'];?></b></p>
                  </div>
               </a>
            </div>
            <hr style="color: aliceblue;">
            <?php 
               }
               ?>
         </div>
      </section>
      <section>
         <div>
            <img src="images/img.png" alt="">
         </div>
      </section>
      <section class="products" id="products">
         <div class="heading">
            <h2>Nos produits</h2>
         </div>
         <div class="products-container">
            <?php 
               $c=0;
               foreach($products as $product){
               $c++;
               if ($c>$upto) break;
               ?>
            <div class="box">
               <a href="product_details?product_id=<?php echo $product['product_id'];?>">
                  <img src="<?php echo $product['product_image'];?>" alt="">
                  <h3><?php echo $product['product_name'];?></h3>
               </a>
               <div class="content">
                  <span>
                  <?php 
                     if (isset($product['options'][0]['price'])) {
                     	echo $product['options'][0]['price'];
                     } else {
                     	echo 'Prix non disponible';
                     }
                     ?> 
                  €</span>
                  <!--<a class="add-to-cart" href="">Add to cart</a>-->
               </div>
            </div>
            
            <?php
               }
               ?>		
           
         </div>
         <?php 
               if ($upto<count($products))
               {
               ?>
            <div class="rateus">
            <button class="center-button">
               <?php
                  $upto+=9;
                  ?>
               <a href="<?php echo "./traduction.php?upto=$upto ";?>">Voir plus de produits</a>
               </button>
            </div>
            <?php
               }
               ?>
      </section>
      <section class="customers" id="customers">
         <div class="heading">
            <h2>Les avis de nos clients:</h2>
         </div>
         <div class="customers-container">
            <div class="box">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>Je fréquente ce magasin régulièrement depuis des années. La dernière année a été presque quotidienne. C'est un magasin très fréquenté mais ils nous font passer rapidement. Il semble que tous les employés s'entendent bien et font leur travail efficacement et avec curiosité. Continuez comme ça "KYUFI".</p>
               <h2>Andreas Christensen</h2>
               <img src="images/rev4.jpg" alt="">
            </div>
            <div class="box">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half"></i>
               </div>
               <p>Un endroit où être. L'espace que j'ai choisi était "KYUFI". Jamais de ma vie je n'aurais imaginé que je serais intéressé à écrire un papier à ce sujet. Je voyage actuellement et c'est un endroit que je visite fréquemment pour m'asseoir et m'occuper de mes études.</p>
               <h2>Riadh Ibrahim</h2>
               <img src="images/rev1.jpg" alt="">
            </div>
            <div id="rev3" class="box">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>J'avais acheté une boisson sur mon application dans un aéroport. Je suis allé la chercher et ils m'ont dit qu'ils ne pouvaient pas préparer ma boisson parce que le mixeur était en panne et qu'ils ne pouvaient pas me rembourser. Ils ont dit qu'il y avait un numéro de téléphone sur l'application et que le numéro de téléphone menait au magasin.</p>
               <h2>Emna Miraoui</h2>
               <img src="images/emna.jpg" alt="">
            </div>
            <div id="rev4" class="box">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>Le KYUFI sur Marseille, France offre le meilleur service client qui soit. Je passe là-bas un jour sur deux avant midi pour prendre un café ou un sandwich et la personne à la fenêtre est un vrai plaisir à traiter, tout comme tous les autres employés. Ils ont toujours une excellente attitude.</p>
               <h2>Marlin Dior</h2>
               <img src="images/rev3.jpg" alt="">
            </div>
         </div>
         <div class="rateus">
            <button><a href="./rate.php">Ecrivez nous </a></button>
         </div>
      </section>
      <section class="about" id="about">
         <div class="about-img">
            <img src="images/footer-bg.jpg" alt="">
         </div>
         <div class="about-text">
            <h2>Notre histoire :</h2>
			<p>Notre aventure a commencé en puisant notre inspiration dans la riche tradition des cafés, comme celui qui a débuté en 1971 sur les rues pavées du historique Pike Place Market de Seattle. Nous avons embrassé ce concept et voulions apporter notre propre offre unique. C'est ainsi que nous avons décidé d'établir nos points de vente à Marseille et à Paris. Notre objectif est de fournir des produits frais, combinés à l'authenticité du café arabe fait maison. Avec nous, chaque tasse de café est une invitation à voyager et à découvrir les saveurs du monde, tout en profitant de l'atmosphère chaleureuse et accueillante de nos boutiques</p>            
			<h2>Coffee & Craft :</h2>
			<p>Passez les portes de notre café et laissez-vous captiver par l'arôme envoûtant de notre café arabe fait maison dès la première gorgée. Ayant pénétré dans l'industrie du café en 2023, un chemin différent pavé d'innovation et de tradition nous a amené à redécouvrir l'art du café. Inspirés par la richesse des traditions caféières du monde entier, nous avons créé notre propre identité à Marseille et à Paris, offrant à nos clients des produits frais de haute qualité et une expérience café inoubliable</p>            <a href="./findjoinabout.php?page=aboutus" class="btn">Learn More</a>
         </div>
      </section>
      <section class="footer">
         <div class="footer-box">
            <h2>Réseaux Sociaux</h2>
            <p>Vous pouvez nous trouver ici :</p>
            <div class="social">
               <a href="https://www.facebook.com/checkpoint/1501092823525282/?next=https%3A%2F%2Fwww.facebook.com%2F&__req=b"><i class="fab fa-facebook-f"></i></a>
               <a href="https://www.instagram.com/kyufi614/"><i class="fa-brands fa-instagram"></i></a>
               <a href="#"><i class="fa-brands fa-twitter"></i></a>
               <a href="https://www.tiktok.com/fr/"><i class="fa-brands fa-tiktok"></i></a>
            </div>
         </div>
         <div class="footer-box">
            <h3>Aide :</h3>
            <li><a href="traduction.php#products">Produits</a></li>
            <li><a href="./rate.php">Aide & Support</a></li>
            <li><a href="">Politique de retour</a></li>
            <li><a href="">Conditions d'utilisation</a></li>
         </div>
         <div class="footer-box">
            <h3>Voir les guides :</h3>
            <li><a href="">Features</a></li>
            <li><a id="" href="./joinus.php">Carrières</a></li>
            <li><a href="traduction.php#customers">Les postes</a></li>
            <li><a href="./findus.php">Lieux</a></li>
         </div>
         <div class="footer-box">
            <h3>Contactez-nous:</h3>
            <div class="contact">
               <span><i class="fas fa-map-marker-alt"></i> Le Perreux sur Marne, 94710</span>
               <span><i class="fas fa-phone"></i>+33603644188 </span>
               <span><i class="fas fa-envelope"></i> kyufi614@gmail.com</span>
            </div>
         </div>
      </section>
      <div class="copyright">
         <p>© RT2 G3 Tous droits réservés 2023</p>
      </div>
   </body>
</html>