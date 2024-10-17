<?php
include("../Assets/Connection/connection.php");
session_start();
if(isset($_POST['btn_submit']))
{
    $qty=$_POST['txt_quantity'];
    $insqry="insert into tbl_stock(stock_qty,stock_date,product_id) values('".$qty."',curdate(),'".$_GET['asid']."')";
    if($con->query($insqry))
    {
        echo "<script>alert('Stock Added'); window.location = 'product.php';</script>";
    }
    

}


if (isset($_GET['did'])) 
{
    $delQry = "delete from tbl_stock where stock_id = '".$_GET['did']."'";
    if ($con->query($delQry)) 
    {
      header("location:product.php");
      exit();
    }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    <form action="" method="post">
        <table border="2" align="center">
            <tr>
                <td align="center">Product</td>
                <td align="center">Stock</td>
            </tr>
            <?php
            $sel="select * from tbl_product where product_id=".$_GET['asid'];
            $result=$con->query($sel);
            $data=$result->fetch_assoc();
            ?>
            <tr>
                <td><?php echo $data['product_name']  ?></td>
                <td><input type="number" name="txt_quantity" id="txt_quantity" placeholder="Enter Stock"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
    <table border="2">
        <tr>
            <td>Sl.No</td>
            <td>Stock</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
        <?php
        $i=0;
$sel="select * from tbl_stock where product_id=".$_GET['asid'];
$res=$con->query($sel);
while($data=$res->fetch_assoc())
{
    $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $data['stock_qty'] ?></td>
            <td><?php echo $data['stock_date'] ?></td>
            <td><a href="Stock.php?did=<?php echo $data['stock_id'];?>">Delete</td>
        </tr>
        <?php
}
?>
    </table>
</body>
</html>