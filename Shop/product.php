<?php
include('../Assets/Connection/Connection.php');

$photo = $_FILES["file_photo"]["name"];
$path = $_FILES["file_photo"]["tmp_name"];
move_uploaded_file($path,"../Assets/Files/Product/".$photo);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product page</title>
    <style>
        body{
            text-align:center;
        }
        </style>
</head>
<body>
    <form name="form1" method="post" action="" enctype="multipart/form-data">
     <h1>Product Page</h1><br><br>

<table width="200" border="1" align="center">
      <tr>
        <td>Product</td>
        <td>
          <input type="text" name="txt_product" id="txt_product">
       </td>
      </tr>
      <tr>
        <td>Description</td>
        <td>
          <label for="txt_description"></label>
          <textarea name="txt_description" id="txt_description"></textarea>
        </td>
      </tr>
      <tr>
        <td>Catagory</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Sub Catagory </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Price</td>
        <td>
          <label for="txt_price"></label>
          <input type="text" name="txt_price" id="txt_price">
        </td>
      </tr>
      <tr>
        <td>Photo</td>
        <td>
          <label for="file_photo"></label>
          <input type="file" name="file_photo" id="file_photo">
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
       </td>
      </tr>
</table>
    </form>
   
</body>
</html>