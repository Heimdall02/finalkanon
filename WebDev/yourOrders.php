<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
  exit(); // Add an exit() statement to stop executing the rest of the code
}

if (isset($_GET['logout'])) {
  unset($user_id);
  session_destroy();
  header('location:login.php');
  exit(); // Add an exit() statement to stop executing the rest of the code
}

if (isset($_GET['cancel'])) {
  $order_id = $_GET['cancel'];
  // Delete the order from the cart table
  $delete_query = mysqli_query($conn, "DELETE FROM `orders` WHERE user_id = '$user_id' AND id = '$order_id'");
  if ($delete_query) {
    header('location:yourOrders.php');
    exit(); // Add an exit() statement to stop executing the rest of the code
  } else {
    echo "Failed to cancel the order.";
  }
}

$grand_total = 0;
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
if (mysqli_num_rows($cart_query) > 0) {
  while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
    $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
    $grand_total += $sub_total;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders</title>
  <link rel="stylesheet" href="style.css">
  <style>
    
    .order-container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
    }

    .order-container h2 {
      text-align: center;
    }

    .order-item {
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
      display: flex;
      align-items: center;
    }

    .order-item img {
      width: 80px;
      height: auto;
      margin-right: 20px;
    }

    .order-item-details {
      flex-grow: 1;
    }

    .order-item-details h3,
    .order-item-details p {
      margin: 0;
    }

    .order-item-details p {
      color: #888;
    }

    .cancel {
    display: inline-block;
    padding: 8px 16px;
    background-color: #f44336;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
  }

  .cancel:hover {
    background-color: #d32f2f;
  }
  .cancel-button {
  display: inline-block;
  background-color: #333;
  color: #fff;
  text-decoration: none;
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.2s ease;

}

  
  </style>
  <script>
  function showConfirmation(orderId) {
    var confirmation = confirm("Are you sure you want to cancel this order?");

    if (confirmation) {
      window.location.href = "yourOrders.php?cancel=" + orderId;
    }
  }
</script>
</head>
<body>

  <?php include 'header1.php'; ?>

  <div class="order-container">
    <h2>Your Orders</h2>
    <?php
    $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($select_orders) > 0) {
      while ($fetch_order = mysqli_fetch_assoc($select_orders)) {
        ?>
        <div class="order-item">
          <div class="order-item-details">
            <p>Order ID: <?php echo $fetch_order['id']; ?></p>
            <p>Order Date: <?php echo $fetch_order['order_date']; ?></p>
            <p>Shipping Adrress: <?php echo $fetch_order['shipping_address']; ?></p>
            <p>Payment Method: <?php echo $fetch_order['payment_method']; ?></p>
            <p>Amount Payable: <?php echo $fetch_order['amount_payable']; ?></p>
            <p>Status: <input type="text" id="status" value="<?php echo $fetch_order['status']; ?>" readonly></p>
          </div>
          
          <a href="yourOrders.php?cancel=<?php echo $fetch_order['id']; ?>" class="cancel-button" onclick="showConfirmation();">Cancel Order</a>
        </div>
        <?php
      }
    } else {
      echo "<p>Agorder ka pelang.</p>";
    }
    ?>
  </div>

<br><br>
<footer style="margin-top: 30%">
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
