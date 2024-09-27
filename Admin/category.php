<?php
include('../Assets/Connection/Connection.php');

$category = "";
$eid = 0;
$errors = []; // Array to hold error messages

if (isset($_POST['btn_submit'])) {
    $category = trim($_POST['txt_category']);
    $eid = $_POST["txt_eid"];

    // Validate inputs
    if (empty($category)) {
        $errors[] = "Category name is required.";
    } elseif (!preg_match("/^[A-Za-z][A-Za-z0-9 ]*$/", $category)) {
        $errors[] = "Category name must start with a letter and contain only letters, numbers, and spaces.";
    }

    // Check for duplicate category if inserting a new one
    if ($eid == 0) {
        $selCheck = "SELECT * FROM tbl_category WHERE category_name = '" . $con->real_escape_string($category) . "'";
        $resCheck = $con->query($selCheck);
        if ($resCheck->num_rows > 0) {
            $errors[] = "Category already exists.";
        }
    }

    // If no validation errors, proceed with database operations
    if (empty($errors)) {
        if ($eid == 0) {
            $insQry = "INSERT INTO tbl_category(category_name) VALUES('" . $con->real_escape_string($category) . "')";
            if ($con->query($insQry)) {
                echo "<script>alert('Data Inserted...'); window.location = 'category.php';</script>";
            }
        } else {
            $upQry = "UPDATE tbl_category SET category_name = '" . $con->real_escape_string($category) . "' WHERE category_id = " . (int)$eid;
            if ($con->query($upQry)) {
                echo "<script>alert('Data Updated...'); window.location = 'category.php';</script>";
            }
        }
    }
}

if (isset($_GET['did'])) {
    $did = (int)$_GET['did'];
    $delQry = "DELETE FROM tbl_category WHERE category_id = $did";
    if ($con->query($delQry)) {
        header("location: category.php");
        exit();
    }
}

if (isset($_GET['eid'])) {
    $eid = (int)$_GET["eid"];
    $selCategory = "SELECT * FROM tbl_category WHERE category_id = $eid";
    $selresult = $con->query($selCategory);
    $seldata = $selresult->fetch_assoc();
    $category = $seldata["category_name"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <style>
        #categoryGetInfo {
            border-spacing: 0 10px;
        }
        #categoryInfoTable th, #categoryInfoTable td {
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
<h1 align="center">Category Page</h1>
<form id='category' name='category' method='post' action=''>
    <table width='300' align="center" id='category_GetInfo'>
        <tr>
            <td><strong>Category</strong></td>
            <td>
                <label for='category_txt'></label>
                <input type="text" name="txt_category" id="txt_category" value="<?php echo htmlspecialchars($category); ?>" />
                <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>" />
            </td>
        </tr>
        <tr>
            <td colspan='2' align='center'>
                <input type='submit' name='btn_submit' id='btn_submit' value="SAVE" />
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

<table id='categoryInfoTable' width='400' align='center'>
    <tr>
        <th>SL NO</th>
        <th>CATEGORY</th>
        <th>ACTION</th>
    </tr>
    <?php
    $selQry = "SELECT * FROM tbl_category";
    $result = $con->query($selQry);
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $i++;
        ?>
        <tr align="center">
            <td><?php echo $i; ?></td>
            <td><?php echo htmlspecialchars($row["category_name"]); ?></td>
            <td>
                <a href="category.php?did=<?php echo $row['category_id']; ?>">Delete </a> |
                <a href="category.php?eid=<?php echo $row['category_id']; ?>"> Edit</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="aprofile.php" align="center">Home</a>
</body>
</html>
