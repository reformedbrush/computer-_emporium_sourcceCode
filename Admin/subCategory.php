<?php
include('../Assets/Connection/connection.php');

$subCategory = "";
$category_id = "";
$eid = 0;
$errors = []; // Array to hold error messages

if (isset($_POST['btn_submit'])) {
    $subCategory = trim($_POST['txt_subCategory']);
    $category_id = $_POST['ddl_category'];
    $eid = $_POST['txt_eid'];

    // Validate inputs
    if (empty($subCategory)) {
        $errors[] = "Sub-category name is required.";
    } elseif (!preg_match("/^[A-Za-z][A-Za-z0-9 ]*$/", $subCategory)) {
        $errors[] = "Sub-category name must start with a letter and contain only letters, numbers, and spaces.";
    }

    if (empty($category_id)) {
        $errors[] = "Please select a category.";
    }

    // Check for duplicate subcategory if inserting a new one
    if ($eid == 0) {
        $selCheck = "SELECT * FROM tbl_subCategory WHERE subCategory_name = '" . $con->real_escape_string($subCategory) . "' AND category_id = '" . (int)$category_id . "'";
        $resCheck = $con->query($selCheck);
        if ($resCheck->num_rows > 0) {
            $errors[] = "Sub-category already exists in the selected category.";
        }
    }

    // If no validation errors, proceed with database operations
    if (empty($errors)) {
        if ($eid == 0) {
            $insQry = "INSERT INTO tbl_subCategory(subCategory_name, category_id) VALUES('" . $con->real_escape_string($subCategory) . "', '" . (int)$category_id . "')";
            if ($con->query($insQry)) {
                echo "<script>alert('Data Inserted...'); window.location = 'subCategory.php';</script>";
            }
        } else {
            $upQry = "UPDATE tbl_subCategory SET subCategory_name = '" . $con->real_escape_string($subCategory) . "', category_id = '" . (int)$category_id . "' WHERE subCategory_id = " . (int)$eid;
            if ($con->query($upQry)) {
                echo "<script>alert('Data Updated...'); window.location = 'subCategory.php';</script>";
            }
        }
    }
}

if (isset($_GET['did'])) {
    $did = (int)$_GET['did'];
    $delQry = "DELETE FROM tbl_subCategory WHERE subCategory_id = $did";
    if ($con->query($delQry)) {
        header("location: subCategory.php");
        exit();
    }
}

if (isset($_GET['eid'])) {
    $eid = (int)$_GET["eid"];
    $selsubCategory = "SELECT * FROM tbl_subCategory WHERE subCategory_id = $eid";
    $selresult = $con->query($selsubCategory);
    $seldata = $selresult->fetch_assoc();
    $subCategory = $seldata["subCategory_name"];
    $category_id = $seldata["category_id"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-category</title>
    <style>
        #placeGetInfo {
            border-spacing: 0 10px;
        }
        #placeInfoTable th, #placeInfoTable td {
            text-align: center;
            border: 1px solid black;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
<form id='Place' name='Place' method='post' action=''>
    <table id='placeGetInfo' width='300' align='center'>
        <tr>
            <td><strong>Category</strong></td>
            <td>
                <label for="ddl_category"></label>
                <select name="ddl_category" id="ddl_category">
                    <option value="">Select</option>
                    <?php
                    $selQry1 = "SELECT * FROM tbl_category";
                    $result1 = $con->query($selQry1);
                    while ($row = $result1->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['category_id']; ?>" <?php if ($row['category_id'] == $category_id) echo 'selected'; ?>>
                            <?php echo $row['category_name']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>" />
            </td>
        </tr>
        <tr>
            <td><strong>Sub-Category</strong></td>
            <td>
                <label for="subCategory_txt"></label>
                <input type="text" name="txt_subCategory" id="txt_subCategory" value="<?php echo htmlspecialchars($subCategory); ?>" />
            </td>
        </tr>
        <tr>
            <td colspan='2' align='center'>
                <input type='submit' name='btn_submit' id='btn_submit' value='SAVE' />
            </td>
        </tr>
    </table>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <p>&nbsp;</p>
</form>

<table id='placeInfoTable' width='400' style='border-collapse: collapse; width: 50%' align='center'>
    <tr>
        <th>SL NO</th>
        <th>CATEGORY</th>
        <th>SUB-CATEGORY</th>
        <th>ACTION</th>
    </tr>
    <?php
    $selQry = "SELECT p.subCategory_id, p.subCategory_name, d.category_name FROM tbl_subCategory p INNER JOIN tbl_category d ON p.category_id = d.category_id";
    $result = $con->query($selQry);
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo htmlspecialchars($row["category_name"]); ?></td>
            <td><?php echo htmlspecialchars($row["subCategory_name"]); ?></td>
            <td>
                <a href="subCategory.php?did=<?php echo $row["subCategory_id"]; ?>">Delete</a> |
                <a href="subCategory.php?eid=<?php echo $row["subCategory_id"]; ?>">Edit</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="aprofile.php" align="center">Home</a>
</body>
</html>
