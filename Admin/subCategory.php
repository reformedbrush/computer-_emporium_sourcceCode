<?php
include('../Assets/Connection/connection.php');
$subCategory = "";
$category_id = "";
$eid = 0;

if(isset($_POST['btn_submit'])) {
	$subCategory = $_POST['txt_subCategory'];
	$category_id = $_POST['ddl_category'];
	$eid = $_POST['txt_eid'];

	if($eid == 0) {
		$insQry = "insert into tbl_subCategory(subCategory_name, category_id) values('".$subCategory."', '".$category_id."')";
		if($con->query($insQry)) {
			?>
			<script>
				alert("Data Inserted...")
				window.location = "subCategory.php";
			</script>
			<?php
		}
	} else {
		$upQry = "update tbl_subCategory set subCategory_name= '".$subCategory."', category_id= '".$category_id."' where subCategory_id=".$eid;
		if($con->query($upQry)) {
			?>
			<script>
				alert("Data Updated...")
				window.location = "subCategory.php";
			</script>
			<?php
		}
	}
}

if(isset($_GET['did'])) {
	$did = $_GET['did'];
	$delQry = "delete from tbl_subCategory where subCategory_id = ".$did;
	if($con->query($delQry)) {
		header("location: subCategory.php");
		exit();
	}
}

if(isset($_GET['eid'])) {
	$eid = $_GET["eid"];
	$selsubCategory= "select * from tbl_subCategory where subCategory_id =".$eid;
	$selresult = $con-> query($selsubCategory);
	$seldata = $selresult->fetch_assoc();
	$subCategory = $seldata["subCategory_name"];
	$category_id = $seldata["category_id"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sub-category</title>
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
		<td><strong>Category</strong></td>
		<td><label for="ddl_category"></label>
			<select name="ddl_category" id="ddl_category">
			<option value="">Select</option>
			<?php
			$selQry1 = "select * from tbl_category";
			$result1 = $con->query($selQry1);
			while($row = $result1->fetch_assoc()) {
				?>
				<option value="<?php echo $row['category_id']; ?>" <?php if($row['category_id'] == $category_id) echo 'selected'; ?> >
					<?php echo $row['category_name']; ?>
				</option>
				<?php
			}
			?>
			</select>
			<input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>" />
		</td>
	</tr>
	<tr>
		<td><strong>Sub-Category</strong></td>
		<td><label for="subCategory_txt"></label>
			<input type="text" name="txt_subCategory" id="txt_subCategory" value="<?php echo $subCategory; ?>" /></td>
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
		<th>CATEGORY</th>
		<th>SUB-CATEGORY</th>
		<th>ACTION</th>
	</tr>
  <?php
	$selQry = "select p.subCategory_id, p.subCategory_name, d.category_name from tbl_subCategory p inner join tbl_category d on p.category_id = d.category_id";
	$result = $con->query($selQry);
	$i = 0;
	while($row = $result->fetch_assoc()) {
		$i++;
		?>
		<tr>
			<td><?php echo $i; ?> </td>
			<td><?php echo $row["category_name"]; ?> </td>
			<td><?php echo $row["subCategory_name"]; ?> </td>
			<td>
				<a href="subCategory.php?did=<?php echo $row["subCategory_id"]; ?>">Delete</a> |
				<a href="subCategory.php?eid=<?php echo $row["subCategory_id"]; ?>">Edit</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<a href="aprofile.php" align="center">Home</a>
</body>
</html>