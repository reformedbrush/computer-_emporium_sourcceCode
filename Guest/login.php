<?php
	include("../Assets/connection/connection.php");
	if(isset($_POST["Login"]))
	{
		$email=$_POST["email"];
		$password=$_POST["password"];
		$admin="select * from tbl_admin where admin_email='".$email."'and admin_password='".$password."'";
		$user="select * from tbl_user where user_email='".$email."'and user_password='".$password."'";
		$seller="select * from tbl_shop where shop_email='".$email."'and shop_password='".$password."'";
		$resAdmin=$con->query($admin);
		$resUser=$con->query($user);
		$resSeller=$con->query($seller);
		if($data=$resAdmin->fetch_assoc())
		{
			$_SESSION['aid']=$data['admin_id'];
			$_SESSION['aname']=$data['admin_name'];
			header("location:../Admin/adminHome.php");	
		}
		else if($data=$resUser->fetch_assoc())
		{
			$_SESSION['aid']=$data['user_id'];
			$_SESSION['aname']=$data['user_name'];
			header("location:../Admin/userHome.php");	
		}
		if($data=$resSeller->fetch_assoc())
		{
			$_SESSION['aid']=$data['shop_id'];
			$_SESSION['aname']=$data['shop_name'];
			header("location:../Admin/sellerHome.php");	
		}
		else
		{
			echo "Wrong input";	
		}
		
		
	}
?>
<body>
<h1>LOGIN</h1>
<form name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>E-mail</td>
      <td><label for="email"></label>
      <input type="text" name="email" id="email"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="password"></label>
      <input type="password" name="password" id="password"></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="Submit" name="Login" id="Login" value="Login">
      </div></td>
    </tr>
  </table>
</form>
</body>