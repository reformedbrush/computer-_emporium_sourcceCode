<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$password=$_POST['txt_password'];
	$district=$_POST['sel_district'];
	$place=$_POST['sel_place'];
	$photo=$_FILES["file_photo"]["name"];
	$temp=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($temp,"../Assets/Files/User/".$photo);
	
	$insQry="insert into tbl_user(shop_name,shop_email,shop_password,district,shop_address,place_id,shop_contact) values('".$name."','".$email."','".$password."','".$district."','".$place."')";
	if($con->query($insQry))
	{
		echo "inserted";
	}
	
}
if(isset($_GET['did'])) {
  $did = $_GET['did'];
  $delQry="delete from tbl_user where user_id = ".$did;
  if($con->query($delQry)) {
    header("location:user_reg.php");
    exit();
  }
}

?>

<table width="200" border="1">
  <tr>
    <td>Name</td>
    <td><form id="form1" name="form1" method="post" action="">
      <label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" />
    </form></td>
  </tr>
  <tr>
    <td>E-mail</td>
    <td><form id="form2" name="form2" method="post" action="">
      <label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" />
    </form></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><form id="form3" name="form3" method="post" action="">
      <label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" />
    </form></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><form id="form4" name="form4" method="post" action="">
      <label for="txt_address"></label>
      <input type="text" name="txt_address" id="txt_id">
</form></td>
     </td>
  </tr>
  <tr>
    <td>Place</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>District</td>
    <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onchange="getplace(this.value)">
        <option>--Select--</option>
        <?php
			$selQry1="select * from tbl_district";
			$resultOne=$con->query($selQry1);
			while($data=$resultOne->fetch_assoc())
			{
		?>
        <option value="<?php echo $data['district_id']; ?>">
        <?php echo $data['district_name']; ?>
        </option>
        <?php
			}
		?>
      </select></td>
  </tr>
  <tr>
    <td colspan="2"><form id="form4" name="form4" method="post" action="">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="cancel" id="cancel" value="Cancel" />
    </form></td>
  </tr>
  
  <table id='shopInfoTable' width='400' style='border-collapse: collapse; width:50%' align='center'  >
    <tr>
      <th>SL NO</th>
      <th>SHOP NAME</th>
      <th>ACTION</th>
    </tr>
  <?php
	  $selQry = "select * from tbl_shop";
	  $result = $con->query($selQry);
	  $i = 0;
	  while($row = $result->fetch_assoc())
	  { $i++;
	    ?>
	    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row["shop_name"]; ?></td>
        <td>
          <a href="shop_reg.php?did=<?php echo $row['shop_id']; ?>">Delete </a> | 
          <a href="shop_reg.php?eid=<?php echo $row['shop_id']; ?>"> Edit</a>
        </td>
      </tr>
      <?php
	  
		}
	?>
    
</table>
  
</table>
