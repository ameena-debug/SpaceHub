<?php

include("../Assets/Connection/Connection.php");
include("Header.php");
	$selQry="select * from tbl_complaint where complaint_id='".$_GET['cid']."'";
	
    $result=$Con->query($selQry);
	
      $rowdata=$result->fetch_assoc();

if(isset($_POST['btn_submit']))
{
	$reply=$_POST['txt_reply'];
	$upQry="update tbl_complaint set complain_reply='".$reply."' ,complaint_status=1 where complaint_id='".$_GET['cid']."'";
	
	if($Con->query($upQry))
		{
			?>
			<script>
			alert("updated");
			window.location="ViewComplaint.php";
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
<title>Complaint Reply</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #2980b9, #6dd5fa);
    padding: 30px;
    margin: 0;
    color: #333;
}

/* Form container */
form {
    max-width: 450px;
    margin: 50px auto;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    padding: 0;
}

/* Form header */
form h2 {
    text-align: center;
    margin: 0;
    padding: 15px;
    color: #fff;
    background-color: #2c3e50;
    border-radius: 15px 15px 0 0;
}

/* Table inside form */
form table {
    width: 100%;
    border-collapse: collapse;
    padding: 20px;
}

form table td {
    padding: 12px;
    border: 1px solid #ccc;
}

/* First column bold */
form table td:first-child {
    font-weight: bold;
    width: 30%;
}

/* Input styling */
form input[type="text"] {
    width: 100%;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Submit button */
form input[type="submit"] {
    background-color: #27ae60;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s;
}

form input[type="submit"]:hover {
    background-color: #1e8449;
}

/* Zebra stripe for rows */
form table tr:nth-child(even) td {
    background-color: #f9f9f9;
}

/* Center submit button */
form table td[colspan="2"] {
    text-align: center;
}
</style>

</head>
<body>

<form id="form1" name="form1" method="post" action="">
  <h2>Reply to Complaint</h2>
  <table>
    <tr>
      <td>Title</td>
      <td><?php echo $rowdata['complain_title']?></td>
    </tr>
    <tr>
      <td>Content</td>
      <td><?php echo $rowdata['complain_content']?></td>
    </tr>
    <tr>
      <td>Reply</td>
      <td><input type="text" name="txt_reply" id="txt_reply" /></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>

<?php
include("Footer.php");
?>

</body>
</html>



