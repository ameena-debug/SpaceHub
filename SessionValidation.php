<?php
session_start();
if($_SESSION['wid'] == "")
{
    header('location:../Guest/Login.php');
}
?>