<?php

session_start();
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Booking</title>
<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }
  table, th, td {
    border: 1px solid black;
  }
  th, td {
    padding: 8px;
    text-align: left;
  }
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table>
    <tr>
      <th>Sl.No</th>
      <th>Product</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Seller</th>
      <th>Contact</th>
      <th>Photo</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    <?php
    $selQry="select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id inner join tbl_shop s on s.shop_id=p.shop_id where user_id=".$_SESSION['uid'];
      $result = $con->query($selQry);
      $i = 0;
      while ($rowpr = $result->fetch_assoc()) { $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $rowpr["product_name"] ?></td>
      <td><?php echo $rowpr["product_price"] ?></td>
      <td><?php echo $rowpr["cart_qty"] ?></td>
      <td><?php echo $rowpr["shop_name"] ?></td>
      <td><?php echo $rowpr["shop_address"] ?></td>
      <td><img src="../Assets/Files/Product/<?php echo $rowpr["product_photo"] ?>" width="200px"/></td>
      <td><?php 
      if($rowpr["booking_status"]==2 && $rowpr["cart_status"]==1){
        echo "Order Placed";
      }
      else if($rowpr["cart_status"]==2){
        echo "Item Packed";
      }
      else if($rowpr["cart_status"]==3){
        echo "Item Delivered<br>";
        echo "Tracking ID: ".$rowpr['tracking_id'];
      }
      ?></td>
      <td>
        <?php
      if($rowpr["cart_status"]==3){
        ?>
        <a href="PostComplaint.php?pid=<?php echo $rowpr['product_id'] ?>">Report</a><br>
        <a href="Rating.php?pid=<?php echo $rowpr['product_id'] ?>">Rate Now</a>
        <?php
      }
      ?>
      </td>
    </tr>
    <?php } ?>
  </table>
</form>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>