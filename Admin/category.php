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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error {
            color: red;
            font-size: 14px;
        }
        .table-wrapper {
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add / Edit Category</h5>
            </div>
            <div class="card-body">
                <form id='category' name='category' method='post' action=''>
                    <div class="mb-3">
                        <label for="txt_category" class="form-label">Category</label>
                        <input type="text" class="form-control" name="txt_category" id="txt_category" value="<?php echo htmlspecialchars($category); ?>" />
                        <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>" />
                    </div>
                    <div class="d-grid gap-2">
                        <button type='submit' class='btn btn-primary' name='btn_submit' id='btn_submit'>Save</button>
                    </div>
                </form>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger mt-3">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="table-wrapper mt-5">
            <table class='table table-bordered table-striped'>
                <thead class="table-dark">
                    <tr>
                        <th>SL NO</th>
                        <th>CATEGORY</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
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
                                <a href="category.php?did=<?php echo $row['category_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                <a href="category.php?eid=<?php echo $row['category_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <a href="Homepage.php" class="btn btn-secondary">Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>