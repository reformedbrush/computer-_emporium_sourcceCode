<?php
include("../Connection/Connection.php");
session_start();
    if (isset($_GET["action"])) {

        $sqlQry = "SELECT * from tbl_product p inner join tbl_subCategory sc on sc.subCategory_id=p.subCategory_id inner join tbl_category c on c.category_id=sc.category_id where TRUE";
       
        if ($_GET["category"]!=null) {

            $category = $_GET["category"];

            $sqlQry = $sqlQry." AND c.category_id IN(".$category.")";
        }
        if ($_GET["subcategory"]!=null) {

            $subcategory = $_GET["subcategory"];

            $sqlQry = $sqlQry." AND sc.sub_id IN(".$subcategory.")";
        }
		
		if ($_GET["name"]!=null) {

            $name = $_GET["name"];

            $sqlQry = $sqlQry." AND product_name LIKE '".$name."%'";
        }
        $resultS = $con->query($sqlQry);
        
       

        if ($resultS->num_rows > 0) {
            while ($rowS = $resultS->fetch_assoc()) {
?>

<div class="col-md-3 mb-2">
                            <div class="card-deck">
                                <div class="card border-secondary">
                                    <img src="../Assets/Files/Product/<?php echo $rowS["product_photo"]; ?>" class="card-img-top" height="250">
                                    <div class="card-img-secondary">
                                        <h6  class="text-light bg-info text-center  p-1"><?php echo $rowS["product_name"]; ?></h6>
                                    </div>
                                    <div class="card-body">
                                        
                                        <span>
                                            <?php echo $rowS["category_name"]; ?> >
                                            <?php echo $rowS["subCategory_name"]; ?><br>
            </span>
                                        <h4 class="card-title text-danger" >
                                            Price : <?php echo $rowS["product_price"]; ?>/-
                                        </h4>
                                        <a href="javascript:void(0)" onclick="addCart('<?php echo $rowS["product_id"]; ?>')" class="btn btn-success btn-block">Add to Cart</a>
                                        <a href="ViewMore.php?pid=<?php echo $rowS["product_id"]; ?>" class="btn btn-warning btn-block">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php
            }
        } else {
             echo "<h4 align='center'>Products Not Found!!!!</h4>";
        }
    }

?>