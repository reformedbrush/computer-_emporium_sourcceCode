<?php
include('../Assets/Connection/Connection.php');

$district = "";
$eid = 0;

if (isset($_POST['btn_submit'])) {
  $district = $_POST['txt_dist'];
  $eid = $_POST["txt_eid"];

  // Validate district name
  if (empty($district) || !preg_match("/^[A-Z][a-z]*(?: [A-Z][a-z]*)*$/", $district)) {
    echo "<script>alert('Invalid district name. It should start with an uppercase letter and contain only alphabets and spaces.');</script>";
  } else {
    if ($eid == 0) {
      $selCheck = "select * from tbl_district where district_name='" . $district . "'";
      $resCheck = $con->query($selCheck);
      if ($resCheck->num_rows > 0) {
        echo "<script>alert('District Already Exists');</script>";
      } else {
        $insQry = "insert into tbl_district(district_name) values('" . $district . "')";
        if ($con->query($insQry)) {
          echo "<script>alert('Data Inserted..'); window.location='District.php';</script>";
        }
      }
    } else {
      $upQry = "update tbl_district set district_name = '" . $district . "' where district_id = " . $eid;
      if ($con->query($upQry)) {
        echo "<script>alert('Data Updated...'); window.location = 'District.php';</script>";
      }
    }
  }
}

if (isset($_GET['did'])) {
  $did = $_GET['did'];
  $delQry = "delete from tbl_district where district_id = " . $did;
  if ($con->query($delQry)) {
    header("location:District.php");
    exit();
  }
}

if (isset($_GET['eid'])) {
  $eid = $_GET["eid"];
  $seldistrict = "select * from tbl_district where district_id=" . $eid;
  $selresult = $con->query($seldistrict);
  $seldata = $selresult->fetch_assoc();
  $district = $seldata["district_name"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page District</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .form-table {
            margin-bottom: 20px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">District Management</h2>

        <form id='District' name='District' method='post' action=''>
            <table class='table table-bordered form-table'>
                <tr>
                    <td><strong>District</strong></td>
                    <td>
                        <input type="text" name="txt_dist" id="txt_dist" value="<?php echo htmlspecialchars($district); ?>" required pattern="^[A-Z][a-z]*(?: [A-Z][a-z]*)*$" title="District name should start with an uppercase letter and contain only alphabets and spaces." class="form-control" />
                        <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid; ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' name='btn_submit' id='btn_submit' value="SAVE" class="btn btn-primary" /></td>
                </tr>
            </table>
        </form>

        <table id='districtInfoTable' class='table table-bordered' width='400'>
            <thead>
                <tr>
                    <th>SL NO</th>
                    <th>DISTRICT</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry = "SELECT * FROM tbl_district";
                $result = $con->query($selQry);
                $i = 0;
                while ($row = $result->fetch_assoc()) { $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($row["district_name"]); ?></td>
                    <td>
                        <a href="District.php?did=<?php echo $row['district_id']; ?>" class="btn btn-danger btn-sm">Delete</a> 
                        <a href="District.php?eid=<?php echo $row['district_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="Homepage.php" class="btn btn-secondary mt-3">Home</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>