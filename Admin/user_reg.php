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
	
	$insQry="insert into tbl_user(user_name,user_email,user_password) values('".$name."','".$email."','".$password."')";
	if($con->query($insQry))
	{
		echo "inserted";
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
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" /></td>
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
      <td>Place</td>
      <td><label for="sel_place"></label>
        <select name="sel_place" id="sel_place">
          <option>--Select--</option>
        
      </select></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label for="photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
</form>
</body>
 <script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {

        $("#sel_place").html(result);
      }
    });
  }

</script>
</html>
