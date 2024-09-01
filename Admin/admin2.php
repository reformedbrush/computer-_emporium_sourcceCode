
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$password=$_POST["txt_password"];
	$insQry="insert into tbl_admin(admin_name,admin_email,admin_password) values('".$name."','".$email."','".$password."')";
	if($Con->query($insQry))
	{
		echo "inserted";
	}
}
if(isset($_GET["did"]))
{
	$did=$_GET["did"];
	$delQry="delete from tbl_admin where admin_id=".$did;
	if($Con->query($delQry))
	{
		header("location:AdminRegistration.php");
	}
}
?>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<table width="200" border="1">
  <tr>
    <td>Name</td>
    <td>
      <label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" />
 </td>
  </tr>
  <tr>
    <td>Email</td>
    <td>
      <label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" />
    </td>
  </tr>
  <tr>
    <td>Password</td>
    <td>
          <label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" />
   </td>
  </tr>
  <tr>
    <td colspan="2" align="center" ><form id="form4" name="form4" method="post" action="">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
    </td>
  </tr>
</table>
</form>
<form id="form1" name="form1" method="post" action="">
  <table width="494" border="1">
    <tr>
      <td width="90" height="32">SlNo</td>
      <td width="90">Name</td>
      <td width="90">Email</td>
      <td width="90">Password</td>
      <td width="90">Action</td>
    </tr>
    <?php 
		  $selQry="select * from tbl_admin";
		  $result=$Con->query($selQry);
		  $i=0;
		  while($data=$result->fetch_assoc())
		  {
			  $i++;
	?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data["admin_name"]; ?></td>
      <td><?php echo $data["admin_email"]; ?></td>
      <td><?php echo $data["admin_password"]; ?></td>
      <td><a href="AdminRegistration.php?did=<?php echo $data["admin_id"]; ?>">Delete</a></td>
    </tr>
    <?php
		  }
	?>
  </table>
</form>
</body>
</html>