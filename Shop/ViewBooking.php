<?php
session_start();
include("../Assets/Connection/connection.php");

if (isset($_GET['cid'])) {
    $qry = "UPDATE tbl_cart SET cart_status = 2 WHERE cart_id = " . $_GET['cid'];
    if ($con->query($qry)) {
        ?>
        <script>
            alert("Item Packed.");
            window.location = "ViewBooking.php?bid=<?php echo $_GET['bid']; ?>";
        </script>
        <?php
    }
}

if (isset($_POST['btn_submit'])) {
    $sel = "SELECT * FROM tbl_booking b 
            INNER JOIN tbl_cart c ON c.booking_id = b.booking_id 
            INNER JOIN tbl_product p ON p.product_id = c.product_id 
            WHERE b.booking_id = " . $_POST['txt_id'] . " AND shop_id = " . $_SESSION['sid'];
    $res = $con->query($sel);
    while ($data = $res->fetch_assoc()) {
        $qry = "UPDATE tbl_cart SET cart_status = 3, tracking_id = '" . $_POST['txt_track'] . "' WHERE cart_id = " . $data['cart_id'];
        $con->query($qry);
    }
    ?>
    <script>
        alert("Tracking ID Submitted.");
        window.location = "ViewBooking.php?bid=<?php echo $_GET['bid']; ?>";
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            max-width: 1000px;
            margin: 20px auto;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
        }
        .product-image {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <h3 class="text-center mb-4">Booking Details</h3>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Sl.No</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selQry = "SELECT * FROM tbl_booking b 
                               INNER JOIN tbl_cart c ON c.booking_id = b.booking_id 
                               INNER JOIN tbl_product p ON p.product_id = c.product_id 
                               WHERE c.booking_id = " . $_GET['bid'];
                    $result = $con->query($selQry);
                    $i = 0;
                    $j = 0;
                    while ($rowpr = $result->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($rowpr["product_name"]); ?></td>
                        <td><?php echo htmlspecialchars($rowpr["product_price"]); ?></td>
                        <td><?php echo htmlspecialchars($rowpr["cart_qty"]); ?></td>
                        <td><?php echo htmlspecialchars($rowpr["cart_qty"] * $rowpr["product_price"]); ?></td>
                        <td><img src="../Assets/Files/Product/<?php echo $rowpr["product_photo"]; ?>" class="product-image" alt="Product Image"></td>
                        <td>
                            <?php 
                            if ($rowpr["booking_status"] == 2 && $rowpr["cart_status"] == 1) {
                                echo "Order Placed";
                            } else if ($rowpr["cart_status"] == 2) {
                                echo "Item Packed";
                                $j++;
                            } else if ($rowpr["cart_status"] == 3) {
                                echo "Item Delivered";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($rowpr["booking_status"] == 2 && $rowpr["cart_status"] == 1) {
                            ?>
                            <a href="ViewBooking.php?cid=<?php echo $rowpr['cart_id']; ?>&bid=<?php echo $rowpr['booking_id']; ?>" class="btn btn-primary btn-sm">Item Packed</a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    } ?>
                    <?php
                    if ($i == $j) { ?>
                    <tr>
                        <td colspan="8">
                            <div class="input-group">
                                <input type="text" name="txt_track" class="form-control" placeholder="Enter Tracking Number here" required>
                                <input type="hidden" name="txt_id" value="<?php echo $_GET['bid']; ?>">
                                <button type="submit" class="btn btn-success" name="btn_submit">Submit</button>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <div class="text-center mt-3">
            <a href="UserBooking.php" class="btn btn-secondary">Return</a>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
