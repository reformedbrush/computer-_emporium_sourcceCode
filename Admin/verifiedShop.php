<?php
include('../Assets/Connection/Connection.php');



if(isset($_GET["rid"]))
{
    $up = "update tbl_shop set shop_status=2 where shop_id=".$_GET["rid"];
    if($con->query($up))
    {
        echo "<script>
            alert('Shop Verified')
            window.location='verifiedShop.php'
        </script>";
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Verification</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table {
            margin-top: 20px;
        }

        th {
            background-color: #dc3545; /* Red background for reject action */
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .action-links a {
            margin-right: 10px;
        }

        .alert-message {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Verified Stores</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Proof</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $shop = "SELECT * FROM tbl_shop WHERE shop_status=1";
                $res = $con->query($shop);
                while ($data = $res->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $data['shop_id']; ?></td>
                        <td><?php echo $data['shop_name']; ?></td>
                        <td><?php echo $data['shop_address']; ?></td>
                        <td><?php echo $data['shop_contact']; ?></td>
                        <td><a href="../Assets/Files/Shop/<?php echo $data['shop_proof']; ?>" target="_blank" rel="noopener noreferrer">Proof</a></td>
                        <td class="action-links">
                            <a href="NewShop.php?rid=<?php echo $data['shop_id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <a href="Homepage.php" class="btn btn-primary mt-3">Home</a>
        <a href="NewShop.php" class="btn btn-primary mt-3">New Request</a>
        <a href="rejectedShop.php" class="btn btn-primary mt-3">Rejected Request</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>