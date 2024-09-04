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
    <style>
  #categoryGetInfo{
    border-spacing:0 10px;
  }

  #categoryInfoTable th, #categoryInfoTable td{
    text-align: center;
    border: 1px solid black;
  }
</style>
</head>
<body>
<h1 align="center">Category Page</h1>
<form id='category' name='category' method='post' action=''>
  <table width='300'  align="center" id='category_GetInfo'>
    <tr>
    <td><strong>category</strong></td>
    <td><label for='category_txt'></label>
    <input type="text" name="txt_category" id="txt_category" value="<?php echo $category_; ?>"  />
      <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>"   />
    </td>
  </tr>
  <tr>

    <td colspan='2' align='center'><input type='submit' name='btn_submit' id='btn_submit' value="SAVE" /></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>

<table id='categoryInfoTable' width='400' align='center'  >
    <tr>
      <th>SL NO</th>
      <th>CATEGORY</th>
      <th>ACTION</th>
    </tr>
  <?php
	  $selQry = "select * from tbl_category";
	  $result = $con->query($selQry);
	  $i = 0;
	  while($row = $result->fetch_assoc())
	  { $i++;
	    ?>
	    <tr align="center">
        <td><?php echo $i; ?></td>
        <td><?php echo $row ["category_name"]; ?></td>
        <td>
          <a href="category.php?did=<?php echo $row['category_id']; ?>">Delete </a> | 
          <a href="category.php?eid=<?php echo $row['category_id']; ?>"> Edit</a>
        </td>
      </tr>
      <?php
	  
		}
	?>
    
</table>
    
</body>
</html>