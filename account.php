<?php
   include_once 'header.php';
   
   if (!isset($_SESSION['user_id'])) {
       header("location: ./login.php");
       exit;
   }
   // Stocker 'user_id' de la session dans une variable

   $user_id = $_SESSION['user_id'];
   // Trouver un utilisateur par son ID et stocker les données retournées dans la variable 'item'

   $item = findUserById($user_id);
   // Si le rôle de l'utilisateur est 'user', afficher la section d'identité

   if ($_SESSION['user_role'] == 'user') {
       ?>
<!-- Main -->
<head>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100;300;400;500;700&display=swap">
	<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,500;0,900;1,400;1,500;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100;300;400;500;700&display=swap">
</head>
<br>
<div class="main">
   <h2>IDENTITY</h2>
   <div class="card">
      <div class="card-body">
         <i class="fa fa-pen fa-xs edit"></i>
         <table>
            <tbody>
               <tr>
                  <td>Username</td>
                  <td>:</td>
                  <td><?php echo $item['users_uid']; ?></td>
               </tr>
               <tr>
                  <td>Email</td>
                  <td>:</td>
                  <td><?php echo $item['users_email']; ?></td>
               </tr>
               <tr>
                  <td>Address</td>
                  <td>:</td>
                  <td><?php echo $item['users_address']; ?></td>
               </tr>
               <tr>
                  <td>Phone Number</td>
                  <td>:</td>
                  <td><?php echo $item['users_tel']; ?></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php
   }
   
   // Si le rôle de l'utilisateur est 'admin'

   if ($_SESSION['user_role'] == 'admin') {
   	   // Si un formulaire d'ajout de produit a été soumis

   	if (isset($_POST['add_product'])) {
		      // Récupérer les détails du produit à partir du formulaire

       $product_name = $_POST['product_name'];
       $product_price = $_POST['product_price'];
   	$product_image= $_POST['product_image'];
   	$product_type= $_POST['product_type'];
   	$product_desc= $_POST['product_desc'];
       addProduct($product_name, $product_price,$product_image,$product_type,$product_desc);
   	}
      // Si un formulaire de suppression de produit a été soumis

   
   	if (isset($_POST['delete_product'])) {
       $product_id = $_POST['product_id'];
   	deleteProduct($product_id);
   	}
      // Si un formulaire de suppression d'utilisateur a été soumis

       if (isset($_POST['delete_user'])) {
           $del_user_id = $_POST['delete'];
           deleteUserById($del_user_id);
       }
   // Si un formulaire de changement de rôle a été soumis
       if (isset($_POST['changeRole'])) {
           $change_user_id = $_POST['changeRole'];
           $new_role = $_POST['role'];
           changeUserRoleById($change_user_id, $new_role);
       }
      // Si un formulaire d'ajout d'utilisateur a été soumis

       if (isset($_POST['add_user'])) {
   		$address = $_POST['address'];
   		$email = $_POST['email'];		
   		$username = $_POST['username'];
   		$password = $_POST['password'];
   		$tel = $_POST['tel'];
   		$role = $_POST['role'];				
           addUser($username, $password, $tel, $role, $address, $email);
       }	
   	
   
       $users = getAllUsers();
       ?>
<div style="margin-top: 120px; " ></div>
<div class="main">
   <h2>USERS ACCOUNTS</h2>
   <div class="card">
      <div class="card-body">
         <i class="fa fa-pen fa-xs edit"></i>
         <table>
            <tbody>
               <tr>
                  <td><b>User name</b></td>
                  <td><b>Role</b></td>
                  <td></td>
                  <td></td>
               </tr>
               <?php
			      // Parcourir chaque utilisateur dans la liste des utilisateurs

                  foreach ($users as $user) {
					        // Si l'utilisateur actuel est l'utilisateur connecté, passer à l'utilisateur suivant

                      if ($user['users_id'] == $_SESSION['user_id']) {
                          continue;
                      }
                      echo '<tr><td>' . $user['users_uid'] . '</td><td>' . $user['role'] . '</td>';
                      ?>
               <td>
                  <form action="account.php" method="post">
				     <!--Ajouter un champ caché qui contient l'ID de l'utilisateur-->

                     <input type="hidden" name="delete" value="<?php echo $user['users_id']; ?>">
					 <!-- Ajouter un bouton de soumission pour supprimer le compte de l'utilisateur-->
                     <input type="submit" name="delete_user" value="Delete Account" class="search">
                  </form>
               </td>
               <td>
                  <form action="account.php" method="post">
                     <input type="hidden" name="changeRole" value="<?php echo $user['users_id']; ?>">
                     <select name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                     </select>
                     <input type="submit" value="Change Role" class="search">
                  </form>
               </td>
               </tr>
               <?php
                  }
                  ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<div class="main">
   <h2>Add User</h2>
   <div class="card">
      <div class="card-body">
         <i class="fa fa-pen fa-xs edit"></i>
         <table>
            <tbody>
               <form action="account.php" method="post">
                  <tr>
                     <td>
                        <label for="username" class="form-label">Username:</label>
                     </td>
                     <td>
                        <input type="text" name="username" id="username" class="form-input" placeholder="Username" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="password" class="form-label">Password:</label>
                     </td>
                     <td>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Password" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="tel" class="form-label">Phone Number:</label>
                     </td>
                     <td>
                        <input type="tel" name="tel" id="tel" class="form-input" placeholder="Phone Number" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="email" class="form-label">Email:</label>
                     </td>
                     <td>
                        <input type="email" name="email" id="email" class="form-input" placeholder="Email Address" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="address" class="form-label">Address:</label>
                     </td>
                     <td>
                        <input type="text" name="address" id="email" class="form-input" placeholder="Email Address" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="role" class="form-label">Role:</label>
                     </td>
                     <td>
                        <select name="role" id="role">
                           <option value="user">User</option>
                           <option value="admin">Admin</option>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td><input type="submit" name="add_user" value="Add User" class="search"></td>
                  </tr>
               </form>
            </tbody>
         </table>
      </div>
   </div>
</div>
<div class="main">
   <h2>Products</h2>
   <div class="card">
      <div class="card-body">
         <i class="fa fa-pen fa-xs edit"></i>
         <button id="showProductsBtn" class="search">Show Products</button>
         <div id="productsContainer" style="display: none;">
            <table>
               <tbody>
                  <tr>
                     <td>Product Name</td>
                     <td>Product Price</td>
                     <td>Action</td>
                  </tr>
                  <?php
                     $products = findAllProducts(); // Récupérer tous les produits de la table "options"
                     foreach ($products as $product) {// Parcourir chaque produit retourné par la fonction
                         echo '<tr>
                             <td>' . $product['product_name'] . '</td>
                             <td>' . $product['options'][0]['price'] . '</td>
                             <td>
                                 <form action="account.php" method="post">
                                     <input type="hidden" name="product_id" value="' . $product['product_id'] . '">
                                     <input type="submit" name="delete_product" value="Delete" class="search">
                                 </form>
                             </td>
                         </tr>';
                     }
                     ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="main">
   <h2>Add Product</h2>
   <div class="card">
      <div class="card-body">
         <i class="fa fa-pen fa-xs edit"></i>
         <table>
            <tbody>
               <form action="account.php" method="post">
                  <tr>
                     <td>
                        <label for="product_name" class="form-label">Name:</label>
                     </td>
                     <td>
                        <input type="text" name="product_name" id="product_name" class="form-input" placeholder="Product Name" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="product_price" class="form-label">Price:</label>
                     </td>
                     <td>
                        <input type="number" step="0.01" name="product_price" id="product_price" class="form-input" placeholder="Product Price" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="product_image" class="form-label">Image url:</label>
                     </td>
                     <td>
                        <input type="text" step="0.01" name="product_image" id="product_image" class="form-input" placeholder="Product Image" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="type" class="form-label">Product type:</label>
                     </td>
                     <td>
                        <select name="product_type" id="type">
                           <option value="Drink">Drink</option>
                           <option value="Cakes and Cookies">Cakes and Cookies</option>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label for="product_desc" class="form-label">Description:</label>
                     </td>
                     <td>
                        <textarea type="number" step="0.01" name="product_desc" id="product_price" rows="4" cols="70" class="form-input" placeholder="Product Description" required>
                        </textarea>
                     </td>
                  </tr>
                  <tr>
                     <td><input type="submit" name="add_product" value="Add Product" class="search"></td>
                  </tr>
               </form>
            </tbody>
         </table>
      </div>
   </div>
</div>
</div>
<?php 
   } ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="admin.js"></script>
</body>
</html>