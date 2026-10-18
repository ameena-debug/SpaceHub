<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$title ="";
$content ="";
$Edid=0;

if(isset($_POST['btn_submit']))
{
	$title=$_POST['txt_title'];
	$content = $_POST['txt_content'];
	if($Edid == 0)
	{
		$insQry="insert into tbl_complaint(complain_title,complain_content,student_id) values(' ".$title." ',' ".$content." ','".$_SESSION['sid']."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Inserted");
			window.location="Complaint.php";
			</script>
			<?php
		}
	}
}

if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_complaint where complaint_id='".$_GET['Delid']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted");
		window.location="Complaint.php";
		</script>
        <?php
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint</title>

<style type="text/css">
  body {
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #2980b9, #6dd5fa);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  form {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 0;
  }

  table {
    width: 500px;
    background-color: #fff;
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    padding: 20px;
    border-collapse: separate;
    border-spacing: 0 15px;
  }

  td {
    padding: 12px;
    font-size: 15px;
  }

  td[colspan="2"] {
    text-align: center;
  }

  input[type="text"], textarea {
    width: 95%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
  }

  textarea {
    height: 200px; /* ⬅️ Larger typing area */
    resize: vertical; /* allows resizing */
  }

  input[type="submit"] {
    background-color: #2980b9;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 5px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #1f618d;
  }

  a {
    color: #2980b9;
    text-decoration: none;
    font-weight: 600;
  }

  a:hover {
    color: #1f618d;
    text-decoration: underline;
  }

  .complaint-table {
    width: 80%;
    margin: 30px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.2);
    padding: 15px;
  }

  .complaint-table th, .complaint-table td {
    text-align: center;
    padding: 12px;
  }

  .complaint-table th {
    background: #2980b9;
    color: white;
  }

</style>
</head>

<body>

<!-- Complaint Form -->
<form id="form1" name="form1" method="post" action="">
  <table>
    <tr>
      <td>Title</td>
      <td><input type="text" name="txt_title" id="txt_title" /></td>
    </tr>
    <tr>
      <td>Content</td>
      <td>
        <!-- Changed to textarea for larger typing area -->
        <textarea name="txt_content" id="txt_content"></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>
</form>

<!-- Complaint List -->
<form id="form2" name="form2" method="post" action="">
  <table class="complaint-table" border="1">
    <tr>
      <th>S.NO</th>
      <th>Title</th>
      <th>Content</th>
      <th>Reply</th>
      <th>Action</th>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_complaint where student_id='".$_SESSION['sid']."'";
	$result=$Con->query($selQry);
	while($row=$result->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $row['complain_title']?></td>
      <td><?php echo $row['complain_content']?></td>
      <td><?php echo $row['complain_reply']?></td>
      <td><a href="Complaint.php?Delid=<?php echo $row['complaint_id']?>"
             onclick="return confirm('Are you sure you want to delete this complaint?');">Delete</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>

<?php
include("Footer.php");
?>
