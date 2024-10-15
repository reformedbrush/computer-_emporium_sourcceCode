<?php
include("../Assets/Connection/connection.php");
session_start();
$user = "SELECT * FROM tbl_shop WHERE shop_id = " . $_SESSION['sid'];
$res = $con->query($user);
$data = $res->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['txt_name'];
    $address = $_POST['txt_address'];
    $email = $_POST['txt_email'];
    $number = $_POST['txt_number'];
    $upQry = "UPDATE tbl_shop SET shop_name = '" . $con->real_escape_string($name) . "', shop_address = '" . $con->real_escape_string($address) . "', shop_email = '" . $con->real_escape_string($email) . "', shop_contact = '" . $con->real_escape_string($number) . "' WHERE shop_id = " . $_SESSION['sid'];
    if ($con->query($upQry)) {
        echo "<script>alert('Shop information updated successfully.'); window.location='SellerProfile.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shop Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .edit-form {
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
        <div class="edit-form bg-light p-4">
            <h3 class="text-center">Edit Shop Profile</h3>
            <form id="form1" name="form1" method="post" action="">
                <div class="mb-3">
                    <label for="txt_name" class="form-label">Name</label>
                    <input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo htmlspecialchars($data['shop_name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="txt_number" class="form-label">Contact</label>
                    <input type="text" name="txt_number" id="txt_number" class="form-control" value="<?php echo htmlspecialchars($data['shop_contact']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="txt_email" class="form-label">E-mail</label>
                    <input type="email" name="txt_email" id="txt_email" class="form-control" value="<?php echo htmlspecialchars($data['shop_email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="txt_address" class="form-label">Address</label>
                    <input type="text" name="txt_address" id="txt_address" class="form-control" value="<?php echo htmlspecialchars($data['shop_address']); ?>" required>
                </div>
                <div class="text-center">
                    <input type="submit" name="update" id="update" class="btn btn-primary" value="Submit">
                    <a href="shopProfile.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center mt-3">
            <a href="sellerProfile.php" class="btn btn-secondary">Return</a>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
