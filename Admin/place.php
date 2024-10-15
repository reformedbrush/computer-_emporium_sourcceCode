<?php
include('../Assets/Connection/Connection.php');

$place = "";
$district_id = "";
$eid = 0;
$errors = []; // Array to hold error messages

if (isset($_POST['btn_submit'])) {
    $place = trim($_POST['txt_place']);
    $district_id = $_POST['ddl_district'];
    $eid = $_POST['txt_eid'];

    // Validate inputs
    if (empty($place)) {
        $errors[] = "Place name is required.";
    } elseif (!preg_match("/^[A-Z][a-zA-Z ]*$/", $place)) {
        $errors[] = "Place name must start with a capital letter and contain only alphabets and spaces.";
    }

    if (empty($district_id)) {
        $errors[] = "Please select a district.";
    }

    // If no validation errors, proceed with database operations
    if (empty($errors)) {
        if ($eid == 0) {
            $insQry = "INSERT INTO tbl_place(place_name, district_id) VALUES ('$place', '$district_id')";
            if ($con->query($insQry)) {
                echo "<script>alert('Data Inserted...'); window.location = 'Place.php';</script>";
            }
        } else {
            $upQry = "UPDATE tbl_place SET place_name = '$place', district_id = '$district_id' WHERE place_id = $eid";
            if ($con->query($upQry)) {
                echo "<script>alert('Data Updated...'); window.location = 'Place.php';</script>";
            }
        }
    }
}

if (isset($_GET['did'])) {
    $did = $_GET['did'];
    $delQry = "DELETE FROM tbl_place WHERE place_id = $did";
    if ($con->query($delQry)) {
        header("location: Place.php");
        exit();
    }
}

if (isset($_GET['eid'])) {
    $eid = $_GET["eid"];
    $selplace = "SELECT * FROM tbl_place WHERE place_id = $eid";
    $selresult = $con->query($selplace);
    $seldata = $selresult->fetch_assoc();
    $place = $seldata["place_name"];
    $district_id = $seldata["district_id"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGE PLACE</title>
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
                <h5 class="mb-0">Add / Edit Place</h5>
            </div>
            <div class="card-body">
                <form id='Place' name='Place' method='post' action=''>
                    <div class="mb-3">
                        <label for="ddl_district" class="form-label">District</label>
                        <select class="form-select" name="ddl_district" id="ddl_district">
                            <option value="">Select</option>
                            <?php
                            $selQry1 = "SELECT * FROM tbl_district";
                            $result1 = $con->query($selQry1);
                            while ($row = $result1->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['district_id']; ?>" <?php if ($row['district_id'] == $district_id) echo 'selected'; ?>>
                                    <?php echo $row['district_name']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="txt_place" class="form-label">Place</label>
                        <input type="text" class="form-control" name="txt_place" id="txt_place" value="<?php echo htmlspecialchars($place); ?>" />
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
                        <th>DISTRICT</th>
                        <th>PLACE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selQry = "SELECT p.place_id, p.place_name, d.district_name FROM tbl_place p INNER JOIN tbl_district d ON p.district_id = d.district_id";
                    $result = $con->query($selQry);
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($row["district_name"]); ?></td>
                            <td><?php echo htmlspecialchars($row["place_name"]); ?></td>
                            <td>
                                <a href="Place.php?did=<?php echo $row["place_id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
                                <a href="Place.php?eid=<?php echo $row["place_id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
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
