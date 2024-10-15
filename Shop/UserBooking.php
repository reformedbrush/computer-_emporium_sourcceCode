<?php

session_start();
include("../Assets/Connection/Connection.php");
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
      <td>Customer</td>
      <td>Address</td>
      <td>Contact</td>
      <td>Total</td>
      <td>Tracking Id</td>
      <td>Action</td>
    </tr>
    <?php
    echo $selQry="select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id inner join tbl_user u on u.user_id=b.user_id where booking_status>1 and shop_id=".$_SESSION['sid']." group by b.booking_id";
      $result = $con->query($selQry);
      $i = 0;
      while ($rowpr = $result->fetch_assoc()) { $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $rowpr["user_name"] ?></td>
      <td><?php echo $rowpr["user_address"] ?></td>
      <td><?php echo $rowpr["user_number"] ?></td>
      <td><?php echo $rowpr["booking_amount"] ?></td>
      <td><?php echo $rowpr["tracking_id"] ?></td>
      <td><a href="ViewBooking.php?bid=<?php echo $rowpr['booking_id'] ?>">View Products</a></td>
    </tr>
    <?php } ?>
  </table>
</form>
</body>
</html>