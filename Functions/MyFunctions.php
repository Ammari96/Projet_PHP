<?php

function connect()
{	
	require 'parametrage/param.php';
	$_bdd = null;

	try {
	$_bdd = new PDO("mysql:host=" .$_localhost . ";dbname=" . $_dbname . ";charset=utf8", $_user, $_pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
} catch (PDOException $e) {
	die('Erreur : ' . $e->getMessage());
}
    return $_bdd;
}

//Ajouter un employer
function addEmployee($Username,$Pass,$Phonenumber,$Age,$email,  $gender, $position)
{
	$con=connect();
	
	$requete = "INSERT INTO employee (Username, Pass, Phonenumber, Age, email, gender, position) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $reponse = $con->prepare($requete);
    $reponse->execute([$Username,$Pass,$Phonenumber,$Age,$email,  $gender, $position]);	
}


// Cette fonction récupère tous les produits de la base de données.
function findAllProducts() {
	$con =connect();
    // Prépare la requête SQL pour récupérer toutes les données de la table products.
    $request = "SELECT * FROM products";
    $reponse = $con->prepare($request);
    $reponse->execute();
    // Récupère toutes les lignes sous forme de tableau associatif.
    $products_=$reponse->fetchAll(PDO::FETCH_ASSOC);
    $products=[];
    // Parcourt le tableau de produits.
    foreach($products_ as $product) {
        // Ajoute les options pour chaque produit.
        $product['options']=getProductOptions($con, $product['product_id']);
        $products[]=$product;
    }
    // Renvoie le tableau de produits.
    return $products;
}
function changeUserRoleById($change_user_id, $new_role)
{
    $con = connect();
    $request = "UPDATE users SET role = ? WHERE users_id = ?";
    $reponse = $con->prepare($request);
    $reponse->execute([$new_role, $change_user_id]);
    return;
}

// Cette fonction récupère tous les produits de la base de données.
function findProductsCriteria($criteria) {
	$con =connect();
    // Prépare la requête SQL pour récupérer toutes les données de la table products.
    $request = "SELECT * FROM products where product_name like '%".$criteria."%'";
    $reponse = $con->prepare($request);
    $reponse->execute();
    // Récupère toutes les lignes sous forme de tableau associatif.
    $products_=$reponse->fetchAll(PDO::FETCH_ASSOC);
    $products=[];
    // Parcourt le tableau de produits.
    foreach($products_ as $product) {
        // Ajoute les options pour chaque produit.
        $product['options']=getProductOptions($con, $product['product_id']);
        $products[]=$product;
    }
    // Renvoie le tableau de produits.
    return $products;
}


// Cette fonction récupère les détails d'un produit spécifique.
function getProductDetails($con, $product_id) {
    // Prépare la requête SQL pour récupérer un produit spécifique.
    $request = "SELECT * FROM products WHERE product_id = ?";
    $reponse = $con->prepare($request);
    $reponse->execute([$product_id]);
    // Si aucun produit n'a été trouvé, renvoie null.
    if ($reponse->rowCount()==0)
        return null;
    // Sinon, récupère les détails du produit et ajoute les options.
    $product = $reponse->fetch(PDO::FETCH_ASSOC);
    $product['options']=getProductOptions($con, $product_id);
    // Renvoie le produit.
    return $product;
}

// Cette fonction récupère les options d'un produit spécifique.
function getProductOptions($con, $product_id) {
    // Prépare la requête SQL pour récupérer les options pour un produit spécifique.
    $request = "SELECT * from options WHERE productid = ?";
    $reponse = $con->prepare($request);
    $reponse->execute([$product_id]);
    // Récupère toutes les lignes sous forme de tableau associatif.
    $options = $reponse->fetchAll(PDO::FETCH_ASSOC);
    // Renvoie les options.
    return $options;
}

function deleteProduct($product_id)
{
    $con = connect();
		
    $request = "delete from options WHERE productid = ?";
    $reponse = $con->prepare($request);
    $reponse->execute([$product_id]);
	
    $request = "delete from products WHERE product_id = ?";
    $reponse = $con->prepare($request);
    $reponse->execute([$product_id]);	
	
    return;	
	
}



// Ces fonctions concernent les utilisateurs.
function findUserById($id) {
	$con=connect();
    // Cette fonction récupère un utilisateur spécifique par son id.
    $request = "SELECT * FROM users  WHERE users_id = ?";
    $reponse = $con->prepare($request);
    $reponse->execute([$id]);
    return $reponse->fetch(PDO::FETCH_ASSOC);
}

function getAllUsers() {
	$con=connect();
    // Cette fonction récupère un utilisateur spécifique par son id.
    $request = "SELECT * FROM users";
    $reponse = $con->prepare($request);
	$reponse->execute();
    return $reponse->fetchAll(PDO::FETCH_ASSOC);
}

function deleteUserById($del_user_id)
{
	$con=connect();
    // Cette fonction récupère un utilisateur spécifique par son id.
    $request = "delete from users where users_id = ?";
    $reponse = $con->prepare($request);
	$reponse->execute([$del_user_id]);
    return ;	
}


function checkUid($uid) {
    // Cette fonction vérifie si un nom d'utilisateur est déjà utilisé.
    $stmt = connect()->prepare("SELECT users_id FROM users WHERE users_uid = ?;");
    if (!$stmt->execute(array($uid))) {
        $stmt = null;
        header("Location: ./login.php?error=stmtFailed");
        exit();
    }
    $resultCheck = $stmt->rowCount() > 0 ? false : true;
    return $resultCheck;
}

function checkTel($tel) {
    // Cette fonction vérifie si un numéro de téléphone est déjà utilisé.
    $stmt = connect()->prepare("SELECT users_id FROM users WHERE users_tel = ?;");
    if (!$stmt->execute(array($tel))) {
        $stmt = null;
        header("Location: ./login.php?error=stmtFailed");
        exit();
    }
    $resultCheck = $stmt->rowCount() > 0 ? false : true;
    return $resultCheck;
}

function checkEmail($email) {
    // Cette fonction vérifie si une adresse e-mail est déjà utilisée.
    $stmt = connect()->prepare("SELECT users_id FROM users WHERE users_email = ?;");
    if (!$stmt->execute(array($email))) {
        $stmt = null;
        header("Location: ./login.php?error=stmtFailed");
        exit();
    }
    $resultCheck = $stmt->rowCount() > 0 ? false : true;
    return $resultCheck;
}

// Récupère les informations de l'utilisateur en fonction du nom d'utilisateur ou de l'email
function getUser($uid_login, $pwd_login) {
    // Se connecte à la base de données
    $dbh = connect();
    // Prépare une requête pour sélectionner tous les champs de la table 'users' où le nom d'utilisateur ou l'email correspondent
    $stmt = $dbh->prepare("SELECT * FROM users WHERE users_uid = ? OR users_email = ?;");
    // Exécute la requête avec les paramètres donnés
    if(!($stmt->execute(array($uid_login,$uid_login)))) {
        // Si l'exécution échoue, annule la déclaration et redirige vers la page de connexion avec une erreur
        $stmt = null;
        header("Location: ./login.php?error=stmtFailed");
        exit();
    }
    // Vérifie si la requête a retourné un résultat. Si ce n'est pas le cas, l'utilisateur n'existe pas.
    if($stmt->rowCount() == 0){
        $stmt = null;
        header("Location: ./login.php?error=uncorrectlogin");
        exit();
    }
    // Récupère les résultats de la requête sous forme de tableau associatif
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // Vérifie le mot de passe donné avec le mot de passe hashé stocké dans la base de données
    $checkPwd = password_verify($pwd_login, $user["users_pwd"]);
    // Si le mot de passe ne correspond pas, redirige vers la page de connexion avec une erreur
    if($checkPwd == false){
        $stmt = null;
        header("Location: ./login.php?error=uncorrectlogin");
        exit();
    } else {   
        // Si le mot de passe correspond, démarre une session pour cet utilisateur
        $_SESSION["user_id"] = $user["users_id"];
        $_SESSION["user_uid"] = $user["users_uid"];
		$_SESSION['user_role']= $user["role"];
        $_SESSION['cart']=[];
        $stmt = null;
    }  
}

// Vérifie si les champs de connexion sont vides
function emptyInput($uid_login, $pwd_login){
    // Initialise le résultat à false
    $result = false;
    // Si le nom d'utilisateur ou le mot de passe sont vides, le résultat reste à false
    if((empty($uid_login)) || (empty($pwd_login))){
        $result = false;
    } else {
        // Si les deux sont remplis, le résultat est vrai
        $result = true;
    }
    return $result;
}

// Connecte l'utilisateur
function loginUser($uid_login, $pwd_login){
    // Vérifie si les champs de connexion sont vides. Si c'est le cas, redirige vers la page de connexion avec une erreur
    if(emptyInput($uid_login, $pwd_login) == false) {
        $_SESSION["login_empty"] = "Please Fill in the forms!";
        header("Location: ./login.php?error=emptyinput");
        exit();
    }
    // Récupère l'utilisateur
    getUser($uid_login, $pwd_login);
}

// Calcul le total du panier
function total_cart($card_content)
{
    $total=0;
    if (!isset($card_content))
        return 0;
    // Parcourt les articles du panier et ajoute leur prix au total
    foreach ($card_content as $item)
    {
        $total=$total+$item['price'];
    }
    return $total; 
}

// Crée une nouvelle commande à partir du panier
function create_command($card_content, $user_id, $delivery_name, $delivery_address,$delivery_phone)
{
    $db = connect();
    $command_date=date('Y-m-d H:i:s');
    // Prépare une requête pour insérer une nouvelle commande dans la base de données
    $request = "insert into commande (users_id, commande_date, delivery_name, delivery_address, delivery_phone) values (:user_id, :date, :name, :addr, :phone)";
    $stmt = $db->prepare($request);
    // Lie les paramètres à la requête et l'exécute
    $stmt->bindParam(":user_id",$user_id);
    $stmt->bindParam(":date",$command_date, PDO::PARAM_STR);
    $stmt->bindParam(":name",$delivery_name);
    $stmt->bindParam(":addr",$delivery_address);
    $stmt->bindParam(":phone",$delivery_phone);
    $stmt->execute();
    $command_id = $db->lastInsertId();
    // Continue à insérer les détails de la commande dans la base de données
    // Parcourt les articles du panier et les insère dans la base de données
    // Renvoie la description de la commande
	$request = "insert into details_command (command_id, option_id, price) values (:command_id, :option_id, :price)";
	$stmt = $db->prepare($request);
	$stmt->bindParam(":command_id",$command_id);
	$description="";
	foreach ($card_content as $item)
	{
		$description="\n".$description.$item['product_name'].'     '.$item['option_name'].'     '.$item['price']."\n";
		$option_id=$item['option_id'];
		$price=$item['price'];
		$stmt->bindParam(":option_id",$option_id);
		$stmt->bindParam(":price",$price);
		$stmt->execute();
	}
	
    return $description;	
		
}

function addRate($name ,$phone,$email, $comment)
{
	$db = connect();
    $request = "insert into rates (name ,phone,email ,comment) values (:name ,:phone,:email ,:comment)";
    $stmt = $db->prepare($request);
    // Lie les paramètres à la requête et l'exécute
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":phone",$phone);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":comment",$comment);
    $stmt->execute();
    $rate_id = $db->lastInsertId();
	return $rate_id;
}
//Ajouter de nouveaux produits par l'administrateur
function addProduct($product_name, $product_price,$product_image,$product_type,$product_desc) {
    $db = connect();
    
    $request = "INSERT INTO products (product_name, product_image, product_type, product_description ) ";
	$request= $request ." VALUES (:product_name, :product_image, :product_type, :product_desc)";
    $stmt = $db->prepare($request);
    
    // Lie les paramètres à la requête et l'exécute
    $stmt->bindParam(":product_name", $product_name);
    $stmt->bindParam(":product_image", $product_image);
	$stmt->bindParam(":product_type", $product_type);
	$stmt->bindParam(":product_desc", $product_desc);
    $stmt->execute();
    $product_id = $db->lastInsertId();
	
	$request = "INSERT INTO options (name, price, productid ) VALUES ('Basic', :product_price, :product_id)";
    $stmt = $db->prepare($request);	
    $stmt->bindParam(":product_id", $product_id);
    $stmt->bindParam(":product_price", $product_price);	
	$stmt->execute();
    // Ferme la connexion à la base de données
    $db = null;
}

function addUser($username, $password, $tel, $role, $address, $email) {
    // Connexion à la base de données
    $db = connect();
    
    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $db->prepare("INSERT INTO users (users_uid, users_pwd, users_tel, role, users_address, users_email) VALUES (:username, :password, :tel, :role, :address, :email)");
    
	// Liez les paramètres à l'instruction et exécutez-la
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hashed_password);
    $stmt->bindParam(":tel", $tel);
    $stmt->bindParam(":role", $role);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":email", $email);
    
   
    $stmt->execute();
    
    
    $db = null;
}
