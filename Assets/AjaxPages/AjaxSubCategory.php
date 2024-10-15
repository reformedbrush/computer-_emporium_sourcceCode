<option value="">-----Select-----</option>
<?php
include("../Connection/Connection.php");
$selqry="select * from tbl_subcategory where category_id='".$_GET["did"]."'";;
		$re=$con->query($selqry);
		while($row=$re->fetch_assoc())
		{
			?>
            <option value="<?php echo $row["subCategory_id"]; ?>"><?php echo $row["subCategory_name"]; ?></option>
            <?php
		} 
		?>