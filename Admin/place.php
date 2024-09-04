<?php
include('../Assets/Connection/Connection.php');

$place = "";
$district_id = "";
$eid = 0;

if(isset($_POST['btn_submit'])) {
	$place = $_POST['txt_place'];
	$district_id = $_POST['ddl_district'];
	$eid = $_POST['txt_eid'];

	if($eid == 0) {
		$insQry = "insert into tbl_place(place_name, district_id) values('".$place."', '".$district_id."')";
		if($con->query($insQry)) {
			?>
			<script>
				alert("Data Inserted...")
				window.location = "Place.php";
			</script>
			<?php
		}
	} else {
		$upQry = "update tbl_place set place_name= '".$place."', district_id= '".$district_id."' where place_id=".$eid;
		if($con->query($upQry)) {
			?>
			<script>
				alert("Data Updated...")
				window.location = "Place.php";
			</script>
			<?php
		}
	}
}

if(isset($_GET['did'])) {
	$did = $_GET['did'];
	$delQry = "delete from tbl_place where place_id = ".$did;
	if($con->query($delQry)) {
		header("location: Place.php");
		exit();
	}
}

if(isset($_GET['eid'])) {
	$eid = $_GET["eid"];
	$selplace = "select * from tbl_place where place_id =".$eid;
	$selresult = $con-> query($selplace);
	$seldata = $selresult->fetch_assoc();
	$place = $seldata["place_name"];
	$district_id = $seldata["district_id"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PAGE PLACE</title>
</head>
<style>
	#placeGetInfo {
		border-spacing: 0 10px;
	}
	#placeInfoTable th, #placeInfoTable td {
		text-align: center;
		border: 1px solid black;
	}
</style>
<body>
<form id='Place' name='Place' method='post' action=''>
<table id='placeGetInfo' width='300' align='center' >
	<tr>
		<td><strong>District</strong></td>
		<td><label for="ddl_district"></label>
			<select name="ddl_district" id="ddl_district">
			<option value="">Select</option>
			<?php
			$selQry1 = "select * from tbl_district";
			$result1 = $con->query($selQry1);
			while($row = $result1->fetch_assoc()) {
				?>
				<option value="<?php echo $row['district_id']; ?>" <?php if($row['district_id'] == $district_id) echo 'selected'; ?> >
					<?php echo $row['district_name']; ?>
				</option>
				<?php
			}
			?>
			</select>
			<input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>" />
		</td>
	</tr>
	<tr>
		<td><strong>Place</strong></td>
		<td><label for="place_txt"></label>
			<input type="text" name="txt_place" id="txt_place" value="<?php echo $place; ?>" /></td>
	</tr>
	<tr>
		<td colspan='2' align='center'>
			<input type='submit' name='btn_submit' id='btn_submit' value='SAVE' />
		</td>
	</tr>
</table>
<p>&nbsp;</p>
</form>

<table id='placeInfoTable' width='400' style='border-collapse: collapse; width: 50%' align='center'>
	<tr>
		<th>SL NO</th>
		<th>DISTRICT</th>
		<th>PLACE</th>
		<th>ACTION</th>
	</tr>
  <?php
	$selQry = "select p.place_id, p.place_name, d.district_name from tbl_place p inner join tbl_district d on p.district_id = d.district_id";
	$result = $con->query($selQry);
	$i = 0;
	while($row = $result->fetch_assoc()) {
		$i++;
		?>
		<tr>
			<td><?php echo $i; ?> </td>
			<td><?php echo $row["district_name"]; ?> </td>
			<td><?php echo $row["place_name"]; ?> </td>
			<td>
				<a href="Place.php?did=<?php echo $row["place_id"]; ?>">Delete</a> |
				<a href="Place.php?eid=<?php echo $row["place_id"]; ?>">Edit</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>
</body>
</html>