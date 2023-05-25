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
// Retrieve the product_id from the URL parameter
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  // Fetch the product details from the database based on the product_id
  $select_product = mysqli_query($conn, "SELECT * FROM `women_products` WHERE id = '$product_id'") or die('query failed');

  if (mysqli_num_rows($select_product) > 0) {
    $product = mysqli_fetch_assoc($select_product);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $product['name']; ?> - Product Details</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      display: flex;
      align-items: center;
    }

    .product-image {
      flex-basis: 50%;
      padding-right: 20px;
    }

    .product-details {
      flex-basis: 50%;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    p {
      font-size: 16px;
      margin-bottom: 20px;
    }

    img {
      max-width: auto;
      height: 500px;
      margin-bottom: 20px;
    }

    .back-link {
      display: inline-block;
      margin-bottom: 20px;
      color: #333;
      text-decoration: none;
    }

    .size-select,
    .quantity-select {
      margin-bottom: 20px;
      padding: 8px;
      font-size: 16px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    .quantity-select {
      width: 60px;
    }

    .add-to-cart-btn {
      display: block;
      padding: 15px 100px;
      background-color: #333;
      color: #fff;
      text-align: center;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .add-to-cart-btn:hover {
      background-color: #595959;
    }
  </style>
</head>
<body>
<?php include 'header1.php'; ?>
  <div class="container">
    <div class="product-image">
      <img src="IMG/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    </div>
    <div class="product-details">
      <h1><?php echo $product['name']; ?></h1>
      <p><strong>Price:</strong> ₱<?php echo $product['price']; ?></p>
      
  
      <form action="add_to_cart.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
  
        <label for="size">Size:</label>
        <select name="size" id="size" class="size-select">
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
  
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="quantity-select" min="1" value="1">
  
        
        <p> <?php echo $product['description']; ?></p>
      </form>
    </div>
  </div>
</body>
</html>


<?php
  } else {
    echo "Product not found.";
  }
} else {
  echo "Invalid product ID.";
}
?>
