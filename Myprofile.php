<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$selQry = "SELECT * FROM tbl_student s 
            INNER JOIN tbl_course c ON s.course_id = c.course_id 
            INNER JOIN tbl_department d ON c.department_id = d.department_id 
            INNER JOIN tbl_semester m ON s.semester_id = m.semester_id 
            INNER JOIN tbl_academicyear a ON s.academicyear_id = a.academicyear_id 
            WHERE student_id='" . $_SESSION['sid'] . "'";

$studentrow = $Con->query($selQry);
$studentdata = $studentrow->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Profile</title>

<!-- ✅ Bootstrap for modern design -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style type="text/css">
  body {
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #2980b9, #6dd5fa);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  .profile-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
    max-width: 600px;
    margin: 60px auto;
    padding: 40px 30px;
    text-align: center;
    transition: 0.3s ease;
  }

  .profile-card:hover {
    transform: scale(1.01);
  }

  .profile-photo {
    border-radius: 10px;
    border: 3px solid #2980b9;
    max-height: 150px;
    width: auto;
    margin-bottom: 20px;
  }

  .profile-table {
    width: 100%;
    margin-top: 10px;
  }

  .profile-table td {
    padding: 10px 8px;
    font-size: 15px;
    border-bottom: 1px solid #e0e0e0;
    text-align: left;
  }

  .profile-table td:first-child {
    font-weight: 600;
    color: #2980b9;
    width: 40%;
  }

  .btn-profile {
    margin: 15px 10px 0 10px;
    background-color: #2980b9;
    border: none;
    color: #fff;
    padding: 8px 18px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    font-weight: 500;
  }

  .btn-profile:hover {
    background-color: #1f618d;
    color: #fff;
  }
</style>
</head>

<body>

<div class="container">
  <div class="profile-card">
    <img src="../Assets/Files/Student/<?php echo $studentdata['student_photo']; ?>" alt="Profile Photo" class="profile-photo" />

    <table class="profile-table">
      <tr>
        <td>Name</td>
        <td><?php echo $studentdata['student_name']; ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?php echo $studentdata['student_email']; ?></td>
      </tr>
      <tr>
        <td>Contact</td>
        <td><?php echo $studentdata['student_contact']; ?></td>
      </tr>
      <tr>
        <td>Department</td>
        <td><?php echo $studentdata['department_name']; ?></td>
      </tr>
      <tr>
        <td>Course</td>
        <td><?php echo $studentdata['course_name']; ?></td>
      </tr>
      <tr>
        <td>Semester</td>
        <td><?php echo $studentdata['semester_name']; ?></td>
      </tr>
      <tr>
        <td>Academic Year</td>
        <td><?php echo $studentdata['academicyear_name']; ?></td>
      </tr>
    </table>

    <div class="mt-3">
      <a class="btn-profile" href="Editprofile.php">Edit Profile</a>
      <a class="btn-profile" href="ChangePassword.php">Change Password</a>
    </div>
  </div>
</div>

</body>
</html>

<?php
include("Footer.php");
?>
