<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$message = array();

if(!isset($user_id)){
  header('location:login.php');
};

if(isset($_GET['logout'])){
  unset($user_id);
  session_destroy();
  header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['product_quantity'];
  $product_size = $_POST['product_size'];

  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

  if(mysqli_num_rows($select_cart) > 0){
    $message[] = 'product added to cart!';
  }else{
    mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity, size) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity', '$product_size')") or die('query failed');
    $message[] = 'Product Added To Cart!';
  }

};
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top Gs</title>
  <link rel="stylesheet" href="menstyle.css">
  <style>
.message{
  background-color: var(--blue);
  position: sticky;
  top:0; left:0;
  z-index: 10000;
  border-radius: .5rem;
  background-color: var(--white);
  padding:1.5rem 2rem;
  margin:0 auto;
  max-width: 1200px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap:1.5rem;
}
</style>
  <script>

function addToCart() {
      alert('Product added to cart!');
    }
  </script>
</head>
<body>

<?php

if(isset($message)){
  foreach($message as $msg){
    echo '<div class="message"><span>'.$msg.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
  };
};

?>
  <!-- Header section -->
  <?php include 'header1.php'; ?>

  <section class="hero">
    <h1 >Buy Now!</h1>
    <p style="background: rgba(254, 254, 254, 0.37); width:50%; margin-left: 30%;">Find your perfect fit for you and look great from head to toe.</p>
  </section>

  <!-- Products section -->
  <section class="products">
    <h2>New Arrivals</h2>
    <div class="product-container">
    <?php
    $select_product = mysqli_query($conn, "SELECT * FROM `mens_products`") or die('query failed');

    if (mysqli_num_rows($select_product) > 0) {
      while($fetch_product = mysqli_fetch_assoc($select_product)) {
    ?>

    <form method="post" class="product" action="" >
      <a href="proc1.php?id=<?php echo $fetch_product['id']; ?>">
        <img src="IMG/<?php echo $fetch_product['image']; ?>" alt="">
      </a>
      <h3><?php echo $fetch_product['name']; ?></h3>
      <p>₱<?php echo $fetch_product['price']; ?></p>
      <label for="product_size">Size:</label>
      <select name="product_size" id="product_size">
        <option value="6">6</option>
        <option value="6.5">6.5</option>
        <option value="7">7</option>
        <option value="7.5">7.5</option>
        <option value="8">8</option>
        <option value="8.5">8.5</option>
        <option value="9">9</option>
        <option value="9.5">9.5</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>
      <br>
      <br>
      <label for="product_quantity">Quantity:</label>
      <input type="number" min="1" name="product_quantity" value="1">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>"><br><br>
      <input type="submit" value="add to cart" name="add_to_cart" class="button" onclick="addToCart();">
    </form>
    <?php
      }
    } else {
      echo "No products found.";
    }
    ?>
    </div>
  </section>

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
