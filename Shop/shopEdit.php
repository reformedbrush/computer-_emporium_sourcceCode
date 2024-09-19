<?php
include("../Assets/Connection/connection.php");
session_start();
$user="select * from tbl_shop where shop_id=".$_SESSION['sid'];
$res=$con->query($user);
$data=$res->fetch_assoc();
if(isset($_POST['update']))
{
  $name=$_POST['txt_name'];
  $address=$_POST['txt_address'];
  $email=$_POST['txt_email'];
  $number=$_POST['txt_number'];
  $upQry = "update tbl_shop set shop_name = '".$name."',shop_address='".$address."', shop_email='".$email."',shop_contact='".$number."' where shop_id = ".$_SESSION['sid'];
  if($con->query($upQry)) {
    echo "updated";
    }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value="<?php
        echo $data['shop_name']
      ?>" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_number"></label>
      <input type="text" name="txt_number" id="txt_number" value="<?php 
      echo $data['shop_contact']
      ?>" /></td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" value="<?php
      echo $data['shop_email']
      ?>"/></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txt_address"></label>
      <input type="text" name="txt_address"id="txt_address" value="<?php
      echo $data['shop_address']?>"/></td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="submit" name="update" id="update" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>
