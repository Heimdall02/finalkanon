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
   <title>Contact Us</title>

   <!-- Link to your CSS file -->
   <link rel="stylesheet" href="style3.css">
</head>
<body>
<?php include 'header1.php'; ?>

   <div class="container">
      <h1>Contact Us</h1>

      <?php
      // Check if the form is submitted
      if (isset($_POST['submit'])) {
         // Retrieve and sanitize form data
         $name = $_POST['name'];
         $email = $_POST['email'];
         $message = $_POST['message'];

         // Validate form data (you can add more validation if needed)
         if (empty($name) || empty($email) || empty($message)) {
            echo '<p class="error">Please fill in all fields.</p>';
         } else {
            // Insert form data into the database
            $insert_query = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
            // Execute the query
            // Replace 'your_connection' with your database connection object or function
            $result = mysqli_query($conn, $insert_query);
            
            if ($result) {
               echo '<p class="success">Thank you for your message. We will get back to you soon!</p>';
               // Clear form data after successful submission
               $name = $email = $message = '';
            } else {
               echo '<p class="error">Oops! Something went wrong. Please try again later.</p>';
            }
         }
      }
      ?>

      <div class="contact-form">
         <form method="POST" action="">
            <div class="form-group">
               <label for="name">Name:</label>
               <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
            </div>
            <div class="form-group">
               <label for="email">Email:</label>
               <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
            </div>
            <div class="form-group">
               <label for="message">Message:</label>
               <textarea id="message" name="message" required><?php echo isset($message) ? $message : ''; ?></textarea>
            </div>
            <button type="submit" name="submit" class="button">Submit</button>
         </form>
      </div>
      

   </div>


</body>
</html>
