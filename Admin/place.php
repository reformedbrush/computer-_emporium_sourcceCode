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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PAGE PLACE</title>
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
        <table id='placeGetInfo' width='300' align='center' >
            <tr>
                <td><strong>District</strong></td>
                <td>
                    <select name="ddl_district" id="ddl_district">
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
                </td>
            </tr>
            <tr>
                <td><strong>Place</strong></td>
                <td>
                    <input type="text" name="txt_place" id="txt_place" value="<?php echo htmlspecialchars($place); ?>" />
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
            <th>DISTRICT</th>
            <th>PLACE</th>
            <th>ACTION</th>
        </tr>
        <?php
        $selQry = "SELECT p.place_id, p.place_name, d.district_name FROM tbl_place p INNER JOIN tbl_district d ON p.district_id = d.district_id";
        $result = $con->query($selQry);
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?> </td>
                <td><?php echo htmlspecialchars($row["district_name"]); ?> </td>
                <td><?php echo htmlspecialchars($row["place_name"]); ?> </td>
                <td>
                    <a href="Place.php?did=<?php echo $row["place_id"]; ?>">Delete</a> |
                    <a href="Place.php?eid=<?php echo $row["place_id"]; ?>">Edit</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="aprofile.php" align="center">Home</a>
</body>
</html>
