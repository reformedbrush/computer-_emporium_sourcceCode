<?php
include("../connection/connection.php");
$selqry="select * from tbl_subCategory where category_id IN(".$_GET["data"].")";
$result=$con->query($selqry);
while($row=$result->fetch_assoc())
{
	?>
        <li class="list-group-item">
            <div class="form-check">
                <label class="form-check-label">
                    <input onchange="productCheck()"  type="checkbox" class="form-check-input product_check" value="<?php echo $row["subCategory_id"]; ?>" id="subCategory"><?php echo $row["subCategory_name"]; ?>
                </label>
            </div>
        </li>
    <?php 
}
?>