<?php
   include_once 'header.php';
   if (isset($_POST['search']))
   $products=findProductsCriteria($_POST['criteria']);
   else $products=findAllProducts();
   
   
   if (isset($_GET['upto']))
   	$upto=$_GET['upto'];
   else $upto=9;
   if (isset($_GET['error']))
   {
	  if ($_GET['error']=='orderpassed')
		echo "<script>alert('Order created successfully !')</script>";
   }
   
   ?>
   
<html>
   <body>
      <section class="home" id="home">
         <div class="home-text">
            <h1>Start <br> your day <br> with a <br> coffee</h1>
            <br>
            <p> <b> Today's good mood is sponsored by our coffee.</b></p>
            <br>
            <a href="home.php#products" class="btn" id="fbtn">Shop now</a>
            <a href="./findjoinabout.php?page=findus" class="btn">Find nearest store</a>
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
            <h2>Our products</h2>
            </div>
            <div class="products-container">
               <?php 
                  $c=0;
                  foreach($products as $product){
                  $c++;
                  if ($c>$upto) break;
                  ?>
               <div class="box">
                  <a href="product_details.php?product_id=<?php echo $product['product_id'];?>">
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
         <br>
         <?php 
               if ($upto<count($products))
               {
               ?>
           <div class="rateus">
  <button class="center-button">
    <?php
      $upto += 9;
    ?>
    <a href="<?php echo "./home.php?upto=$upto#products ";?>">View More Products</a>
  </button>
</div>

            <?php
               }
               ?>
      </section>
      <section class="customers" id="customers">
         <div class="heading">
            <h2>Our customer's review :</h2>
         </div>
         <div class="customers-container">
            <div class="box">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>I have been going to this store regularly for years. The last year has been almost daily. It is a very busy store but they move us through quickly. It seems like the employees all get along and do their jobs efficiently and curiously. Keep going "KYUFI".</p>
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
               <p>A Place to Be. The space I chose was "KYUFI". Never in my life would I have imagined that I would be interested in writing a paper about this. I am currently traveling and it has been a place that I have been frequently visiting to sit down and take care of my studies.</p>
               <h2>Riadh Ibrahim</h2>
               <img src="images/rev1.jpg" alt="">
            </div>
            <div id="rev3" class="box">
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <p>I had purchased a drink on my app at an airport. I went to pick it up and they said they could not make my drink because the blender was broken down and could not refund my money. They said there's a phone number on the app and the phone number goes to the store.</p>
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
               <p>KYUFI in Marseille, France offers the best customer service imaginable. I stop by there every other day before noon to grab a coffee or a sandwich, and the person at the window is an absolute delight to interact with, just like all the other employees. They always have an excellent attitude.</p>
               <h2>Marlin Dior</h2>
               <img src="images/rev3.jpg" alt="">
            </div>
         </div>
         <div class="rateus">
            <button><a href="./rate.php">Rate Us</a></button>
         </div>
      </section>
      <section class="about" id="about">
         <div class="about-img">
            <img src="images/footer-bg.jpg" alt="">
         </div>
         <div class="about-text">
            <h2>Our history :</h2>
            <p>Our story begins in 1971 along the cobblestone streets of Seattle's historic Pike Place Market. It was here where Starbucks opened its first store, offering fresh-roasted coffee beans, tea and spices from around the world for our customers to take home. Ten years later, a young New Yorker named Howard Schultz would walk through these doors and become captivated with Starbucks coffee from his first sip. After joining the company in 1982, a different cobblestone road would lead him to another discovery.</p>
            <h2>Coffee & Craft :</h2>
            <p>It takes many hands to craft the perfect cup of coffee - from the farmers who tend to the red-ripe coffee cherries, to the master roasters who coax the best from every bean, and to the barista who serves it with care. We are committed to the highest standards of quality and service, embracing our heritage while innovating to create new experiences to savor.</p>
            <a href="./findjoinabout.php?page=aboutus" class="btn">Learn More</a>
         </div>
      </section>
      <section class="footer">
         <div class="footer-box">
            <h2>Social Media :</h2>
            <p>You can find us here :</p>
            <div class="social">
               <a href="https://www.facebook.com/checkpoint/1501092823525282/?next=https%3A%2F%2Fwww.facebook.com%2F&__req=b"><i class="fab fa-facebook-f"></i></a>
               <a href="https://www.instagram.com/kyufi614/"><i class="fa-brands fa-instagram"></i></a>
               <a href="#"><i class="fa-brands fa-twitter"></i></a>
               <a href="https://www.tiktok.com/fr/"><i class="fa-brands fa-tiktok"></i></a>
            </div>
         </div>
         <div class="footer-box">
            <h3>Support :</h3>
            <li><a href="home.php#products">Products</a></li>
            <li><a href="./rate.php">Help & Support</a></li>
            <li><a href="findjoinabout.php?page=returnpolicy">Return Policy</a></li>
            <li><a href="">Terms of use</a></li>
         </div>
         <div class="footer-box">
            <h3>View Guides :</h3>
            <li><a href="">Features</a></li>
            <li><a id="" href="findjoinabout.php?page=joinus">Careers</a></li>
            <li><a href="home.php#customers">Blog Posts</a></li>
            <li><a href="findjoinabout.php?page=findus">Our Branches</a></li>
         </div>
         <div class="footer-box">
            <h3>Contact Us :</h3>
            <div class="contact">
               <span><i class="fas fa-map-marker-alt"></i> Le Perreux sur Marne, 94710</span>
               <span><i class="fas fa-phone"></i>+33603644188 </span>
               <span><i class="fas fa-envelope"></i> kyufi614@gmail.com</span>
            </div>
         </div>
      </section>
      <div class="copyright">
         <p> RT2 G3 All Rights Reserved 2023</p>
      </div>
   </body>
</html>