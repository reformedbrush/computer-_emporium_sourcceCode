<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .custom-alert-box {
            z-index: 1;
            width: 300px;
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .alert {
            display: none;
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
        }

        .product-details {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .product-name {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .price {
            font-size: 1.5rem;
            color: #28a745;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn-buy {
            width: 100%;
            font-size: 1.2rem;
        }

        .details-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="custom-alert-box">
            <div class="alert alert-success success">Successfully Added to Cart!</div>
            <div class="alert alert-danger failure">Failed to Add to Cart!</div>
            <div class="alert alert-warning warning">Already Added to Cart!</div>
        </div>
        
        <h2 class="mb-4">Product Details</h2>
        
        <div class="row">
            <?php 
            $sel = "SELECT * FROM tbl_product p INNER JOIN tbl_shop s ON p.shop_id = s.shop_id WHERE product_id = " . $_GET['pid'];
            $res = $con->query($sel);
            while ($row = $res->fetch_assoc()) {
            ?>
            <div class="col-md-6">
                <img src="../Assets/Files/Product/<?php echo $row['product_photo']; ?>" alt="Product Image" class="img-fluid product-image"/>
            </div>
            <div class="col-md-6 product-details">
                <h3 class="product-name"><?php echo $row['product_name']; ?></h3>
                <p class="price">₹<?php echo number_format($row['product_price'], 2); ?></p>
                <p><?php echo $row['product_desc']; ?></p>
                <div class="details-section">
                    <p><strong>Seller:</strong> <?php echo $row['shop_name']; ?></p>
                    <p><strong>Contact:</strong> <?php echo $row['shop_contact']; ?></p>
                </div>
                <button type="button" class="btn btn-primary btn-buy" onclick="addCart('<?php echo $row['product_id']; ?>')">Add to Cart</button>
            </div>
            
            <?php 
            } 
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function addCart(id) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxAddCart.php?id=" + id,
                success: function(response) {
                    if (response.trim() === "Added to Cart") {
                        $(".alert.success").fadeIn(300).delay(1500).fadeOut(400);
                    } else if (response.trim() === "Already Added to Cart") {
                        $(".alert.warning").fadeIn(300).delay(1500).fadeOut(400);
                    } else {
                        $(".alert.failure").fadeIn(300).delay(1500).fadeOut(400);
                    }
                }
            });
        }
    </script>
</body>
<?php
include("Foot.php");
ob_flush();
?>
</html>
