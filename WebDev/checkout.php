<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

$grand_total = 0;
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
if(mysqli_num_rows($cart_query) > 0){
   while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
      $grand_total += $sub_total;
   }
}

if (isset($_POST['checkout'])) {
   // Retrieve and validate form data
   $name = $_POST['name'];
   $contact = $_POST['contact'];
   $payment_method = $_POST['payment_method'];
   $shipping_address = $_POST['shipping_address'];
   

   // Calculate the total amount
   $amount_payable_query = mysqli_query($conn, "SELECT SUM(price * quantity) AS amount_payable FROM cart WHERE user_id = '$user_id'") or die('Query failed');
   $amount_payable_result = mysqli_fetch_assoc($amount_payable_query);
   $amount_payable = $amount_payable_result['amount_payable'];

   // Insert order details into the database
   $insert_query = "INSERT INTO orders (user_id, order_date, name, contact, payment_method, shipping_address, amount_payable, status) VALUES ('$user_id', NOW(), '$name', '$contact', '$payment_method', '$shipping_address', '$amount_payable', 'Pending')";
   mysqli_query($conn, $insert_query) or die('Query failed');

   // Clear the cart after successful checkout
   $delete_query = "DELETE FROM cart WHERE user_id = '$user_id'";
   mysqli_query($conn, $delete_query) or die('Query failed');

   // Redirect to confirmation page
   header('location:confirmation.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="checkout.css">

</head>
<body>

<?php include 'header1.php'; ?>

   <div class="checkout-form">
      <h2>Checkout Form</h2>
      <form method="POST" action="">
         <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
         </div>
         <div class="form-group">
            <label for="address">Complete Address:</label>
            <textarea id="address" name="shipping_address" required></textarea>
         </div>
         <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
         </div>
         <div class="form-group">
            <span>payment method</span>
            <select name="payment_method">
               <option value="Cash on Delivery" selected>Cash on Devlivery</option>
               <option value="Credit Card">credit card</option>
               <option value="Gcash">Gcash</option>
            </select>
         </div>
         <div class="form-group">
            <label for="grand_total">Amount Payable:</label>
            <input type="text" id="grand_total" value="₱<?php echo $grand_total; ?>" readonly>
         </div>
         <button type="submit" name="checkout" class="button">Checkout</button>
      </form>
   </div>

</body>
</html>
