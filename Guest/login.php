<?php
    include("../Assets/connection/connection.php");
    session_start();
    
    // Server-side validation for email and password format
    $error = "";

    if(isset($_POST["Login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        } 

        // Validate password (minimum 8 characters, 1 uppercase, 1 lowercase, 1 number)
        elseif (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $password)) {
            $error = "Password must contain at least 8 characters, including an uppercase letter, a lowercase letter, and a number.";
        } else {
            // If validation is successful, proceed with login queries
            $admin = "SELECT * FROM tbl_admin WHERE admin_email=? AND admin_password=?";
            $user = "SELECT * FROM tbl_user WHERE user_email=? AND user_password=?";
            $seller = "SELECT * FROM tbl_shop WHERE shop_email=? AND shop_password=?";
            
            // Prepared statements for security
            $stmt = $con->prepare($admin);
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $resAdmin = $stmt->get_result();

            $stmt = $con->prepare($user);
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $resUser = $stmt->get_result();

            $stmt = $con->prepare($seller);
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $resSeller = $stmt->get_result();

            // Admin login
            if ($data = $resAdmin->fetch_assoc()) {
                $_SESSION['aid'] = $data['admin_id'];
                $_SESSION['aname'] = $data['admin_name'];
                header("location:../Admin/aprofile.php");    
            }
            // User login
            elseif ($data1 = $resUser->fetch_assoc()) {
                $_SESSION['uid'] = $data1['user_id'];
                $_SESSION['uname'] = $data1['user_name'];
                header("location:../User/uProfile.php");
            }
            // Seller login
            elseif ($data2 = $resSeller->fetch_assoc()) {
                if ($data2['shop_status'] == 0) {
                    echo "<script>alert('Not verified');</script>";
                } elseif ($data2['shop_status'] == 1) {
                    $_SESSION['sid'] = $data2['shop_id'];
                    $_SESSION['sname'] = $data2['shop_name'];
                    header("location:../Shop/sellerProfile.php");    
                } else {
                    echo "<script>alert('Rejected');</script>";
                }
            } else {
                $error = "Invalid credentials!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
</head>
<body>
    <h1 align="center">LOGIN</h1>
    <form name="form1" method="post" action="">
        <table width="200" border="1" align="center">
            <tr>
                <td>E-mail</td>
                <td>
                    <input type="email" name="email" id="email" required title="Enter a valid email" />
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" id="password" 
                        required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                        title="Must contain at least 8 characters, including one uppercase letter, one lowercase letter, and one number" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="Submit" name="Login" id="Login" value="Login">
                    </div>
                </td>
            </tr>
        </table>
        <!-- Display server-side error messages -->
        <?php if($error != ""): ?>
            <p style="color:red; text-align:center;"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
