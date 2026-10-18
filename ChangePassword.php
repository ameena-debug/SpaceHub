<?php
include("../Assets/Connection/Connection.php");

include("Header.php");

$selqry = "select * from tbl_warden where warden_id='" . $_SESSION['wid'] . "'";
$row = $Con->query($selqry);
$data = $row->fetch_assoc();
$pass = $data['warden_passwd'];

if (isset($_POST['btn_cpassword'])) {
    $old = $_POST['txt_opassword'];
    $new = $_POST['txt_npassword'];
    $rpass = $_POST['txt_rpassword'];

    if ($pass == $old) {
        if ($new == $rpass) {
            $upQry = "update tbl_warden set warden_passwd='" . $new . "' where warden_id='" . $_SESSION['wid'] . "'";
            if ($Con->query($upQry)) {
?>
                <script>
                    alert("Password changed");
                    window.location = "../Guest/Login.php";
                </script>
<?php
            }
        } else {
            echo "<script>alert('New and Re-Type password do not match');</script>";
        }
    } else {
        echo "<script>alert('Invalid current password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Change Password</title>
<style>
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
    padding: 80px 0;
  }

  table {
    width: 450px;
    background-color: #fff;
    border-radius: 12px;
    border-collapse: collapse;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    padding: 20px;
  }

  th {
    text-align: center;
    padding: 15px;
    background-color: #3498db;
    color: #fff;
    font-size: 20px;
    border-radius: 12px 12px 0 0;
  }

  td {
    padding: 12px;
    font-size: 15px;
  }

  input[type="password"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
  }

  input[type="submit"], input[type="reset"] {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    color: #fff;
    cursor: pointer;
    font-weight: bold;
    margin-right: 10px;
    transition: background-color 0.3s;
  }

  input[type="submit"] {
    background-color: #3498db;
  }

  input[type="submit"]:hover {
    background-color: #2980b9;
  }

  input[type="reset"] {
    background-color: #e74c3c;
  }

  input[type="reset"]:hover {
    background-color: #c0392b;
  }

</style>
</head>

<body>

<form id="form1" name="form1" method="post" action="">
  <table border="0">
    <tr>
      <th colspan="2">Change Password</th>
    </tr>
    <tr>
      <td>Old Password</td>
      <td><input type="password" name="txt_opassword" id="txt_opassword" required  value="<?php echo $data['warden_passwd'] ?>"/></td>
    </tr>
    <tr>
      <td>New Password</td>
      <td><input type="password" name="txt_npassword" id="txt_npassword" required /></td>
    </tr>
    <tr>
      <td>Re-Type Password</td>
      <td><input type="password" name="txt_rpassword" id="txt_rpassword" required /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_cpassword" id="btn_cpassword" value="Change Password" />
        <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </td>
    </tr>
  </table>
</form>

</body>
</html>

<?php
include("Footer.php");
?>

