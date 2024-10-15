<?php
include("../Assets/Connection/connection.php");
session_start();
$message = "";

if (isset($_POST["btn_submit"])) {
    $currentpwd = $_POST["txtcurrent"];
    $newpwd = $_POST["txtnew"];
    $confirmpwd = $_POST["txtconfirm"];

    $selQuery = "SELECT * FROM tbl_shop WHERE shop_password = '" . $con->real_escape_string($currentpwd) . "' AND shop_id = '" . $_SESSION["sid"] . "'";
    $result = $con->query($selQuery);

    if ($data = $result->fetch_assoc()) {
        if ($newpwd == $confirmpwd) {
            $upQry = "UPDATE tbl_shop SET shop_password = '" . $con->real_escape_string($newpwd) . "' WHERE shop_id = '" . $_SESSION["sid"] . "'";
            if ($con->query($upQry)) {
                $message = "Password Updated";
            }
        } else {
            $message = "New Password and Confirm Password do not match";
        }
    } else {
        $message = "Incorrect current password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .change-password-form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="change-password-form bg-light p-4">
            <h3 class="text-center">Change Password</h3>
            <form id="form1" name="form1" method="post" action="">
                <div class="mb-3">
                    <label for="txtcurrent" class="form-label">Current Password</label>
                    <input type="password" name="txtcurrent" id="txtcurrent" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="txtnew" class="form-label">New Password</label>
                    <input type="password" name="txtnew" id="txtnew" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="txtconfirm" class="form-label">Confirm Password</label>
                    <input type="password" name="txtconfirm" id="txtconfirm" class="form-control" required>
                </div>
                <div class="text-center">
                    <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Update">
                </div>
                <?php if (!empty($message)): ?>
                    <div class="alert alert-info mt-3" role="alert">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="text-center mt-3">
            <a href="sellerProfile.php" class="btn btn-secondary">Return</a>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
