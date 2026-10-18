<?php
include("../Assets/Connection/Connection.php");
include("Header.php");


$selQry="select * from tbl_student where student_id='".$_SESSION['sid'] ."'";
$row=$Con->query($selQry);
$data=$row->fetch_assoc();
if (isset($_POST["txt_name"])) 
  {
    $name = $_POST["txt_name"];
} 
else 
  {
    $name = "";
}
if (isset($_POST["txt_email"])) {
    $email = $_POST["txt_email"];
} else {
    $email = "";
}
if (isset($_POST["txt_contact"])) 
  {
    $contact = $_POST["txt_contact"];
} 
else 
  {
    $contact = "";
}


if(isset($_POST['btn_update']))
{
$upQry = "update  tbl_student set student_name = '".$name."',student_email='".$email."',student_contact='".$contact."' where student_id='".$_SESSION['sid'] ."'"; 
if($Con->query($upQry))
		{
			?>
			<script>
			alert("updated");
			window.location="Myprofile.php";
			</script>
			<?php
		}
}


?>





























<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EditProfile</title>
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
    padding: 50px 0;
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

  img {
    display: block;
    margin: 20px auto;
    border-radius: 10px;
    border: 3px solid #2980b9;
    max-height: 150px;
  }
   a:hover {
    background-color: #1f618d;
  }
</style>

</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" required  value="<?php echo $data['student_name'] ?>"/></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" required value="<?php echo $data['student_email']?>"/></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" required  pattern="[7-9]{1}[0-9]{9}" value="<?php echo $data['student_contact']?>" title="Phone number with 7-9 and remaing 9 digit with 0-9"/></td>
    </tr>
    
    
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_update" id="btn_update" value="update" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
include("Footer.php");
?>