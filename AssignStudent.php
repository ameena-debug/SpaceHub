<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

// Assign Bed
if (isset($_POST['btn_submit'])) {
    $stud = $_GET['sid'];
    $bed = $_POST['sel_bed'];

    if (empty($bed)) {
        echo "<script>alert('Please select a bed');</script>";
    } else {
        // Check if student already assigned
        $checkQry = "SELECT * FROM tbl_assignstudent WHERE student_id='$stud'";
        $checkRes = $Con->query($checkQry);

        if ($checkRes->num_rows > 0) {
            echo "<script>alert('Student already assigned to a bed');</script>";
        } else {
            $insQry = "INSERT INTO tbl_assignstudent (student_id, bed_id) VALUES ('$stud', '$bed')";
            if ($Con->query($insQry)) {
                echo "<script>alert('Student Assigned to Bed Successfully'); window.location='StudentList.php';</script>";
            } else {
                echo "<script>alert('Error: " . $Con->error . "');</script>";
            }
        }
    }
}

// Remove Assignment
if (isset($_GET['Delid'])) {
    $delQry = "DELETE FROM tbl_assignstudent WHERE assignstudent_id='" . $_GET['Delid'] . "'";
    if ($Con->query($delQry)) {
        echo "<script>alert('Bed Assignment Removed'); window.location='Assignstudent.php?sid=" . $_GET['sid'] . "';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Assign Student</title>
<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
    font-family: Arial, sans-serif;
}
.container-custom {
    max-width: 800px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
}
.table thead {
    background: #2e86de;
    color: #fff;
    text-align: center;
}
.table tbody td {
    text-align: center;
    vertical-align: middle;
}
select.form-select {
    width: 100%;
}
.btn-custom {
    min-width: 100px;
}
</style>
</head>
<body>

<div class="container container-custom">
    <h2>Assign Bed to Student</h2>

    <?php
    // Check if student already assigned
    $selQry = "SELECT a.*, b.bed_no FROM tbl_assignstudent a 
               INNER JOIN tbl_bed b ON a.bed_id=b.bed_id 
               WHERE student_id='" . $_GET['sid'] . "'";
    $res = $Con->query($selQry);

    if ($data = $res->fetch_assoc()) {
    ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Assigned Bed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $data['bed_no']; ?></td>
                        <td>
                            <a href="Assignstudent.php?Delid=<?php echo $data['assignstudent_id']; ?>&sid=<?php echo $_GET['sid']; ?>" 
                               class="btn btn-danger btn-sm btn-custom"
                               onclick="return confirm('Are you sure you want to remove this bed assignment?');">
                               ❌ Remove
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
    } else {
    ?>
        <form method="post">
            <div class="mb-3 row">
                <label for="sel_bed" class="col-sm-3 col-form-label fw-bold">Select Bed</label>
                <div class="col-sm-9">
                    <select name="sel_bed" id="sel_bed" class="form-select">
                        <option value="">--Select Bed--</option>
                        <?php
                        $selbed = "SELECT * FROM tbl_bed";
                        $selResult = $Con->query($selbed);
                        while ($selRow = $selResult->fetch_assoc()) {
                            echo "<option value='{$selRow['bed_id']}'>{$selRow['bed_no']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" name="btn_submit" value="Assign Bed" class="btn btn-primary btn-custom me-2">
                <input type="reset" value="Cancel" class="btn btn-secondary btn-custom">
            </div>
        </form>
    <?php } ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include("Footer.php"); ?>
