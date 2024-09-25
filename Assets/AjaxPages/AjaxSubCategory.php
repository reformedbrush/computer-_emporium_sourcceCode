<option value="">-----Select-----</option>
<?php
include("../Connection/Connection.php");
$selqry="select * from tbl_subcategory where category_id='".$_GET["did"]."'";;
		$re=$con->query($selqry);
		while($row=$re->fetch_assoc())
		{
			?>
            <option value="<?php echo $row["subcategory_id"]; ?>"><?php echo $row["subcategory_name"]; ?></option>
            <?php
		} 
		?>