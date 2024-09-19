<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                echo $data['shop_name']
                ?>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="NewShop.php?aid=<?php echo $data['shop_id'] ?>">Accept</a>||<a href="NewShop.php?rid=<?php echo $data['shop_id'] ?>">Accept</a>
            </td>
        </tr>
            <?php
        }
        ?>
       
    </table>
</body>
</html>