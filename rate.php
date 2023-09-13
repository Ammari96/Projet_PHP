<?php
   if (session_status()!= PHP_SESSION_ACTIVE)
   	session_start();
   include_once 'Functions/MyFunctions.php';
   
   
    if (isset($_POST['comment'])) {
     $reviewcontent = $_POST['comment'];
     $name=$_POST['name'];
     $phone=$_POST['phone'];
     $email=$_POST['email'];
     $comment=$_POST['comment'];
   
   addRate($name ,$phone,$email, $comment);
     
   
   ?>
<html>
   <img style="margin-top: 30px; margin-left: 200px; height: auto; width: 70%;" src="./images/received.png" alt="" srcset="">
   <a style="margin-top: 30px; margin-left: 650px; backgroudncolor: orange"href="./home.php">Return to home page</a>
</html>
<?php
   exit();}
   
   ?>
<?php
   include 'header.php';?>
<br><br>
<link rel="stylesheet" href="./styles/rate.css?c=a">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
   <form method="post" action="./rate.php">
      <div class="row">
         <div class="col-md-7">
            <h4><b>YOUR FEEDBACK / INQUIRIES </b> </h4>
            <div class="mb-3">
               <label for="formGroupExampleInput" class="form-label"><b>Name :</b></label>
               <input type="text" class="form-control" id="formGroupExampleInput"  name="name" placeholder="Enter your name..." >
            </div>
            <div class="mb-3">
               <label for="formGroupExampleInput2" class="form-label"><b>Email :</b></label>
               <input type="email" class="form-control" id="formGroupExampleInput2"  name="email" placeholder="Enter your address mail...">
            </div>
            <div class="mb-3">
               <label for="formGroupExampleInput3" class="form-label"><b>Phone Number :</b></label>
               <input type="text" class="form-control" id="formGroupExampleInput3" name="phone" placeholder="Enter your phone number... ">
            </div>
            <div class="mb-3">
               <label for="exampleFormControlTextarea1" class="form-label"><b>Rate us / Ask for help :</b></label>
               <input class="form-control" id="exampleFormControlTextarea1" name="comment" placeholder="Write your comment here..." rows="3"></input>
            </div>
            <button class="btn btn-primary" id="submit" name="submit">Submit</button>
         </div>
         <div class="col-md-5 ">
            <div class="img">
               <img class="image-1" src="images/logo.png" />
               <img class="image-2" src="images/logo.png" />
               <img class="image-3" src="images/logo.png" />
               <img class="image-4" src="images/logo.png" />
            </div>
         </div>
      </div>
   </form>
</div>
</body>
</html>
<?php
   // Le code PHP que vous souhaitez exécuter avant le rendu de la page
   
   		$searchbox = isset($_GET['search']) ? strtoupper($_GET['search']) : '';
   		$productListStyle = 'none'; // Variable pour définir le style d'affichage de la liste des produits
   		$productItems = []; // Tableau pour stocker les produits
   
   // Le code PHP pour récupérer les produits et les filtrer en fonction de la recherche
   // Assurez-vous de remplir le tableau $productItems avec les produits appropriés en fonction de la recherche
   
   		if (!empty($searchbox)) {
   			foreach ($productItems as $product) {
   				$match = strtoupper($product['name']);
   				if (strpos($match, $searchbox) !== false) {
   					$product['display'] = true;
   				} else {
   					$product['display'] = false;
   				}
   				$productItems[] = $product;
   			}
   		} else {
   			$productItems = $productItems; // Assurez-vous d'obtenir tous les produits sans filtre si la recherche est vide
   		}
   
   		// La variable $productListStyle sera utilisée pour définir l'attribut "style" du conteneur de la liste des produits
   		if (count($productItems) > 0) {
   			$productListStyle = 'block';
   		}
   	?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Les en-têtes du document -->
   </head>
   <body>
      <!-- Le contenu de la page -->
      <?php if (count($productItems) > 0) : ?>
      <form method="get" action="">
         <input style="width:180px; font-size:15px" id="search-input" type="text" name="search" value="<?php echo $searchbox; ?>" placeholder="Search drinks, stores..." >
         <button id="search-btn" type="submit">Search</button>
      </form>
      <div class="product-list" style="display: <?php echo $productListStyle; ?>">
         <?php foreach ($productItems as $product) : ?>
         <?php if ($product['display']) : ?>
         <!-- Afficher les produits filtrés -->
         <?php endif; ?>
         <?php endforeach; ?>
      </div>
      <?php endif; ?>
   </body>
</html>