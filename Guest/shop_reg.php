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

  $insQry = "insert into tbl_shop(shop_name,shop_email,shop_password,shop_address,place_id,shop_contact,district_id) 
             values('".$name."','".$email."','".$password."','".$address."','".$place."','".$contact."','".$district."')";
  
  if($con->query($insQry)) {
    echo "inserted";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Registration</title>
  <style>
    body {
      text-align: center;
    }
  </style>
</head>
<body>
  <h1>Shop Registration</h1><br><br>

  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table width="200" border="1" align="center">
      <!-- Name Field -->
      <tr>
        <td>Name</td>
        <td>
          <input 
            type="text" 
            name="txt_name" 
            id="txt_name" 
            required 
            title="Name allows only alphabets and spaces, and the first letter must be uppercase" 
            pattern="^[A-Z]+[a-zA-Z ]*$" 
          />
        </td>
      </tr>

      <!-- Email Field -->
      <tr>
        <td>E-mail</td>
        <td>
          <input 
            type="email" 
            name="txt_email" 
            id="txt_email" 
            required 
            title="Enter a valid email address" 
          />
        </td>
      </tr>

      <!-- Password Field -->
      <tr>
        <td>Password</td>
        <td>
          <input 
            type="password" 
            name="txt_password" 
            id="txt_password" 
            required 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="Password must contain at least one number, one uppercase letter, one lowercase letter, and must be at least 8 characters long" 
          />
        </td>
      </tr>

      <!-- Address Field -->
      <tr>
        <td>Address</td>
        <td>
          <input 
            type="text" 
            name="txt_address" 
            id="txt_address" 
            required 
          />
        </td>
      </tr>

      <!-- District Field -->
      <tr>
        <td>District</td>
        <td>
          <select name="sel_district" id="sel_district" required onchange="getplace(this.value)">
            <option value="">--Select--</option>
            <?php
              $selQry1="select * from tbl_district";
              $resultOne=$con->query($selQry1);
              while($data=$resultOne->fetch_assoc()) {
            ?>
            <option value="<?php echo $data['district_id']; ?>">
              <?php echo $data['district_name']; ?>
            </option>
            <?php
              }
            ?>
          </select>
        </td>
      </tr>

      <!-- Place Field -->
      <tr>
        <td>Place</td>
        <td>
          <select name="sel_place" id="sel_place" required>
            <option value="">--Select--</option>
            <?php 
              $selQry1 = "select * from tbl_place";
              $resultOne = $con->query($selQry1);
              while($data = $resultOne->fetch_assoc()) {
            ?>
            <option value="<?php echo $data['place_id']; ?>">
              <?php echo $data['place_name']; ?>
            </option>
            <?php
              }
            ?>
          </select>
        </td>
      </tr>

      <!-- Contact Field -->
      <tr>
        <td>Contact No.</td>
        <td>
          <input 
            type="text" 
            name="txt_contact" 
            id="txt_contact" 
            required 
            pattern="[7-9]{1}[0-9]{9}" 
            title="Phone number must start with 7, 8, or 9 and be exactly 10 digits" 
          />
        </td>
      </tr>

      <!-- Submit and Cancel Buttons -->
      <tr>
        <td colspan="2">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          <input type="submit" name="cancel" id="cancel" value="Cancel" />
        </td>
      </tr>
    </table>
  </form>
</body>
</html>
