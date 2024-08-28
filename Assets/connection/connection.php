<?php
$username="root";
$server="localhost";
$password="";
$DB="db_computeremporium";
$con=mysqli_connect($server,$username,$password,$DB);
if(!$con)
{
	echo "connection failed";
}
?>