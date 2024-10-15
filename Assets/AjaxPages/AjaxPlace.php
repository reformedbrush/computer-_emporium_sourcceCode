<option value="">-----Select-----</option>
<?php
include("../Connection/Connection.php");
$selqry="select * from tbl_place where district_id='".$_GET["did"]."'";;
		$re=$con->query($selqry);
		while($row=$re->fetch_assoc())
		{
			?>
            <option value="<?php echo $row["place_id"]; ?>"><?php echo $row["place_name"]; ?></option>
            <?php
		} 
		?>