<?php
include("../Assets/Connection/Connection.php");

if (isset($_POST["btn_submit"])) {
  $name = $_POST['txt_name'];
  $email = $_POST['txt_email'];
  $password = $_POST['txt_password'];
  $place = $_POST['sel_place'];
  $address = $_POST['txt_address'];
  $contact = $_POST['txt_number'];
  
  $insQry = "insert into tbl_user(user_name,user_email,user_password,place_id,user_address,user_number) values('".$name."','".$email."','".$password."','".$place."','".$address."','".$contact."')";
  
  if ($con->query($insQry)) {
    echo "Inserted successfully!";
  }
}

if (isset($_GET['did'])) {
  $did = $_GET['did'];
  $delQry = "delete from tbl_user where user_id = ".$did;
  if ($con->query($delQry)) {
    header("location:user_reg.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
</head>

<body>
<h1 align="center">USER REGISTRATION</h1>

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="200" border="1" align="center">
    <!-- Name Field with Validation -->
    <tr>
      <td>Name</td>
      <td>
        <input 
          type="text" 
          name="txt_name" 
          id="txt_name" 
          required 
          pattern="^[A-Z]+[a-zA-Z ]*$" 
          title="Name allows only alphabets and spaces, and the first letter must be uppercase" 
        />
      </td>
    </tr>

    <!-- Email Field with Validation -->
    <tr>
      <td>Email</td>
      <td>
        <input 
          type="email" 
          name="txt_email" 
          id="txt_email" 
          required 
          title="Please enter a valid email address" 
        />
      </td>
    </tr>

    <!-- Password Field with Validation -->
    <tr>
      <td>Password</td>
      <td>
        <input 
          type="password" 
          name="txt_password" 
          id="txt_password" 
          required 
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
          title="Password must contain at least one number, one uppercase and lowercase letter, and be at least 8 characters long" 
        />
      </td>
    </tr>

    <!-- Address Field (Required) -->
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

    <!-- Contact Number Field with Validation -->
    <tr>
      <td>Number</td>
      <td>
        <input 
          type="text" 
          name="txt_number" 
          id="txt_number" 
          required 
          pattern="[7-9]{1}[0-9]{9}" 
          title="Phone number must start with 7, 8, or 9 and be exactly 10 digits long" 
        />
      </td>
    </tr>

    <!-- District Field (Required) -->
    <tr>
      <td>District</td>
      <td>
        <select name="sel_district" id="sel_district" required onchange="getPlace(this.value)">
          <option value="">--Select--</option>
          <?php
            $selQry1 = "select * from tbl_district";
            $resultOne = $con->query($selQry1);
            while ($data = $resultOne->fetch_assoc()) {
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

    <!-- Place Field (Required) -->
    <tr>
      <td>Place</td>
      <td>
        <select name="sel_place" id="sel_place" required>
          <option value="">--Select--</option>
          <?php
            $selQry1 = "select * from tbl_place";
            $resultOne = $con->query($selQry1);
            while ($data = $resultOne->fetch_assoc()) {
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

    <!-- Submit and Cancel Buttons -->
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </td>
    </tr>
  </table>
</form>

<!-- AJAX Script for Dynamic Place Dropdown -->
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {
        $("#sel_place").html(result);
      }
    });
  }
</script>

</body>
</html>
