<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
};

if(isset($_GET['logout'])){
  unset($user_id);
  session_destroy();
  header('location:login.php');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>

   <!-- Link to your CSS file -->
   <link rel="stylesheet" href="style3.css">

</head>
<body>
<?php include 'header1.php'; ?>

   <div class="container">
      <h1>About Us</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis ullamcorper mauris. Sed tincidunt tellus in justo iaculis, vitae vestibulum justo elementum. Vivamus suscipit malesuada lectus, nec varius est auctor id. Fusce malesuada metus sed odio fringilla, et lacinia orci viverra. Integer eget dui lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas lacinia risus sed efficitur pharetra. Fusce ultricies ex vitae metus dignissim tincidunt. Cras a consectetur massa. Nam id mi condimentum, facilisis nunc vitae, maximus felis.</p>
      <p>Suspendisse potenti. Nam convallis massa vitae mauris viverra, eu aliquam erat tristique. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque sollicitudin massa et efficitur bibendum. Sed elementum risus nec dui varius, id tincidunt felis tincidunt. Proin commodo, lectus nec luctus egestas, lectus velit vestibulum nulla, et hendrerit est turpis at metus. Curabitur vitae sem turpis. Nullam non ligula ut elit tincidunt venenatis. Proin volutpat risus in tellus luctus, nec aliquet enim posuere. Aliquam gravida orci et lorem finibus dapibus. Nulla convallis fringilla ligula non aliquam.</p>
   </div>
<br><br>
   <footer>
   <ul>
      <li><a href="about.php">About Us |</a></li>
      <li><a href="contact.php">Contact Us |</a></li>
      <li><a href="policy.php">Privacy Policy |</a></li>
      <li><a href="terms.php">Terms & Conditions</a></li>
    </ul>
      <p>&copy; 2023 Developed by Us. All Rights Reserved.</p>
    </footer>
</body>
</html>
