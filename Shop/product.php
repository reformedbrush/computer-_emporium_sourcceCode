<?php
include('../Assets/Connection/Connection.php');
session_start();
$user="select * from tbl_shop where shop_id=".$_SESSION['sid'];
$res=$con->query($user);
$data=$res->fetch_assoc();
if(isset($_POST["btn_submit"]))
{
$product=$_POST['txt_product'];
$description=$_POST['txt_description'];
$price=$_POST['txt_price'];
$category=$_POST['selCategory'];
$subCategory=$_POST['selsubCategory'];
$photo = $_FILES["file_photo"]["name"];
$path = $_FILES["file_photo"]["tmp_name"];
move_uploaded_file($path,"../Assets/Files/Product/".$photo);



$insQry="insert into tbl_product (product_name,product_desc,product_price,product_photo,subCategory_id,shop_id)values('".$product."','".$description."','".$price."','".$photo."','".$subCategory."','".$_SESSION['sid']."')";
if($con->query($insQry))
{
  echo "inserted";
}
}
if (isset($_GET['pid'])) {
  $pid = $_GET['pid'];
  $delQry = "delete from tbl_product where product_id = " . $pid;
  if ($con->query($delQry)) {
    header("location:product.php");
    exit();
  }
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
            color: #343a40;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        table img {
            width: 100px;
            height: auto;
        }
        .action-links a {
            margin-right: 10px;
        }
        .form-control, .form-select {
            margin-bottom: 15px;
        }
        .table-bordered {
            border: 2px solid #343a40; /* Darker border color for better visibility */
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #343a40; /* Ensure each cell has a solid border */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form name="form1" method="post" action="" enctype="multipart/form-data">
                <h1>Product Page</h1>

                <div class="mb-3">
                    <label for="txt_product" class="form-label">Product</label>
                    <input type="text" class="form-control" name="txt_product" id="txt_product" required>
                </div>

                <div class="mb-3">
                    <label for="txt_description" class="form-label">Description</label>
                    <textarea class="form-control" name="txt_description" id="txt_description" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="selCategory" class="form-label">Category</label>
                    <select class="form-select" name="selCategory" id="selCategory" onchange="getSubCat(this.value)">
                        <option value="">--Select--</option>
                        <?php
                        $selQry1="select * from tbl_category";
                        $resultOne=$con->query($selQry1);
                        while($data=$resultOne->fetch_assoc())
                        {
                            echo "<option value='".$data['category_id']."'>".$data['category_name']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="selsubCategory" class="form-label">Sub Category</label>
                    <select class="form-select" name="selsubCategory" id="selsubCategory">
                        <option value="">--Select--</option>
                        
                    </select>
                </div>

                <div class="mb-3">
                    <label for="txt_price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="txt_price" id="txt_price" required>
                </div>

                <div class="mb-3">
                    <label for="file_photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" name="file_photo" id="file_photo" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                </div>
            </form>
        </div>

        <table class="table table-bordered mt-5">
            <thead class="table-dark">
                <tr>
                    <th>SL NO</th>
                    <th>PRODUCT</th>
                    <th>PRICE</th>
                    <th>PHOTO</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry = "select * from tbl_product";
                $result = $con->query($selQry);
                $i = 0;
                while($row = $result->fetch_assoc()) { 
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["product_name"]; ?></td>
                        <td><?php echo $row["product_price"]; ?></td>
                        <td><img src="../Assets/Files/Product/<?php echo $row["product_photo"]; ?>" class="img-thumbnail" alt="Product Image"></td>
                        <td class="action-links">
                            <a href="product.php?pid=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            <!-- <a href="product.php?eid=<?php echo $row['product_id']; ?>" class="btn btn-primary btn-sm">Edit</a> -->
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        
        <div class="text-center mt-3">
            <a href="Homepage.php" class="btn btn-secondary">Home</a>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<script src="../Assets/JQ/JQuery.js"></script>


  <!-- AJAX Script for Dynamic Place Dropdown -->
  <script>
    function getSubCat(did) {
      $.ajax({
        url: "../Assets/AjaxPages/AjaxSubCategory.php?did=" + did,
        success: function (result) {
          $("#selsubCategory").html(result);
        }
      });
    }
  </script>