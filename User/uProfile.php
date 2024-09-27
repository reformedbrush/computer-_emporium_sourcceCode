<?php
include("../Assets/Connection/connection.php");
session_start();
$user="select * from tbl_user where user_id=".$_SESSION['uid'];
$res=$con->query($user);
$data=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><?php
        echo $data['user_name']
      ?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><?php
        echo $data['user_number']
      ?></td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td><?php
        echo $data['user_email']
      ?></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><?php
        echo $data['user_address']
      ?></td>
    </tr>
    <tr>
      <td colspan="2">
      <a href="userEdit.php">Edit</a> 
      </td>
    </tr>
    <tr>
      <td><a href="userChangePass.php">Change Password</a>
</td>
</tr>
<tr><td><a href="MyBooking.php">My Orders</a></td></tr>

  </table>
</form>
<a href="SearchProduct.php">Search</a>
</body>
</html>