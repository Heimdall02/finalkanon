<?php

@include 'config.php';

if (isset($_SESSION['user_id'])) {
   // User is already logged in, redirect to appropriate page
   if ($_SESSION['user_email'] === 'admin@email.com') {
      header('location: adminMen.php');
      exit();
   } else {
      header('location: adminMen.php');
      exit();
   }
}

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Check if the user is an admin
   if ($email === 'admin@email.com' && $password === 'admin123') {
      $_SESSION['user_id'] = 'admin';
      $_SESSION['user_email'] = $email;
      header('location: adminMen.php');
      exit();
   } else {
      // Perform user login validation
      $query = "SELECT * FROM 'admin' WHERE email='$email' AND password='$password'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
         $row = mysqli_fetch_assoc($result);
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_email'] = $row['email'];

         // Redirect to appropriate page based on user role
         if ($row['role'] === 'admin') {
            header('location: adminMen.php');
         } else {
            header('location: adminMen.php');
         }
         exit();
      } else {
         $error = "Invalid email or password";
      }
   }
}

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'IMG/'.$p_image;
   $category = $_POST['p_category'];

   $insert_query = mysqli_query($conn, "INSERT INTO `$category`(name, price, image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'Product is succesfully added!';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `mens_products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:adminMen.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:adminMen.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'IMG/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `mens_products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:adminMen.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:adminMen.php');
   }

}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
  <style>
    /* Custom CSS styles */
    .card-header {
      background-color: #f8f9fa;
      font-weight: bold;
    }

    .card-body {
      padding: 20px;
    }

    .table {
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Dashboard</h1>

  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Product Processing</div>
        <div class="card-body">
          <!-- Product processing visualization -->
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Product Receiving</div>
        <div class="card-body">
          <!-- Product receiving visualization -->
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Product Delivery</div>
        <div class="card-body">
          <!-- Product delivery visualization -->
        </div>
      </div>
    </div>
  </div>
</div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
