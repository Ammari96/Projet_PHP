<?php
   include_once 'header.php';
   
   $page="findus";
   if (isset($_REQUEST['page']))
   	$page=$_REQUEST['page'];
   ?>
<?php 
   if ($page=="addemployee")
   {		
   	$Username = htmlentities($_POST['Username']);
   	$Pass = htmlentities($_POST['Pass']);
   	$Phonenumber = htmlentities($_POST['Phonenumber']);
   	$Age = htmlentities($_POST['Age']);
   	$position = htmlentities($_POST['position']);
   	$email = htmlentities($_POST['email']);
   	$gender = htmlentities($_POST['gender']);
   	addEmployee($Username,$Pass,$Phonenumber,$Age,$email,  $gender, $position);
   	?>
<img style="margin-top: 30px; margin-left: 200px; height: auto; width: 70%;" src="./images/received.png" alt="" srcset="">
<a style="margin-top: 30px; margin-left: 650px; background-color: orange" href="./home.php">Retour à la page d'accueil</a>
<?php
   }		
   
   
   if ($page=="findus")
   {
   	?>
<div id="map"></div>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src="map.js"></script>
<?php }
   if ($page=="joinus")
   { ?>
<link rel="stylesheet" href="./styles/joinus.css">
<!--Les variables suivantes sont utilisées pour stocker les erreurs de saisie des utilisateurs et leurs entrées-->
<?php $passwordErr=$nameErr = $emailErr = $genderErr = $phonenumberErr= $ageErr=""; $firstname = $email = $gender =$password= $phonenumber=$age= "";
   // Cette fonction prend en entrée une chaîne de caractères, la nettoie des espaces inutiles, échappe les caractères spéciaux et convertit les caractères spéciaux en entités HTML
   
   function test_input($data) {
   	$data = trim($data);
   	$data = stripslashes($data);
   	$data = htmlspecialchars($data);
   	return $data;
   }
   // Ce bloc vérifie si la méthode de la requête est POST.
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   if (empty($_POST["name"])) {
   	$nameErr = "Name is required";
   } else {
   	$firstname = test_input($_POST["name"]);
// vérifie si le nom contient uniquement des lettres et des espaces blancs
   	if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
   	$nameErr = "Only letters and white space allowed";
   	}
   }
   
   	
   // Si la méthode de requête du serveur est POST

   	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Vérifie si le champ "phonenumber" est vide

   	if (empty($_POST["phonenumber"])) {
		
		// Si oui, une erreur est assignée indiquant que le numéro de
   		$phonenumberErr = "Phone Number is required";
   	} else {
   		$phonenumber = test_input($_POST["phonenumber"]);
	
   	if (!preg_match("/^[0-9]+$/",$phonenumber)) {
   		$phonenumberErr = "Only numbers are allowed";
   	}
   	}
   		}
   	if ($_SERVER["REQUEST_METHOD"] == "POST") {
   		if (empty($_POST["age"])) {
   		$ageErr = "Age is required";
   		} else {
   		$age = test_input($_POST["age"]);
	// vérifie si le nom ne contient que des chiffres
   		if (!preg_match("/^[0-9]+$/",$age)) {
   		$ageErr = "Only numbers are allowed";
   		}
   		}
   		}
   
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["Pass"])) {
   	$passwordErr = "password is required";
   } else {
   	$password = test_input($_POST["loginPassword"]);
	// vérifie si le mot de passe contient plus de 8 caractères
   	if (strlen ($password < 8)) {
   	$passwordErr = "Password must contain at least 8 characters";
   	}
   	}
   	}
   
   if (empty($_POST["email"])) {
   	$emailErr = "Email is required";
   } else {
   	$email = test_input($_POST["email"]);
	// vérifie si l'adresse e-mail est bien formatée
   	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   	$emailErr = "Invalid email format";
   	}
   }
   
   
   if (empty($_POST["gender"])) {
   	$genderErr = "Gender is required";
   } else {
   	$gender = test_input($_POST["gender"]);
   }
   
   }
   
   // Cette partie du code est exécutée lorsque l'utilisateur soumet le formulaire avec un fichier à télécharger.
   
   
   if (isset($_POST['submit'])) {
   $target_dir = "uploads/"; // The directory where the uploaded file will be stored
   $target_name= $_FILES['fileToUpload']['name'];
   $target_file = $target_dir . $target_name;
   // Enregistre temporairement le fichier téléchargé
   
   $file_tmp = $_FILES['fileToUpload']['tmp_name'];
   
   // Initialise une variable $uploadOk à 1, indiquant que le fichier peut être téléchargé
   
   $uploadOk = 1;
   // Détermine le type de fichier
   $FileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
   // // Vérifie si le type de fichier est PDF. Si ce n'est pas le cas, affiche un message d'erreur et définit $uploadOk à 0 
   if($FileType != "pdf" ){
   	echo "Sorry, only PDF files are allowed.";
   	$uploadOk = 0;
   }
   else {
   	move_uploaded_file($file_tmp, $target_file);
   	$uploadOk=1;
   }
   
   // Vérifie si la taille du fichier dépasse la limite. Si c'est le cas, affiche un message d'erreur et définit $uploadOk à 0
   
   if ($_FILES["fileToUpload"]["size"] > 5000000) {
   echo "Sorry, your file is too large.";
   $uploadOk = 0;
   }}
   
   ?>
