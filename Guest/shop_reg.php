<?php
include("../Assets/Connection/Connection.php");
if (isset($_POST["btn_submit"])) {
  $name = $_POST['txt_name'];
  $email = $_POST['txt_email'];
  $password = $_POST['txt_password'];
  $place = $_POST['sel_place'];
  $address = $_POST['txt_address'];
  $contact = $_POST['txt_contact'];
  
  $proof=$_FILES['filephoto']['name'];
  $temp=$_FILES['filephoto']['tmp_name'];
  move_uploaded_file($temp,'../Assets/Files/Shop/'.$proof);


  $insQry = "insert into tbl_shop(shop_name, shop_email, shop_password, shop_address, place_id, shop_contact,shop_proof) 
             values('".$name."','".$email."','".$password."','".$address."','".$place."','".$contact."','".$proof."')";
  
  if ($con->query($insQry)) {
    ?>
    <script>
      alert('Inserted..');
      window.location="login.php";
    </script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Registration</title>
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
  </style>
</head>
<body>
  <div class="registration-form">
    <h1>Shop Registration</h1>
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
          title="Enter a valid email address" 
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
          title="Password must contain at least one number, one uppercase letter, one lowercase letter, and must be at least 8 characters long" 
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

      <div class="form-group">
        <label for="txt_contact">Contact No.</label>
        <input 
          type="text" 
          class="form-control" 
          name="txt_contact" 
          id="txt_contact" 
          required 
          pattern="[7-9]{1}[0-9]{9}" 
          title="Phone number must start with 7, 8, or 9 and be exactly 10 digits" 
        />
      </div>
      <div class="form-group">
        <label for="">Proof</label>
        <input type="file" name="filephoto" id="filephoto">
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
