<?php
include("../Assets/Connection/Connection.php");
include("Header.php");


if(isset($_GET['Aid']))
{
	$upQry="update tbl_student set student_status=1 where student_id='".$_GET['Aid']."'";
	if($Con->query($upQry))
	{
		?>
        <script>
		alert("Student Accepted");
		window.location="ViewStudentlist.php";
		</script>
        <?php
	}
}
if(isset($_GET['Rid']))
{
	$upQry="update tbl_student set student_status=2 where student_id='".$_GET['Rid']."'";
	if($Con->query($upQry))
	{
		?>
        <script>
		alert("Student Rejected");
		window.location="ViewStudentlist.php";
		</script>
        <?php
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>View Student List</title>
<style>
    /* Body */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(to right, #2980b9, #6dd5fa);
        margin: 0;
        padding: 0;
        color: #333;
    }

    /* Container */
    .container {
        width: 95%;
        max-width: 1200px;
        margin: 50px auto;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        padding: 30px;
    }

    /* Header */
    .container h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #fff;
        background-color: #1b2631; /* Darker header for readability */
        padding: 15px;
        border-radius: 15px 15px 0 0;
        font-size: 24px;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        table-layout: auto;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #2e86de;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
    }

    tr:nth-child(even) td {
        background-color: #f9f9f9;
    }

    /* Student photo */
    img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }

    /* Action buttons */
    .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
        color: white;
        margin: 2px;
        transition: 0.3s;
        display: inline-block;
    }

    .accept {
        background-color: #27ae60;
    }
    .accept:hover {
        background-color: #1e8449;
    }

    .reject {
        background-color: #e74c3c;
    }
    .reject:hover {
        background-color: #c0392b;
    }

    /* Responsive */
    @media (max-width: 768px) {
        table, th, td {
            font-size: 12px;
        }
        img {
            width: 50px;
            height: 50px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <h2>Student List</h2>
    <form id="form1" name="form1" method="post" action="">
      <table>
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
          <th>Action</th>
        </tr>
        <?php
        $i=0;
        $selQry="select * from tbl_student s 
                 inner join tbl_course c on s.course_id = c.course_id 
                 inner join tbl_department d on c.department_id=d.department_id 
                 inner join tbl_semester m on s.semester_id=m.semester_id 
                 inner join tbl_academicyear a on s.academicyear_id=a.academicyear_id";
        $result=$Con->query($selQry);
        while($studentdata=$result->fetch_assoc())
        {
            $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $studentdata['student_name']?></td>
          <td><?php echo $studentdata['student_email']?></td>
          <td><?php echo $studentdata['student_contact']?></td>
          <td>
            <img src="../Assets/Files/Student/<?php echo $studentdata['student_photo']?>" alt="Student Photo">
          </td>
          <td><?php echo $studentdata['department_name']?></td>
          <td><?php echo $studentdata['course_name']?></td>
          <td><?php echo $studentdata['semester_name']?></td>
          <td><?php echo $studentdata['academicyear_name']?></td>
          <td>
            <a href="ViewStudentlist.php?Aid=<?php echo $studentdata['student_id']?>" class="action-btn accept">Accept</a>
            <a href="ViewStudentlist.php?Rid=<?php echo $studentdata['student_id']?>" class="action-btn reject">Reject</a>
          </td>
        </tr>
        <?php
        }
        ?>
      </table>
    </form>
</div>
</body>
</html>



<?php
include("Footer.php");
?>
