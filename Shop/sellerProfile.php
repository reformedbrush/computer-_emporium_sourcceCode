<?php
include("../Assets/Connection/connection.php");
session_start();
$user = "SELECT * FROM tbl_shop WHERE shop_id = " . $_SESSION['sid'];
$res = $con->query($user);
$data = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .profile-card {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="profile-card bg-light p-4">
      <h3 class="text-center">Shop Profile</h3>
      <table class="table table-borderless">
        <tr>
          <th scope="row">Name</th>
          <td><?php echo htmlspecialchars($data['shop_name']); ?></td>
        </tr>
        <tr>
          <th scope="row">Contact</th>
          <td><?php echo htmlspecialchars($data['shop_contact']); ?></td>
        </tr>
        <tr>
          <th scope="row">E-mail</th>
          <td><?php echo htmlspecialchars($data['shop_email']); ?></td>
        </tr>
        <tr>
          <th scope="row">Address</th>
          <td><?php echo htmlspecialchars($data['shop_address']); ?></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">
            <a href="shopEdit.php" class="btn btn-primary">Edit</a>
            <a href="shopChangePass.php" class="btn btn-secondary">Change Password</a>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">
            <a href="product.php" class="btn btn-success">Add Product</a>
          </td>
        </tr>
      </table>
    </div>
  </div>

  <div class="text-center mt-3">
            <a href="Homepage.php" class="btn btn-secondary">Home</a>
        </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
