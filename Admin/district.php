<?php
include('../Assets/Connection/Connection.php');

$district = "";
$eid = 0;

if(isset($_POST['btn_submit'])) {
  $district = $_POST['txt_dist'];
  $eid = $_POST["txt_eid"];

  if($eid == 0) { 
    $insQry="insert into tbl_district(district_name) values('".$district."')";
    if($con->query($insQry)) { 
      ?>
      <script>
	    alert("Data Inserted..")
	    window.location="District.php";
	    </script>
      <?php 
    }
  } else {
      $upQry = "update tbl_district set district_name = '".$district."' where district_id = ".$eid;
      if($con->query($upQry)) {
        ?>
        <script>
        alert("Data Updated...")
        window.location = "District.php";
        </script>
        <?php
      }
    }
  }

if(isset($_GET['did'])) {
  $did = $_GET['did'];
  $delQry="delete from tbl_district where district_id = ".$did;
  if($con->query($delQry)) {
    header("location:District.php");
    exit();
  }
}

if(isset($_GET['eid'])) {
  $eid = $_GET["eid"];
  $seldistrict = "select * from tbl_district where district_id=".$eid;
  $selresult = $con->query($seldistrict);
  $seldata = $selresult->fetch_assoc();
  $district = $seldata["district_name"];
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PAGE DISTRICT</title>
</head>
<style>
  #districtGetInfo{
    border-spacing: 0 10px;
  }

  #districtInfoTable th, #districtInfoTable td{
    text-align: center;
    border: 1px solid black;
  }
</style>
<body>
<form id='District' name='District' method='post' action=''>
<table width='300'  align="center" id='districtGetInfo'>
  <tr>
    <td><strong>District</strong></td>
    <td><label for='dist_txt'></label>
      <input type="text" name="txt_dist" id="txt_dist" value="<?php echo $district; ?>"  />
      <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>"   />
    </td>
  </tr>
  <tr>

    <td colspan='2' align='center'><input type='submit' name='btn_submit' id='btn_submit' value="SAVE" /></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>

<table id='districtInfoTable' width='400' style='border-collapse: collapse; width:50%' align='center'  >
    <tr>
      <th>SL NO</th>
      <th>DISTRICT</th>
      <th>ACTION</th>
    </tr>
  <?php
	  $selQry = "select * from tbl_district";
	  $result = $con->query($selQry);
	  $i = 0;
	  while($row = $result->fetch_assoc())
	  { $i++;
	    ?>
	    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row["district_name"]; ?></td>
        <td>
          <a href="District.php?did=<?php echo $row['district_id']; ?>">Delete </a> | 
          <a href="District.php?eid=<?php echo $row['district_id']; ?>"> Edit</a>
        </td>
      </tr>
      <?php
	  
		}
	?>
    
</table><br /><br />
<a href="../Guest/login.php">Home</a>
</body>
</html>