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
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 120vh;
    }
    .registration-form {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }
    .registration-form h1 {
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: bold;
      text-align: center;
    }
    .btn-custom {
      background-color: #007bff;
      color: white;
    }
    .btn-custom:hover {
      background-color: #0056b3;
    }
    .form-group{
      max-width:500px;
    }
  </style>
</head>

<body>
  <div class="registration-form">
    <h1>User Registration</h1>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <div class="form-group">
        <label for="txt_name">Name</label>
        <input 
          type="text" 
          class="form-control" 
          name="txt_name" 
          id="txt_name" 
          required 
          pattern="^[A-Z]+[a-zA-Z ]*$" 
          title="Name allows only alphabets and spaces, and the first letter must be uppercase" 
        />
      </div>

      <div class="form-group">
        <label for="txt_email">Email</label>
        <input 
          type="email" 
          class="form-control" 
          name="txt_email" 
          id="txt_email" 
          required 
          title="Please enter a valid email address"
          pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
        />
      </div>

      <div class="form-group">
        <label for="txt_password">Password</label>
        <input 
          type="password" 
          class="form-control" 
          name="txt_password" 
          id="txt_password" 
          required 
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
          title="Password must contain at least one number, one uppercase and lowercase letter, and be at least 8 characters long" 
        />
      </div>

      <div class="form-group">
        <label for="txt_address">Address</label>
        <input 
          type="text" 
          class="form-control" 
          name="txt_address" 
          id="txt_address" 
          required 
        />
      </div>

      <div class="form-group">
        <label for="txt_number">Contact Number</label>
        <input 
          type="text" 
          class="form-control" 
          name="txt_number" 
          id="txt_number" 
          required 
          pattern="[7-9]{1}[0-9]{9}" 
          title="Phone number must start with 7, 8, or 9 and be exactly 10 digits long" 
        />
      </div>

      <div class="form-group">
        <label for="sel_district">District</label>
        <select class="form-control" name="sel_district" id="sel_district" required onchange="getPlace(this.value)">
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
      </div>

      <div class="form-group">
        <label for="sel_place">Place</label>
        <select class="form-control" name="sel_place" id="sel_place" required>
          <option value="">--Select--</option>
        </select>
      </div>

      <div class="form-group text-center">
        <button type="submit" class="btn btn-custom" name="btn_submit" id="btn_submit">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
      </div>
    </form>
  </div>

  <!-- jQuery and Bootstrap JS -->
   <script src="../Assets/JQ/JQuery.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- AJAX Script for Dynamic Place Dropdown -->
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