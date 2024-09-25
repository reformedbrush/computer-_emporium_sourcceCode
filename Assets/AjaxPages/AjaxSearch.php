
<?php
include("../Connection/Connection.php");
$selQry="select * from tbl_product p inner join tbl_subCategory s on s.subCategory_id=p.subCategory_id inner join tbl_category c on c.category_id=s.category_id where true ";;
if($_GET['cid']!=''){
    $selQry.=" and p.district_id=".$_GET['did'];
}
if($_GET['sid']!=''){
    $selQry.=" and c.place_id=".$_GET['pid'];
}
// echo $selQry;
$res=$conn->query($selQry);
while($data=$res->fetch_assoc()){
?>
<div class="col-lg-3 mb-4 gap-1">
<div class="card mt-4" style="width: 18rem;">
            <img src="../Assets/File/Chef/Photo/<?php echo $data['chef_photo'] ?>" class="card-img-top" alt="Chef's Photo" style="height: 250px;object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $data['chef_name'] ?></h5>
                <p class="card-text">
                    <strong>Contact:</strong><?php echo $data['chef_contact'] ?><br>
                    <strong>Location:</strong><?php echo $data['place_name'].', '.$data['district_name'] ?><br>
                    <strong>Rating:</strong> 4.5/5
                </p>
                <a href="ChefMenu.php?cid=<?php echo $data['chef_id'] ?>" class="btn btn-primary text-center"style="
    width: 100%;
">Show Menu</a>
            </div>
        </div>
</div>
<?php
}
?>
