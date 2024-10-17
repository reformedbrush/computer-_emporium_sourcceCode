<?php
session_start();
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
    $title=$_POST['txt_title'];
    $content=$_POST['txt_content'];
    $ins="insert into tbl_complaint(complaint_title,complaint_content,product_id) values('".$title."','".$content."','".$_GET['pid']."')";
    if($con->query($ins))
    {
        echo "<script>alert('Complaint Send'); window.location = 'MyBooking.php';</script>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <table align="center" border="2">
        <tr>
            <td>Title</td>
            <td>Content</td>
        </tr>
        <tr>
            <td><input type="text" name="txt_title" id="txt_title"></td>
            <td><textarea name="txt_content" id="txt_content"></textarea></td>
        </tr>
        <tr>
            <td align="center" colspan="2"><input type="submit" name="btn_submit" id="btn_submit" value="Submit"></td>
        </tr>
        </table>

    </form>
</body>
</html>