<div class="login">
   <h1 class="animate__animated animate__bounce" >Join us</h1>
   <form method="post" action="findjoinabout.php?page=addemployee" enctype="multipart/form-data">
      <p><span class="error">* Required Field</span></p>
      <label class="form-label"> <b> * Username  : </b></label> <br>
      <input class="form-control" type="text" name="Username" id="Username"  required >
      <span class="error"><?php echo $nameErr;?></span>
      <br>
      <label class="form-label"> <b> * Password : </b></label> <br>
      <input class="form-control" type="password" name="Pass" id="loginPassword"  required >
      <br>
      <span class="error"> <?php echo $passwordErr;?></span> 
      <label class="form-label"> <b> * Phone number </b></label> <br>
      <input class="form-control" type="text" name="Phonenumber" id="Phonenumber" required >
      <span class="error"><?php echo $phonenumberErr;?></span>
      <br>
      <label class="form-label"> <b> Age : </b></label>  <br>
      <input class="form-control" type="text" name="Age" id="Age"  >
      <span class="error"> <?php echo $ageErr ?> </span>
      <br>
      <label class="form-label"> <b> * Email :  </b></label> <br>
      <input class="form-control" type="text" name="email" id="email" required >
      <span class="error"> <?php echo $emailErr;?></span>
      <br>
      <label class="form-label"><b> * Gender : </b> </label> <br>
      <input type="radio" name="gender" required id ="gender"
         <?php if (isset($gender) && $gender=="female") echo "checked";?>
         value="female"> Female 
      <input type="radio" name="gender"
         <?php if (isset($gender) && $gender=="male") echo "checked";?>
         value="male"> Male
      <span class="error"> <?php echo $genderErr;?></span>
      <br>
      <label class="form-label"> <b>* Position : </b></label> <br>
      <select id="positions"  name="position" id="position" required>
         <option value="Delivery">Delivery</option>
         <option value="Coffee">Coffee brewer</option>
         <option value="Waiter">Waiter</option>
         <option value="Cleaning">Cleaning staff</option>
      </select>
      <br> 
      <label class="form-label"><b>* Your CV:</b> </label> <br>
      <input type="file" name="fileToUpload" id="fileToUpload" accept="application/pdf" class="small-button">
      <br>
      <input type="submit" name="envoi" value="Submit" >
   </form>
   <br>
