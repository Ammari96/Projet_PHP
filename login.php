<?php
   session_start();
   
   
   $title="Login";
   
   
   include_once 'Functions/MyFunctions.php';
   
   if (isset($_GET['logout']))
   {
   	session_unset();
   	session_destroy();
   	header("Location: ./home.php");
   }
   
   if(isset($_POST["submit_login"])) {
       // Grabbing the Data
       $uid_login=$_POST["uid_login"];
       $pwd_login=$_POST["pwd_login"];
       loginUser($uid_login, $pwd_login);
       header("Location: ./home.php?error=none");
   }
   ?>
<head>
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
   <link rel="stylesheet" type="text/css" href="./styles/home.css">
   <link rel="stylesheet" type="text/css" href="./styles/signup.css">
   <style>
      .error {color:#FF0000;}
   </style>
</head>
<body>
   <header>
      <a href="./home.php#about" class="logo">
      <img src="images/logo.png" alt="">
      </a>
      <i class="fas fa-bars" id="menu-icon"></i>
      <ul class="navbar">
         <li id="home"><a style="font-size: 20px;" href="./home.php">Home</a></li>
         <li><a style="font-size: 20px;" href="./home.php#products">Products</a></li>
         <li id="reviews"><a style="font-size: 20px;" href="./home.php#customers">Reviews</a></li>
         <li><a style="font-size: 20px;" href="./kyufi game.php">PLAY</a></li>
         <li id="join"><a style="font-size: 20px;" href="./joinus.php">JOIN US</a></li>
         <li id="abouticon"><a style="font-size: 20px;" href="./home.php#about">About</a></li>
      </ul>
      <div class="header-icons" style="height:40px">
         <button id="shopping" style="font-size: 12px"><i class="fas fa-shopping-cart" id="cart-btn"></i><span id="cart-count"> </span></button>
         
         <button id="search-btn" style="font-size: 14px"><i class="fas fa-search" ></i></button>
         <input style="width:180px; font-size:15px" id="search-input" onkeyup="search()" type="text" placeholder="Search drinks, stores..." >
         <button id="lang" ><i class="fas fa-globe" style="font-size: 16px"></i></button>  
         
         <a href=<?php if(!(isset($_COOKIE['user_uid']))||!(isset($_COOKIE['user_id']))){ echo "./login.php"; } 
            else{
                echo "account.php";
            } ?>><button style="font-size: 14px"  class="header-btn" style="text-decoration: none;"><i class="fa-solid fa-user"></i></button></a>
         <?php if((isset($_COOKIE['user_uid']))&&(isset($_COOKIE['user_id']))){
            ?>
         <a href="./login.php?logout=true"><button style="font-size: 14px" class="header-btn"><i class="fa fa-sign-out"></i></button></a>
         <?php
            } ?>
      </div>
   </header>
   <div class="login">
   <h1 class="animate__animated animate__bounce" >Sign In</h1>
   <br>
   <!-- <div class="container"> -->
   <form method="post" action="./login.php">
      <!-- Email input -->
      <!-- <div class="form-outline mb-4"> -->
      <label class="form-label" for="loginEmail" id="loginEmailLabel" class="form-label" style="margin: 0; display: inline-block; float: left;"><b>Email address / UserName</b></label>    
      <input type="text" id="loginEmail" maxlength="254" class="form-control" name="uid_login"/>
      <!-- </div> -->
      <!-- Password input -->
      <!-- <div class="form-outline mb-4"> -->
      <label class="form-label" for="loginPassword" id="loginPasswordLabel" class="form-label" style="margin: 0; display: inline-block; float: left;"><b>Password</b></label>    
      </label>
      <input type="password" id="loginPassword" class="form-control" name="pwd_login"/>
      <label>
      <!-- </div> -->
      <!-- 2 column grid layout for inline styling -->
      <!-- <div class="row mb-4">
         <div class="col"> -->
      <!-- Simple link -->
      <!-- <a href="#!">Forgot password?</a>  -->
      <br><!--  </div>
         </div> -->
      <!-- Submit button -->
      <?php 
         if (isset($_SESSION["login_empty"])) {?>
      <p class="text-danger">
         <?php echo $_SESSION["login_empty"];
            if (isset($_GET['error']) && $_GET['error']=='uncorrectlogin')
            	echo '<br>uncorrect login or password';
            
            ?>
      </p>
      <?php } ?>
      <button type="submit" name="submit_login" class="btn btn-primary">Submit</button>
      <br>
      <span>Don't have an account yet ?</span><br><a href="signup.php" class="text-primary"> Click here to Sign Up.</a>
   </form>
</body>
</html>