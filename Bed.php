<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$bedNo = "";
$roomId = 0;
$Edid = 0;

// Insert or Update Bed
if(isset($_POST['btn_submit']))
{
    $bedNo = $_POST['txt_bed'];
    $roomId = $_POST['sel_room'];
    $Edid = $_POST['txt_Edid'];

    if($Edid == 0)
    {
        // Check if bed exists
        $selQry = "SELECT * FROM tbl_bed WHERE bed_no='".$bedNo."' AND room_id='".$roomId."'";
        $result = $Con->query($selQry);
        if($result->fetch_assoc())
        {
            ?>
            <script>
                alert("Bed already exists in this room");
                window.location="Bed.php";
            </script>
            <?php
        }
        else
        {
            $insQry = "INSERT INTO tbl_bed (bed_no, room_id) VALUES('".$bedNo."', '".$roomId."')";
            if($Con->query($insQry))
            {
                ?>
                <script>
                    alert("Bed inserted successfully");
                    window.location="Bed.php";
                </script>
                <?php
            }
        }
    }
    else
    {
        $upQry = "UPDATE tbl_bed SET bed_no='".$bedNo."', room_id='".$roomId."' WHERE bed_id='".$Edid."'";
        if($Con->query($upQry))
        {
            ?>
            <script>
                alert("Bed updated successfully");
                window.location="Bed.php";
            </script>
            <?php
        }
    }
}

// Delete Bed
if(isset($_GET['Delid']))
{
    $delQry = "DELETE FROM tbl_bed WHERE bed_id='".$_GET['Delid']."'";
    if($Con->query($delQry))
    {
        ?>
        <script>
            alert("Bed deleted successfully");
            window.location="Bed.php";
        </script>
        <?php
    }
}

// Edit Bed
if(isset($_GET['Edid']))
{
    $selEdit = "SELECT * FROM tbl_bed WHERE bed_id='".$_GET['Edid']."'";
    $resultEdit = $Con->query($selEdit);
    $rowEdit = $resultEdit->fetch_assoc();
    $bedNo = $rowEdit['bed_no'];
    $roomId = $rowEdit['room_id'];
    $Edid = $rowEdit['bed_id'];
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Bed Management</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f8f9fa;
    padding: 30px 0;
    font-family: Arial, sans-serif;
}
.form-container, .table-container {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}
.table-container table th, .table-container table td {
    vertical-align: middle !important;
}
.btn-clear {
    background-color: #dc3545;
    color: #fff;
}
.btn-clear:hover {
    background-color: #c82333;
    color: #fff;
}
.table-container tbody tr:hover td {
    background-color: #f1f7fd;
}

/* Add this at the end */
.table-container table th {
    background-color: #09334fff;
    color: white;
}
</style>

</head>
<body>
<div class="container">

    <!-- Bed Input Form -->
    <div class="form-container">
        <h3 class="mb-4"><?php echo ($Edid == 0) ? "Add Bed" : "Edit Bed"; ?></h3>
        <form method="post" action="">
            <div class="mb-3 row">
                <label for="sel_room" class="col-sm-2 col-form-label">Room</label>
                <div class="col-sm-10">
                    <select name="sel_room" id="sel_room" class="form-select" required>
                        <option value="">--Select Room--</option>
                        <?php
                        $selRoom = "SELECT * FROM tbl_room";
                        $selResult = $Con->query($selRoom);
                        while($selRow = $selResult->fetch_assoc())
                        {
                            $selected = ($roomId == $selRow['room_id']) ? "selected" : "";
                            echo '<option value="'.$selRow['room_id'].'" '.$selected.'>'.$selRow['room_name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="txt_bed" class="col-sm-2 col-form-label">Bed Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_bed" id="txt_bed" value="<?php echo $bedNo; ?>" placeholder="Enter Bed Number" required/>
                    <input type="hidden" name="txt_Edid" value="<?php echo $Edid; ?>" />
                </div>
            </div>

            <div class="text-center">
                <input type="submit" class="btn btn-primary me-2" name="btn_submit" value="Submit" />
                <a href="Bed.php" class="btn btn-clear">Clear</a>
            </div>
        </form>
    </div>

    <!-- Bed Table -->
    <div class="table-container table-responsive">
        <h3 class="mb-4">Bed Records</h3>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>S.No</th>
                    <th>Bed No</th>
                    <th>Room Name</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                $selQry = "SELECT b.bed_id, b.bed_no, r.room_name 
                           FROM tbl_bed b 
                           INNER JOIN tbl_room r ON b.room_id = r.room_id";
                $result = $Con->query($selQry);
                while($row = $result->fetch_assoc())
                {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['bed_no']; ?></td>
                        <td><?php echo $row['room_name']; ?></td>
                        <td><a href="Bed.php?Delid=<?php echo $row['bed_id']?>" class="btn btn-sm btn-danger">Delete</a></td>
                        <td><a href="Bed.php?Edid=<?php echo $row['bed_id']?>" class="btn btn-sm btn-warning text-white">Edit</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include("Footer.php"); ?>
