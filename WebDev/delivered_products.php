<?php

include 'config.php';

$delivered_query = mysqli_query($conn, "SELECT * FROM delivered") or die('Query failed');

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>
   <link rel="stylesheet" href="admin.css">
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f4f4f4;
         margin: 0;
         padding: 0;
      }

      h1, h2 {
         text-align: center;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
      }

      th, td {
         padding: 10px;
         text-align: left;
         border-bottom: 1px solid #ddd;
      }

      th {
         background-color: #f5f5f5;
         font-weight: bold;
      }

      tr:hover {
         background-color: #f9f9f9;
      }

      td:last-child {
         text-align: center;
      }

      .no-orders {
         text-align: center;
         font-style: italic;
         color: #777;
         padding: 20px;
      }
   </style>
</head>
<body>
<?php include 'header.php'; ?>
   <h1>Orders</h1>
   <table>
      <thead>
         <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Order Date</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Payment Method</th>
            <th>Shipping Address</th>
            <th>Amount Payable</th>
            <th>Status</th>
         </tr>
      </thead>
      <tbody>
         <?php
         if (mysqli_num_rows($delivered_query) > 0) {
            while ($row = mysqli_fetch_assoc($delivered_query)) {
               ?>
               <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['user_id']; ?></td>
                  <td><?php echo $row['order_date']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['contact']; ?></td>
                  <td><?php echo $row['payment_method']; ?></td>
                  <td><?php echo $row['shipping_address']; ?></td>
                  <td><?php echo $row['amount_payable']; ?></td>
                  <td><?php echo $row['status']; ?></td>
               </tr>
               <?php
            }
         } else {
            echo '<tr><td colspan="10">No orders found.</td></tr>';
         }
         ?>
      </tbody>
   </table>
</body>
</html>
