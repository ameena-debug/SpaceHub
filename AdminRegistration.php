<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$admin = "";
$Email = "";
$Password = "";
$Edid = 0;

if (isset($_POST['btn_submit'])) {
    $admin = $_POST['txt_name'];
    $Email = $_POST['txt_email'];
    $Password = $_POST['txt_password'];
    $Edid = $_POST['txt_Edid'];

    // Check if email already exists (for new records only)
    $selQry = "SELECT * FROM tbl_admin WHERE admin_email='" . $Email . "'";
    $rowadmin = $Con->query($selQry);

    if ($rowadmin && $rowadmin->num_rows > 0 && $Edid == 0) {
        echo "<script>alert('Already exists'); window.location='AdminRegistration.php';</script>";
    } else {
        if ($Edid == 0) {
            // INSERT query
            $insQry = "INSERT INTO tbl_admin(admin_name, admin_email, admin_password) 
                       VALUES('" . $admin . "', '" . $Email . "', '" . $Password . "')";
            if ($Con->query($insQry)) {
                echo "<script>alert('Record Saved'); window.location='AdminRegistration.php';</script>";
            } else {
                // Debug any database error
                echo "<script>alert('Insert failed: " . addslashes($Con->error) . "');</script>";
            }
        } else {
            // UPDATE query
            $upQry = "UPDATE tbl_admin 
                      SET admin_name='" . $admin . "', 
                          admin_email='" . $Email . "', 
                          admin_password='" . $Password . "' 
                      WHERE admin_id='" . $Edid . "'";
            if ($Con->query($upQry)) {
                echo "<script>alert('Updated'); window.location='AdminRegistration.php';</script>";
            } else {
                echo "<script>alert('Update failed: " . addslashes($Con->error) . "');</script>";
            }
        }
    }
}

// DELETE
if (isset($_GET['Delid'])) {
    $delQry = "DELETE FROM tbl_admin WHERE admin_id='" . $_GET['Delid'] . "'";
    if ($Con->query($delQry)) {
        echo "<script>alert('Deleted'); window.location='AdminRegistration.php';</script>";
    } else {
        echo "<script>alert('Delete failed: " . addslashes($Con->error) . "');</script>";
    }
}

// EDIT
if (isset($_GET['Edid'])) {
    $selEdit = "SELECT * FROM tbl_admin WHERE admin_id=" . $_GET['Edid'];
    $resultEdit = $Con->query($selEdit);
    if ($resultEdit && $resultEdit->num_rows > 0) {
        $rowEdit = $resultEdit->fetch_assoc();
        $admin = $rowEdit['admin_name'];
        $Edid = $rowEdit['admin_id'];
        $Email = $rowEdit['admin_email'];
        $Password = $rowEdit['admin_password'];
    }
}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Registration</title>
</head> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Registration</title>
<style>
  body {
    background: linear-gradient(to right, #0c334eff, #6dd5fa);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  a {
    color: #3498db;
    text-decoration: none;
    font-weight: 600;
  }
  a:hover {
    text-decoration: underline;
  }

  form {
    max-width: 600px;
    margin: 20px auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
  }

  h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 15px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 10px 12px;
    text-align: center;
    font-size: 14px;
  }

  th {
    background-color: #042f4bff;
    color: #fff;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.5px;
  }

  tr:nth-child(even) {
    background-color: #f8f9fa;
  }

  tr:hover {
    background-color: #f1f7fd;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 95%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    margin-top: 4px;
  }

  input[type="submit"] {
    background: #3498db;
    color: #fff;
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
  }

  input[type="submit"]:hover {
    background: #217dbb;
  }
</style>
</head>
<body>

<a href="Homepage.php"></a>

<form id="form1" name="form1" method="post" action="">
  <h2>Admin Registration</h2>
  <table>
    <tr>
      <td>Name</td>
      <td>
        <input type="text" name="txt_name" id="txt_name2" 
               value="<?php echo $admin; ?>" placeholder="Enter the admin name" required/>
        <input type="hidden" name="txt_Edid" id="txt_Edid" value="<?php echo $Edid; ?>" />
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td>
        <input type="email" name="txt_email" id="txt_email" 
               value="<?php echo $Email; ?>" placeholder="Enter Email" required />
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td>
        <input type="text" name="txt_password" id="txt_password" 
               value="<?php echo $Password; ?>" placeholder="Enter Password" required />
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>
</form>

<form id="form2" name="form2" method="post" action="">
  <h2>Admin List</h2>
  <table>
    <tr>
      <th>SI.NO</th>
      <th>Name</th>
      <th>Email</th>
      <th colspan="2">Action</th>
    </tr>
    <?php
    $i = 0;
    $selQry = "SELECT * FROM tbl_admin";
    $result = $Con->query($selQry);
    while ($row = $result->fetch_assoc()) {
      $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row['admin_name']; ?></td>
      <td><?php echo $row['admin_email']; ?></td>
      <td><a href="AdminRegistration.php?Delid=<?php echo $row['admin_id']; ?>">Delete</a></td>
      <td><a href="AdminRegistration.php?Edid=<?php echo $row['admin_id']; ?>">Edit</a></td>
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
