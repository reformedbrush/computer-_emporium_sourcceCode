<?php
	include("../Assets/connection/connection.php");
	session_start();
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
			header("location:../Admin/aprofile.php");	
		}
		else if($data1=$resUser->fetch_assoc())
		{
			$_SESSION['uid']=$data1['user_id'];
			$_SESSION['uname']=$data1['user_name'];
			header("location:../User/uProfile.php");	
		}
		if($data2=$resSeller->fetch_assoc())
		{
			if($data2['shop_status']==0){
				?>
<script>
	alert("Not verified")
</script>
				<?php
			}
			else if($data2['shop_status']==1){
				
			$_SESSION['sid']=$data2['shop_id'];
			$_SESSION['sname']=$data2['shop_name'];
			header("location:../Shop/sellerProfile.php");	
			}
			else{
				?>
<script>
	alert("Rejected")
</script>
				<?php
			}
		}
		else
		{
			echo "Wrong input";	
		}
		
		
	}
?>
<body>
<h1 align="center">LOGIN</h1>
<form name="form1" method="post" action="">
  <table width="200" border="1" align="center">
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