<?php
include('../Assets/Connection/Connection.php');
session_start();
$user="select * from tbl_shop where shop_id=".$_SESSION['sid'];
$res=$con->query($user);
$data=$res->fetch_assoc();
if(isset($_POST["btn_submit"]))
{
$product=$_POST['txt_product'];
$description=$_POST['txt_description'];
$price=$_POST['txt_price'];
$category=$_POST['selCategory'];
$subCategory=$_POST['selsubCategory'];
$photo = $_FILES["file_photo"]["name"];
$path = $_FILES["file_photo"]["tmp_name"];
move_uploaded_file($path,"../Assets/Files/Product/".$photo);

$insQry="insert into tbl_product (product_name,product_desc,product_price,product_photo,subCategory_id,shop_id)values('".$product."','".$description."','".$price."','".$photo."','".$subCategory."','".$_SESSION['sid']."')";
if($con->query($insQry))
{
  echo "inserted";
}
}
  
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
        <td><label for="selCategory"></label>
        <select name="selCategory" id="selCategory" onchange="getplace(this.value)">
          <option>--Select--</option>
          <?php
        $selQry1="select * from tbl_category";
        $resultOne=$con->query($selQry1);
        while($data=$resultOne->fetch_assoc())
        {
      ?>
          <option value="<?php echo $data['category_id']; ?>">
            <?php echo $data['category_name']; ?>
          </option>
        <?php
        
        }
      ?>
      </select>
      </td>
      </tr>
      <tr>
        <td>Sub Catagory </td>
        <td>
          <label for="selsubCategory"></label>
          <select name="selsubCategory" id="selsubCategory" onchange="getplace(this.value)">
            <option>--Select--</option>
            <?php 
            $selQry1="select * from tbl_subCategory";
            $resultOne=$con->query($selQry1);
            while($data=$resultOne->fetch_assoc())
            {
              ?>
              <option value="<?php echo $data['subCategory_id']; ?>">
                <?php echo $data['subCategory_name']; ?>
            </option>
            <?php
            }
          ?>
          </select>
        </td>
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

  <a href="sellerProfile.php">Home</a>
   
</body>
</html>