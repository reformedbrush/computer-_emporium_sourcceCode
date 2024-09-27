<?php

session_start();
include("../Assets/Connection/Connection.php");

if(isset($_GET['cid'])){
  $qry="update tbl_cart set cart_status=2 where cart_id=".$_GET['cid'];
  if($con->query($qry)){
    ?>
    <script>
      alert("Item Packed.")
      window.location="ViewBooking.php?bid=<?php echo $_GET['bid'] ?>"
    </script>
    <?php
  }
}

if(isset($_POST['btn_submit'])){
  $sel="select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id where b.booking_id=".$_POST['txt_id']." and shop_id=".$_SESSION['sid'];
  $res=$con->query($sel);
  while($data=$res->fetch_assoc()){
  $qry="update tbl_cart set cart_status=3, tracking_id='".$_POST['txt_track']."' where cart_id=".$data['cart_id'];
  $con->query($qry);
  }
  ?>
    <script>
      alert("Tracking ID Submitted.")
      window.location="ViewBooking.php?bid=<?php echo $_GET['bid'] ?>"
    </script>
    <?php
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Booking</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
    <td>Sl.No</td>
      <td>Product</td>
      <td>Price</td>
      <td>Qty</td>
      <td>Total</td>
      <td>Photo</td>
      <td>Status</td>
      <td>Action</td>
    </tr>
    <?php
    $selQry="select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id where c.booking_id=".$_GET['bid'];
      $result = $con->query($selQry);
      $i = 0;
      $j=0;
      while ($rowpr = $result->fetch_assoc()) { $i++;
    ?>
    <tr>
    <td><?php echo $i ?></td>
      <td><?php echo $rowpr["product_name"] ?></td>
      <td><?php echo $rowpr["product_price"] ?></td>
      <td><?php echo $rowpr["cart_qty"] ?></td>
      <td><?php echo $rowpr["cart_qty"]*$rowpr["product_price"] ?></td>
      <td><img src="../Assets/Files/Product/<?php echo $rowpr["product_photo"] ?>" width="200px"/></td>
      <td><?php 
      if($rowpr["booking_status"]==2 && $rowpr["cart_status"]==1){
        echo "Order Placed";
      }
      else if($rowpr["cart_status"]==2){
        echo "Item Packed";
        $j++;
      }
      else if($rowpr["cart_status"]==3){
        echo "Item Delivered";
      }
      ?></td>
      <td>
        <?php
      if($rowpr["booking_status"]==2 && $rowpr["cart_status"]==1){
        ?>
        <a href="ViewBooking.php?cid=<?php echo $rowpr['cart_id'] ?>&bid=<?php echo $rowpr['booking_id'] ?>">Item Packed</a>
        <?php
      }
      ?>
      </td>
    </tr>
    <?php
  } ?>
  <?php
   if($i==$j){ ?>
    <tr>
      <td colspan="8">
        <input type="text" name="txt_track" id="" placeholder="Enter Tracking Number here">
        <input type="hidden" name="txt_id" value="<?php echo $_GET['bid'] ?>">
        <input type="submit" value="Submit" name="btn_submit">
      </td>
    </tr>
    <?php
    }
    ?>
  </table>
</form>
</body>
</html>