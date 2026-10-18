<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

if (isset($_GET['Aid'])) {
    $upQry = "UPDATE tbl_student SET student_status=2 WHERE student_id='" . $_GET['Aid'] . "'";
    if ($Con->query($upQry)) {
        echo "<script>alert('Student Status Updated'); window.location='StudentList.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Student List</title>
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: #f4f7f8;
    font-family: Arial, sans-serif;
    padding: 20px;
    color: #333;
}

/* Container heading */
h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
}

/* Card/Form styling */
.card {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Table Styling like timetable */
.table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}

.table th, .table td {
    padding: 12px;
    border: 1px solid #ccc;
    text-align: center;
}

.table thead th {
    background-color: #3498db; /* timetable header color */
    color: #fff;
    font-weight: bold;
    font-size: 15px;
}

.table tbody tr:nth-child(even) td {
    background-color: #f9f9f9; /* zebra stripes */
}

.table tbody tr:hover td {
    background-color: #f1f7fd; /* hover effect */
}

/* Student Photo */
.student-photo {
    width: 70px;
    height: 70px;
    border-radius: 5px;
    object-fit: cover;
    border: 1px solid #ccc;
}

/* Action Links like Delete button in timetable */
.btn-assign, .btn-view, .btn-revoke {
    display: inline-block;
    padding: 6px 12px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    transition: background 0.3s;
    font-size: 14px;
    margin: 2px;
}

.btn-assign:hover, .btn-view:hover, .btn-revoke:hover {
    background-color: #2980b9;
}

/* Form inputs styling */
form select, form input[type="submit"] {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

form input[type="submit"] {
    background-color: #27ae60;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

form input[type="submit"]:hover {
    background-color: #1e8449;
}
</style>

</head>
<body>

<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Student List</h2>

    <!-- Search Form -->
    <div class="card p-3 shadow-sm mb-4">
        <form method="get" action="">
            <div class="row align-items-center">
                <div class="col-md-4 offset-md-2">
                    <label for="room_id" class="form-label fw-bold">Search Students by Room</label>
                    <select name="room_id" id="room_id" class="form-select">
                        <option value="">--Select Room--</option>
                        <?php
                        $roomQry = "SELECT * FROM tbl_room";
                        $roomResult = $Con->query($roomQry);
                        while ($room = $roomResult->fetch_assoc()) {
                            $selected = (isset($_GET['room_id']) && $_GET['room_id'] == $room['room_id']) ? "selected" : "";
                            echo "<option value='{$room['room_id']}' $selected>{$room['room_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 mt-4 mt-md-0">
                    <input type="submit" value="Search" class="btn btn-success w-100">
                </div>
            </div>
        </form>
    </div>

    <!-- Student Table -->
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Photo</th>
                    <th>Department</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Academic Year</th>
                    <th>Bed / Room</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;

                $selQry = "
                SELECT s.*, c.course_name, d.department_name, m.semester_name, a.academicyear_name,
                       asg.assignstudent_id, b.bed_no, b.bed_id, r.room_name
                FROM tbl_student s
                INNER JOIN tbl_course c ON s.course_id = c.course_id
                INNER JOIN tbl_department d ON c.department_id = d.department_id
                INNER JOIN tbl_semester m ON s.semester_id = m.semester_id
                INNER JOIN tbl_academicyear a ON s.academicyear_id = a.academicyear_id
                LEFT JOIN tbl_assignstudent asg ON s.student_id = asg.student_id
                LEFT JOIN tbl_bed b ON asg.bed_id = b.bed_id
                LEFT JOIN tbl_room r ON b.room_id = r.room_id
                ";

                if (isset($_GET['room_id']) && $_GET['room_id'] != "") {
                    $selQry .= " WHERE r.room_id = '" . $_GET['room_id'] . "'";
                }

                $result = $Con->query($selQry);
                while ($studentdata = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $studentdata['student_name'] ?></td>
                    <td><?php echo $studentdata['student_email'] ?></td>
                    <td><?php echo $studentdata['student_contact'] ?></td>
                    <td>
                        <img src="../Assets/Files/Student/<?php echo $studentdata['student_photo'] ?>" width="70" height="70" class="student-photo" alt="Photo">
                    </td>
                    <td><?php echo $studentdata['department_name'] ?></td>
                    <td><?php echo $studentdata['course_name'] ?></td>
                    <td><?php echo $studentdata['semester_name'] ?></td>
                    <td><?php echo $studentdata['academicyear_name'] ?></td>
                    <td>
                        <?php
                        if ($studentdata['bed_id']) {
                            echo $studentdata['bed_no'] . " (" . ($studentdata['room_name'] ?? "Room Not Assigned") . ")";
                        } else {
                            echo '<span class="text-danger fw-bold">Not Assigned</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="Assignstudent.php?sid=<?php echo $studentdata['student_id'] ?>" class="btn btn-sm btn-assign btn-custom">Assign</a>
                        <a href="Leave.php?sid=<?php echo $studentdata['student_id'] ?>" class="btn btn-sm btn-view btn-custom">View Leave</a>
                        <a href="StudentList.php?Aid=<?php echo $studentdata['student_id'] ?>" class="btn btn-sm btn-revoke btn-custom">Revoke</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include("Footer.php"); ?>
