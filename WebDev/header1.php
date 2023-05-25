<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
  body {
    font-family: Arial, sans-serif;
    color: #000000;
    background-color: #f5f5f5;
  }

  .home-header {
    display: flex;
    align-items: center;
    background-color: #ffffff;
    color: #000000;
    padding: 20px;
  }

  .logo img {
    width: 100px;
    height: auto;
    margin-left: 90px;
  }

  .navigation {
    flex-grow: 1;
    text-align: center;
  }

  .navigation ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }

  .navigation ul li {
    display: inline-block;
    vertical-align: middle;
    margin-right: 20px;
  }

  .navigation ul li a {
    color: #000000;
    text-decoration: none;
  }

  .header-buttons {
    display: flex;
    align-items: center;
    margin-left: auto;
  }

  .user-dropdown {
    color: #000000;
    text-decoration: none;
    margin-left: 10px;
    position: relative;
  }
  .cart-button{
    color: #000000;
    text-decoration: none;
    margin-right: 15px;
    position: relative;
    font-size: 24px;
  }

  .user-icon {
    color:#000000;
    font-size: 24px;
    margin-right: 5px;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    top: 100%;
    right: 0;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #f1f1f1;
  }

  .user-dropdown:hover .dropdown-content {
    display: block;
  }

  .navigation ul li a::after {
    content: '';
    display: block;
    width: 0;
    height: 2px;
    background-color: #1a1a1a; /* Change the color to your desired line color */
    transition: width 0.3s ease; /* Adjust the duration and easing as needed */
  }

  /* Increase the height of the line when hovering over the links */
  .navigation ul li a:hover::after {
    width: 100%; /* Set the width to 100% to make the line span the entire button width */
  }
</style>
<?php

include 'config.php';

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
};

if (isset($_GET['logout'])) {
  unset($user_id);
  session_destroy();
  header('location:login.php');
};
?>
<header class="home-header">
  <div class="logo">
    <img src="IMG/wen.png" alt="Logo">
  </div>
  <div class="navigation">
    <ul>
      <li><a href="index1.php">Home</a></li>
      <li><a href="women.php">Women</a></li>
      <li><a href="men.php">Men</a></li>
      <li><a href="kids.php">Kids</a></li>
    </ul>
  </div>
  <?php
  $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
  if (mysqli_num_rows($select_user) > 0) {
    $fetch_user = mysqli_fetch_assoc($select_user);
  };
  ?>
  <div class="header-buttons">
    <div>
      <a href="cart.php" class="cart-button">
        <i class="fas fa-shopping-cart"></i>
      </a>
    </div>
    <div class="user-dropdown">
      <i class="fas fa-user user-icon"></i>
      <?php echo $fetch_user['name']; ?>
      <div class="dropdown-content">
        <a href="yourOrders.php">My Orders</a>
        <a href="login.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
      </div>
    </div>
  </div>
</header>
