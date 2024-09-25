<?php
include('../Assets/Connection/Connection.php');

if(isset($_GET["aid"]))
{
    $up = "update tbl_shop set shop_status=1 where shop_id=".$_GET["aid"];
    if($con->query($up))
    {
        echo "<script>
            alert('Shop Verified')
            window.location='NewSHop.php'
        </script>";
    }
}

if(isset($_GET["rid"]))
{
    $up = "update tbl_shop set shop_status=2 where shop_id=".$_GET["rid"];
    if($con->query($up))
    {
        echo "<script>
            alert('Shop Verified')
            window.location='NewSHop.php'
        </script>";
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Verification</title>
</head>
<body>
    <table>
        <tr>
            <td>Sl.No</td>
            <td>Name</td>
            <td>Address</td>
            <td>Contact</td>
            <td>Proof</td>
            <td>Action</td>
        </tr>
        <?php
        $shop="SELECT * from tbl_shop where shop_status=0";
        $res=$con->query($shop);
        while($data=$res->fetch_assoc()){
            ?>
 <tr>

 <td>
                <?php
                echo $data['shop_id']

                ?>
            </td>
            <td>
                <?php
                echo $data['shop_name']

                ?>
            </td>
            <td>
            <?php
                echo $data['shop_address']
                ?>
            </td>
            <td>
            <?php
                echo $data['shop_contact']
                ?>
            </td>
            <td>
            <?php
                echo $data['shop_proof']
                ?>
            </td>
            <td>
                <a href="NewShop.php?aid=<?php echo $data['shop_id'] ?>">Accept</a>||<a href="NewShop.php?rid=<?php echo $data['shop_id'] ?>">Reject</a>
            </td>
        </tr>
            <?php
        }
        ?>
       
    </table><br><br>
    <a href="aprofile.php">Home</a>
</body>
</html>