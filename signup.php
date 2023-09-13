<?php
if (session_status()!= PHP_SESSION_ACTIVE)
	session_start();
$title="SignUp";
//include "header.php";

include_once 'Functions/MyFunctions.php';



if (isset($_POST["submit_login"])) {
    // Grabbing the Data
    $uid_login = $_POST["uid_login"];
    $pwd_login = $_POST["pwd_login"];

    echo $uid_login;
    echo $pwd_login;


    // Error Handling
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $address = $_POST["address"];

    if (checkUid($uid)) {
        if (checkTel($tel)) {
            if (checkEmail($email)) {
				addUser($uid, $pwd, $tel, 'user', $address, $email);
                header("Location:./home.php?error=none");
            } else {
                header("Location: ./login.php?error=emailTaken");
                exit();
            }
        } else {
            header("Location: ./login.php?error=telTaken");
            exit();
        }
    } else {
        header("Location: ./login.php?error=uidTaken");
        exit();
    }
}


include_once 'header.php';
?>

<link rel="stylesheet" href="./styles/signup.css?d=b">

 

<div class="login">
    <h1 class="animate__animated animate__bounce" >Sign Up</h1><br>
    <span class="error">* Required Field</span>
<!-- <div class="row login">
  <div class="mx-auto col-10 col-md-8 col-lg-6"> -->
  <form method="POST" action="./signup.php">
    <!-- <div class="form-row">
      <div class="form-group col-md-12"> -->
        <label for="inputUsername4" class="form-label" style="margin: 0; display: inline-block; float: left;"><b>* Username</b></label><br>
        <input  class="form-control" type="text" class="form-control" id="inputUsername4" placeholder="Username" 
        value="<?php if((!isset($_SESSION["allok"]))&&(isset($_SESSION["correctuid"]))) {echo $_SESSION["correctuid"];unset($_SESSION["correctuid"]);}?>" name="uid">
        <?php
          if(isset($_SESSION["invaliduiderror"])){
            ?>
             <p class="text-danger"> <?= $_SESSION["invaliduiderror"] ?></p>
        
          <?php
          unset($_SESSION["invaliduiderror"]);
          unset($_SESSION["wronguid"]);
          
        }
        if(isset($_SESSION["uidtaken"])){
          ?>
          <p class="text-danger" style="margin-bottom: -1px;margin-top: -5px;">UID taken</p>
        <?php 
        unset($_SESSION["uidtaken"]);
      }
        ?>
      <!-- </div> -->
      <!-- <div class="form-group col-md-12"> -->
        <label for="inputPassword4" class="form-label" style="margin: 0; display: inline-block; float: left;"><b>* Email</b></label><br>
        <input type="text" class="form-control" id="inputEmail4" placeholder="Email" value="<?php if((!isset($_SESSION['allok']))&&(isset($_SESSION["correctemail"]))) {echo $_SESSION["correctemail"];unset($_SESSION["correctemail"]);}?>" name="email">
        <?php
          if(isset($_SESSION["invalidemailerror"])){
            ?>
             <p class="text-danger" style="margin-bottom: -1px;margin-top: -5px;"> <?= $_SESSION["invalidemailerror"] ?></p>
        
          <?php
          unset($_SESSION["invalidemailerror"]);
          unset($_SESSION["wrongemail"]);

        }
        if(isset($_SESSION["emailtaken"])){
          ?>
          <p class="text-danger" style="margin-bottom: -1px;margin-top: -5px;">Email taken.</p>
        <?php 
        unset($_SESSION["emailtaken"]);
        }
        ?>
      <!-- </div>
    </div> -->
    <!-- <div class="form-row">
      <div class="form-group col-md-12"> -->
        <label for="inputPassword4" class="form-label" style="margin: 0; display: inline-block; float: left;"><b>* Password</b></label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Password" value="<?php if((!isset($_SESSION['allok']))&&(isset($_SESSION["correctpwd"]))) {echo $_SESSION["correctpwd"];unset($_SESSION["correctpwd"]);}?>" name="pwd">
        <label>
        </label>
      <!-- </div>
      <div class="form-group col-md-12"> -->
        <label for="inputPassword4" class="form-label" style="margin: 0; display: inline-block; float: left;"><b>* Repeat Password</b></label>
        <input type="password" class="form-control" id="inputRepeatPWD" placeholder="Repeat Password" value="<?php if((!isset($_SESSION['allok']))&&(isset($_SESSION["correctpwd"]))) {echo $_SESSION["correctpwd"];unset($_SESSION["correctpwd"]);}?>" name="pwdrepeat">
        <label>
        </label>
      <!-- </div> -->
      <?php
          if(isset($_SESSION["pwdmatcherror"])){
            ?>
             <p class="text-danger" style="margin-bottom: -5px;margin-top: -20px;"> <?= $_SESSION["pwdmatcherror"] ?></p>
        
          <?php
        }
        unset($_SESSION["pwdmatcherror"]);
        unset($_SESSION["wrongpwd"]);
        ?>
    <!-- </div> -->
    <!-- <div class="form-outline mb-3" style="width: 100%; max-width: 22rem"> -->
        <input class="form-control" type="text" id="phone" placeholder="+33 *********" data-mdb-input-mask="+33 999999999" 
		value="<?php if((!isset($_SESSION['allok']))&&(isset($_SESSION["correcttel"]))) {echo $_SESSION["correcttel"];unset($_SESSION["correcttel"]);}?>" name="tel">

        
        
        <?php
          if(isset($_SESSION["invalidtelerror"])){
            ?>
             <p class="text-danger" style="margin-bottom: -1px;margin-top: -5px;"> <?= $_SESSION["invalidtelerror"] ?></p>
        
          <?php
        
        unset($_SESSION["invalidtelerror"]);
        unset($_SESSION["wrongtel"]);
      }
      if(isset($_SESSION["teltaken"])){
        ?>
        <p class="text-danger" style="margin-bottom: -1px;margin-top: -5px;">Phone number taken.</p>
      <?php 
      unset($_SESSION["teltaken"]);
    }
      ?>
      ?>
    <!-- </div>

    
    <div class="form-row"> -->
      <!-- <div class="form-group col-md-12">
        <label for="inputCity">City</label>
        <input type="text" class="form-control" placeholder="Example : Paris" id="inputCity" name="city">
      </div> -->
      <!-- <div class="form-group col-md-12"> -->
        <label for="inputAddress" class="form-label" style="margin: 0; display: inline-block; float: left;"><b style = "position:relative; left:8px; top:0px;">Address</b></label>  
        <input type="text" class="form-control" id="inputAddress" placeholder="Example : Paris, Rue de la République" 
        value="<?php if((!isset($_SESSION['allok']))&&(isset($_SESSION["correctaddress"]))) {echo $_SESSION["correctaddress"];unset($_SESSION["correctaddress"]);}?>" name="address">
        <?php
          if(isset($_SESSION["invalidaddresserror"])){
            ?>
             <p class="text-danger"> <?= $_SESSION["invalidaddresserror"] ?></p>
        
          <?php
          unset($_SESSION["invalidaddresserror"]);
          unset($_SESSION["wrongaddress"]);
        }
        ?>
      <!-- </div> -->
    <?php if(isset($_SESSION["emptyerror"])){
      ?> <p class="text-danger"> <?php echo $_SESSION["emptyerror"]; unset($_SESSION["emptyerror"]);?> </p>
    <?php } ?>
    <!-- </div> -->
    <button type="submit" name="submit_login" class="btn btn-primary">Sign Up</button>

  </form>
  <span>Already have an account ?</span><br><a href="login.php" class="text-primary"> Click here to sign in.</a>
<!-- </div> -->
<!-- </div> -->
    </div>
</body>

</html>