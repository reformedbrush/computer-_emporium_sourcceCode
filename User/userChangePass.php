<?php

include("../Assets/Connection/connection.php");
session_start();
$message="";
if(isset($_POST["btn_submit"]))
{
	
	$currentpwd=$_POST["txtcurrent"];
	$newpwd=$_POST["txtnew"];
	$confirmpwd=$_POST["txtconfirm"];

	$selQuery="select * from tbl_user where user_password='".$currentpwd."' and user_id='".$_SESSION["uid"]."'";
	$result=$con->query($selQuery);
	if($data=$result->fetch_assoc())
		{
			
			if($newpwd==$confirmpwd)
			{
				$upQry="update tbl_user set user_password='".$newpwd."' where user_id='".$_SESSION["uid"]."'";
				if($con->query($upQry))
				{
					$message="Password Updated";
				}
			}
			else
			{
					$message="Password not same";
			}
		}
		else
		{
			$message="Please check current password";
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
<form id="form1" name="form1" method="post" action="">
  <table width="345" height="189" border="1">
    <tr>
      <th>Current Password</th>
      <td><label for="txtcurrent"></label>
      <input type="text" name="txtcurrent" id="txtcurrent" /></td>
    </tr>
    <tr>
      <th >New Password</th>
      <td><label for="txtnew"></label>
      <input type="text" name="txtnew" id="txtnew" /></td>
    </tr>
    <tr>
      <th scope="row">Confirm Password</th>
      <td><label for="txtconfirm"></label>
      <input type="text" name="txtconfirm" id="txtconfirm" /></td>
    </tr>
    <tr>
      <th colspan="2" scope="row"><input type="submit" name="btn_submit" id="btn_submit" value="Update" /></th>
    </tr>
    <tr>
      
      <td colspan="2" align="center"><?php echo $message?></td>
    </tr>
  </table>
</form>
</body>
</html>