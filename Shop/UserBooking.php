<?php
session_start();
include("../Assets/Connection/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .booking-table {
            margin-top: 20px;
        }
        .table-container {
            max-width: 1000px;
            margin: auto;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5 table-container">
        <h3 class="text-center mb-4">My Bookings</h3>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered table-striped booking-table">
                <thead class="table-dark">
                    <tr>
                        <th>Sl.No</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Total</th>
                        <th>Tracking Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selQry = "SELECT * FROM tbl_booking b 
                               INNER JOIN tbl_cart c ON c.booking_id = b.booking_id 
                               INNER JOIN tbl_product p ON p.product_id = c.product_id 
                               INNER JOIN tbl_user u ON u.user_id = b.user_id 
                               WHERE booking_status > 1 AND shop_id = " . $_SESSION['sid'] . " 
                               GROUP BY b.booking_id";
                    $result = $con->query($selQry);
                    $i = 0;
                    while ($rowpr = $result->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($rowpr["user_name"]); ?></td>
                        <td><?php echo htmlspecialchars($rowpr["user_address"]); ?></td>
                        <td><?php echo htmlspecialchars($rowpr["user_number"]); ?></td>
                        <td><?php echo htmlspecialchars($rowpr["booking_amount"]); ?></td>
                        <td><?php echo htmlspecialchars($rowpr["tracking_id"]); ?></td>
                        <td>
                            <a href="ViewBooking.php?bid=<?php echo $rowpr['booking_id']; ?>" class="btn btn-info btn-sm">View Products</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>

    <div class="text-center mt-3">
            <a href="Homepage.php" class="btn btn-secondary">Home</a>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
