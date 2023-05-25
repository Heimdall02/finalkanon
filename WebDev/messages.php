<?php

include 'config.php';
// Fetch orders from the database
$cont_query = mysqli_query($conn, "SELECT * FROM contacts") or die('Query failed');

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
   <h1>Messages From Customers</h1>
   <table>
      <thead>
         <tr>
            <th>Customer Name</th>
            <th>emial</th>
            <th>Message</th>
         </tr>
      </thead>
      <tbody>
         <?php
         if (mysqli_num_rows($cont_query) > 0) {
            while ($row = mysqli_fetch_assoc($cont_query)) {
               ?>
               <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['message']; ?></td>
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
