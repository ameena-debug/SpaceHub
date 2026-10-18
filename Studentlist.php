<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student List</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(to right, #2980b9, #6dd5fa);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

form {
    margin: 60px auto;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 12px 15px;
    font-size: 14px;
    color: #333;
    text-align: center;
    vertical-align: middle;
}

/* Header row background */
table th {
    background-color: #07263bff; /* Your requested color */
    color: #fff; /* White text for contrast */
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Alternate row colors */
table tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Hover effect for rows */
table tr:hover {
    background-color: #f1f1f1;
}

a {
    text-decoration: none;
    color: #3498db;
    font-weight: 600;
    transition: 0.3s;
}

a:hover {
    color: #2980b9;
}

h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <h2>Student List</h2>
  <table class="table table-bordered table-striped text-center">
    <thead>
      <tr>
        <th>S.no</th>
        <th>NAME</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Photo</th>
        <th>Department</th>
        <th>Course</th>
        <th>Semester</th>
        <th>Academic Year</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    $selQry = "SELECT * FROM tbl_student s 
               INNER JOIN tbl_course c ON s.course_id = c.course_id 
               INNER JOIN tbl_department d ON c.department_id=d.department_id 
               INNER JOIN tbl_semester m ON s.semester_id=m.semester_id 
               INNER JOIN tbl_academicyear a ON s.academicyear_id=a.academicyear_id";
    $result = $Con->query($selQry);
    while($studentdata = $result->fetch_assoc())
    {
        $i++;
    ?>
      <tr>
        <td><?php echo $i?></td>
        <td><?php echo $studentdata['student_name']?></td>
        <td><?php echo $studentdata['student_email']?></td>
        <td><?php echo $studentdata['student_contact']?></td>
        <td><img src="../Assets/Files/Student/<?php echo $studentdata['student_photo']?>" width="60" height="60" style="border-radius:6px;"/></td>
        <td><?php echo $studentdata['department_name']?></td>
        <td><?php echo $studentdata['course_name']?></td>
        <td><?php echo $studentdata['semester_name']?></td>
        <td><?php echo $studentdata['academicyear_name']?></td>
        <td><a href="ViewLeave.php?sid=<?php echo $studentdata['student_id']?>">View Leave Report</a></td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include("Footer.php");
?>
