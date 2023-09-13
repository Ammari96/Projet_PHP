<?php
include_once 'header.php';

$con=connect();
// Si le paramètre 'product_id' n'est pas dans l'URL, rediriger vers la page d'accueil

if (!isset($_GET['product_id']))
	header('location:home.php?error=missing_prod_id');

// Sinon, stocker l'ID du produit dans une variable
$product_id=$_GET['product_id'];

// Récupérer les détails du produit à partir de la base de données
$product=getProductDetails($con,$product_id);

// Si le produit n'est pas trouvé, rediriger vers la page d'accueil
if ($product==null)
	header('location:home.php?error=product_not_found');
 ?>

    <main class="container2">

        <div class="left-column">
          <img style="width=600px;height:auto;"   src="<?php echo $product['product_image'];?>" alt="">
        </div>
  
  
        <!-- Right Column -->
        <div class="right-column">
  
          <!-- Product Description -->
          <div class="product-description">
            <span><?php echo $product['product_name'];?></span>
            <h1><?php echo $product['product_name'];?></h1>
            <p>
			<?php echo $product['product_description'];?>
			</p>
          </div>
    <form action="commander.php" method="post" >
	<input type="hidden" name ="addtocart" value="true">

  <?php
  if (count($product['options'])>1){
  ?>

          <div class="product-configuration">
            <div class="Coffee-config">
              <span>Choose Your Preferred option :</span>
              <div class="Coffee-choose">
                <div class="btn-group" style="width:100%">
				<ol>
				<?php
				$p=count($product['options'])+1;
				$p=100/$p;
				$first=true;
				foreach($product['options'] as $option)
				{
					if ($first)
					{
						$checked="checked";
						$first=false;
					}
					else $checked="";
					$option_name=$option['name'];
					$id=$option['id'];
					$price=$option['price'];
					$product_name=$product['product_name'];
					$product_image=$product['product_image'];
					$value="$id;$product_name;$option_name;$price;$product_image";
					echo "<li><input type='radio' style='margin:10px;' name='option' value='$value' $checked>$option_name ($price Eur)</li>";
				}
				?>
				</ol>
                 </div>
  
              <a href="#">Contact Us For More Info</a>
            </div>
          </div>
  <?php
  }else{
         echo ' <div class="product-price">';			
				$option=$product['options'][0];
				$option_name=$option['name'];
					$id=$option['id'];
					$price=$option['price'];
					$product_name=$product['product_name'];
					$product_image=$product['product_image'];
					$value="$id;$product_name;$option_name;$price;$product_image";
				echo "<span>".$price." Eur</span>";

				 echo '<input type="hidden" name="option" value="'.$value.'">';
  }?>           
            <input type="submit" class="cart-btn" value="Add to cart">
			</form>
          </div>
        </div>


      </main>
  
      <!-- Scripts -->
    


</body>
</html>