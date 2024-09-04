<?php
include('../Assets/Connection/Connection.php');

$category = "";
$eid = 0;

if(isset($_POST['btn_submit'])) {
  $category = $_POST['txt_category'];
  $eid = $_POST["txt_eid"];
	
  if($eid == 0) { 
  $selCheck="select * from tbl_category where category_name='".$category."'";
  $resCheck=$con->query($selCheck);
  if($resCheck->num_rows>0){
	  ?>
      <script>
	  category Already Exists");
	  </script>
      <?php
  }
  else{
    $insQry="insert into tbl_category(category_name) values('".$category."')";
    if($con->query($insQry)) { 
      ?>
      <script>
	    alert("Data Inserted..")
	    window.location="category.php";
	    </script>
      <?php 
    }
  }
  } else {
      $upQry = "update tbl_category set category_name = '".$category."' where category_id = ".$eid;
      if($con->query($upQry)) {
        ?>
        <script>
        alert("Data Updated...")
        window.location = "category.php";
        </script>
        <?php
      }
    }
  }

if(isset($_GET['did'])) {
  $did = $_GET['did'];
  $delQry="delete from tbl_category where category_id = ".$did;
  if($con->query($delQry)) {
    header("location:category.php");
    exit();
  }
}

if(isset($_GET['eid'])) {
  $eid = $_GET["eid"];
  $seldistrict = "select * from tbl_category where category_id=".$eid;
  $selresult = $con->query($seldistrict);
  $seldata = $selresult->fetch_assoc();
  $category = $seldata["category_name"];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
</head>
<body>
<h1>Category Page</h1>
    
</body>
</html>