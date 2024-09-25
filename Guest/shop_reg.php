<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$password=$_POST['txt_password'];
  $place=$_POST['sel_place'];
  $address=$_POST['txt_address'];
  $contact=$_POST['txt_contact'];
  $district=$_POST['sel_district'];
	/* $place=$_POST['sel_place'];
	$photo=$_FILES["file_photo"]["name"];
	$temp=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($temp,"../Assets/Files/Shop/".$photo); 
	 */
	$insQry="insert into tbl_shop(shop_name,shop_email,shop_password,shop_address,place_id,shop_contact,district_id) values('".$name."','".$email."','".$password."','".$address."','".$place."','".$contact."','".$district."')";
	if($con->query($insQry))
	{
		echo "inserted";
	}
	
}
/* if(isset($_GET['did'])) {
  $did = $_GET['did'];
  $delQry="delete from tbl_user where user_id = ".$did;
  if($con->query($delQry)) {
    header("location:user_reg.php");
    exit();
  }
} */

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Registration</title>
  <style>
    body{
      text-align:center;
    }

    </style>
</head>
<body>
  <h1>Shop Registration </h1><br><br>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="200" border="1" align="center">
  <tr>
    <td>Name</td>
    <td>
      <label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" />
    </td>
  </tr>
  <tr>
    <td>E-mail</td>
    <td>
      <label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" />
    </td>
  </tr>
  <tr>
    <td>Password</td>
    <td>
      <label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" />
    </td>
  </tr>
  <tr>
    <td>Address</td>
    <td>
      <label for="txt_address"></label>
      <input type="text" name="txt_address" id="txt_id">
  </td>
     </td>
  </tr>
  <tr> 
    <td>District</td>
    <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onchange="getplace(this.value)">
        <option>--Select--</option>
        <?php
			$selQry1="select * from tbl_district";
			$resultOne=$con->query($selQry1);
			while($data=$resultOne->fetch_assoc())
			{
		?>
        <option value="<?php echo $data['district_id']; ?>">
        <?php echo $data['district_name']; ?>
        </option>
        <?php
			}
		?>
      </select></td>
  </tr>
  <tr>
      <td>Place</td>
      <td><label for="sel_place"></label>
        <select name="sel_place" id="sel_place" onchange="getplace(this.value)">
          <option>--Select--</option>
          <?php 
          $selQry1="select * from tbl_place";
          $resultOne=$con->query($selQry1);
          while($data=$resultOne->fetch_assoc())
          {
            ?>
            <option value="<?php echo $data['place_id']; ?>">
              <?php echo $data['place_name']; ?>
          </option>
              <?php
          }
        ?>
      </select></td>
    </tr>
  <tr>
    <td>Contact No.</td>
    <td>
      <label for="txt_address"></label>
      <input type="text" name="txt_contact" id="txt_id">
    </td>
  <tr>
    <td colspan="2">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="cancel" id="cancel" value="Cancel" />
    </td>
    </tr>
</form>
</body>
</html>
