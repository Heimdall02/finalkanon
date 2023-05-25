<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

if (isset($_GET['logout'])) {
   unset($user_id);
   session_destroy();
   header('location:login.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Confirmation</title>

   <!-- Link to your CSS file -->
   <link rel="stylesheet" href="confirmation.css">

</head>
<body>

   <div class="container">
      <h1>Thank You For Your Order!</h1>
      
      <div class="order-details">
         <h2>Order Details</h2>
         <?php
            // Retrieve order details from the database
            $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC LIMIT 1") or die('Query failed');
            if(mysqli_num_rows($order_query) > 0) {
               $order = mysqli_fetch_assoc($order_query);
         ?>
         <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
         <p><strong>Date:</strong> <?php echo $order['order_date']; ?></p>
         <p><strong>Name:</strong> <?php echo $order['name']; ?></p>
         <p><strong>Contact:</strong> <?php echo $order['contact']; ?></p>
         <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
         <p><strong>Shipping Address:</strong> <?php echo $order['shipping_address']; ?></p>
         <p><strong>Total Amount:</strong> <?php echo $order['amount_payable']; ?></p>
         <?php } ?>
      </div>

      <div class="back-to-home">
         <a href="index1.php">Back to Home</a>
      </div>
   </div>

</body>
</html>
