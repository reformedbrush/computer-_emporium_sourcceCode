<?php
session_start();
include("../Connection/Connection.php");
?>
<?php

    if ($_GET["action"]=="Delete") {
        $id = $_GET["id"];
        $delQry = "delete from tbl_cart where cart_id='" .$id. "'";
        $con->query($delQry);
    }
    if ($_GET["action"]=="Update") {
        $id = $_GET["id"];
        $qty = $_GET["qty"];
        $upQry = "update tbl_cart set cart_quantity = '" .$qty. "' where cart_id='" .$id. "'";
        $con->query($upQry);
    }
?>