<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="admin_reg.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
include("../assets/connection/connection.php");
	
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["admin_name"];
	$email=$_POST["admin_email"];
	$password=$_POST["admin_password"];
	$aid=$_POST["txt_aid"];
	
	$insQry="insert into tbl_admin(admin_name,admin_email,admin_password) values('".$name."','".$email."','".$password."')";
	echo $insQry;
	if($con->query($insQry))
	{
		echo "inserted";
	}
	  
}
if(isset($_GET["did"]))
{
	$did=$_GET["did"];
	$delQry="delete from tbl_admin where admin_id=".$did;
	if($con->query($delQry))
	{
		?>
        <script>
		//window.location="Admin_reg.php";
		</script>
        <?php
	}
}
?>
</head>

<body>
<h1>Admin Registration</h1><br />
<form id="form2" name="form2" method="post" action="">
<table id="table" width="276" border="1">
  <tr>
    <td width="169">Name</td>
    <td width="91">
      <label for="admin_name"></label>
      <input type="text" name="admin_name" id="admin_name" />
    </td>
  </tr>
  <tr>
    <td>E-Mail</td>
    <td><form id="form3" name="form3" method="post" action="">
      <label for="admin_email"></label>
      <input type="text" name="admin_email" id="admin_email" />
    </td>
  </tr>
  <tr>
    <td>Password</td>
    <td>
      <label for="admin_password"></label>
      <input type="text" name="admin_password" id="admin_password" />
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="submit" name="Cancel" id="Cancel" value="Cancel" />
      </div>
    </td>
  </tr>
</table>
</form>
</body>