</div>
<?php }
   if ($page=="aboutus")
   { ?>
<link rel="stylesheet" href="./styles/About-us.css?a=a">
<br><br><br>
<section>
   <div class ="aa">
      <div class = "image">
         <img class="image-1" src="./images/logo.png" />
         <img class="image-2" src="./images/logo.png" />
         <img class="image-3" src="./images/logo.png" />
         <img class="image-4" src="./images/logo.png" />
      </div>
   </div>
   <div class = "content">
      <br>
      <h2>About Us</h2>
      <span></span>
      <p>So here it is 'KYUFI – كيوفي'. So bright, even the darkest roasts are neon. THE freshest. THE richest. THE mellowest. THE best Coffee you’ll put in your mouth, ever. It’s like the cherry on the cake of coffee. Oh yeah ! we sell cake too .</p>
      <ul class = "links">
         <li><a href = "home.php#products">Drinks</a></li>
         <div class = "vertical-line"></div>
         <li><a href = "home.php#products">Cakes and Cookies</a></li>
         <div class = "vertical-line"></div>
         <li><a href = "rate.php">Rate Us</a></li>
      </ul>
      <ul class = "icons">
         <li>
            <a href="https://www.facebook.com/checkpoint/1501092823525282/?next=https%3A%2F%2Fwww.facebook.com%2F&__req=b"><i class="fab fa-facebook-f"></i></a>
         </li>
         <li>
            <a href="https://www.instagram.com/kyufi614/"><i class="fa-brands fa-instagram"></i></a>
         </li>
         <li>
            <a href="https://www.tiktok.com/fr/"><i class="fa-brands fa-tiktok"></i></a>
         </li>
      </ul>
   </div>
</section>
<?php }

if ($page=="returnpolicy")
{ ?>

  <style>
    .content {
      font-family: Arial, sans-serif;
      line-height: 1.5;
      margin: 50px;
	  margin-top:100px;
    }

    p {
      margin-bottom: 10px;
    }
	h1 {
		margin:auto;
		width : 30%;
		border-bottom: 2px solid black;
		text-align: center;
		margin-bottom: 50px;
	}
  </style>
<div class="content">
  <h1> Policy</h1><br>
  <p>At <strong>Kyufi</strong>, we strive to provide you with the finest quality coffee and exceptional customer service. We want you to be completely satisfied with your purchase, and we understand that there may be instances where you may need to return or exchange a product. To ensure a smooth and hassle-free experience, we have implemented the following return policy:</p>

  <ol>
    <li>
      <strong>Returns and Exchanges:</strong> We accept returns and exchanges within 14 days of the original purchase date. The item(s) must be unused, in their original packaging, and accompanied by the original receipt or proof of purchase.
    </li>
    <li>
      <strong>Eligible Items:</strong> Eligible items for return or exchange include unopened bags of coffee beans, coffee equipment, and merchandise such as mugs, tumblers, and brewing accessories. For health and safety reasons, we are unable to accept returns or exchanges on opened food or beverage items.
    </li>
    <li>
      <strong>Refunds:</strong> If you are returning an eligible item, you may choose to receive a refund in the original form of payment or store credit, whichever is more convenient for you. Please note that any shipping fees or associated costs will not be refunded.
    </li>
    <li>
      <strong>Damaged or Defective Items:</strong> In the unlikely event that you receive a damaged or defective item, please contact our customer service within 48 hours of receiving your order. We will gladly arrange for a replacement or refund, including any shipping fees incurred.
    </li>
    <li>
      <strong>Returns by Mail:</strong> If you are unable to visit our physical store, we accept returns by mail. Please contact our customer service to initiate the return process, and we will provide you with detailed instructions on how to proceed.
    </li>
    <li>
      <strong>In-Store Returns:</strong> For in-store returns or exchanges, kindly visit our store during operating hours and present the item(s) along with the original receipt or proof of purchase. Our friendly staff will assist you with the return process.
    </li>
    <li>
      <strong>Non-Returnable Items:</strong> Please note that gift cards, personalized items, and any items marked as final sale are non-returnable and non-refundable.
    </li>
    <li>
      <strong>Customer Responsibility:</strong> It is the customer's responsibility to ensure that returned items are packaged securely to prevent any damage during transit. We recommend using a trackable shipping method for returns by mail.
    </li>
    <li>
      <strong>Additional Information:</strong> Our return policy is subject to change without prior notice. Any modifications or updates will be communicated on our website or through other appropriate channels.
    </li>
  </ol>

  <p>At <strong>Kyufi</strong>, we value your satisfaction and aim to make your shopping experience enjoyable. If you have any questions or need further assistance regarding our return policy, please feel free to contact our customer service team. We appreciate your support and look forward to serving you again soon!</p>

  <p>Sincerely,</p>
  <p><em>Kyufi Team</em></p>
</div>
	

<?php 	
}

   ?>
</body>
</html>