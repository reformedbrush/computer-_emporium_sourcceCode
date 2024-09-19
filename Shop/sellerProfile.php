<?php
include("../Assets/Connection/connection.php");
session_start();
$user="select * from tbl_shop where shop_id=".$_SESSION['sid'];
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
        echo $data['shop_name']
      ?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><?php
        echo $data['shop_contact']
      ?></td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td><?php
        echo $data['shop_email']
      ?></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><?php
        echo $data['shop_address']
      ?></td>
    </tr>
    <tr>
      <td colspan="2">
      <a href="shopEdit.php">Edit</a> 
      <a href="shopChangePass.php">Change Password</a>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <a href="product.php">ADD PRODUCT </a></td>
    </tr>
  </table>
</form>
</body>
</html>