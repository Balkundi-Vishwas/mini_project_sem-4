<?php

session_start();

include "admin_session_login.php";
include_once "../Shared/connection.php";

$old_sname = $_GET['old_sname'];
$sname = $_POST['sname'];
$address = $_POST['address'];
$city = $_POST['city'];
$diamond = $_POST['diamond'];
$gold = $_POST['gold'];
$silver = $_POST['silver'];

if (isset($_FILES['simage']) && !empty($_FILES['simage']['name']))
{
    $img = $_FILES['simage'];
    $tmp_name = $img['tmp_name'];
    $error=$img['error'];
    if($error)
    {
        echo"<script>alert('Upload failed, please try again')</script>";
        header('refresh: 0; url = "view_stadium.php"');
        die;
    }
    
    $old_jpg_name = $old_sname.".jpg";
    unlink("../Images/$old_jpg_name");
    $jpg_name = $sname.".jpg";
    move_uploaded_file($tmp_name, "../Images/$jpg_name");
}
else
{
    $old_jpg_name = $old_sname.".jpg";
    $jpg_name = $sname.".jpg";
    rename("../Images/$old_jpg_name", "../Images/$jpg_name");
}

$query = "UPDATE stadium set sname = '$sname', simage = '$jpg_name', address = '$address', city = '$city' where sname = '$old_sname';";
$result1 = mysqli_query($conn, $query);
$query = "UPDATE division set sname = '$sname', diamond = $diamond, gold = $gold, silver = $silver where sname = '$old_sname';";
$result2 = mysqli_query($conn, $query);

if ($result1 == true && $result2 == true)
{
    echo "<script>alert('Stadium updated!')</script>";
    header("refresh: 0; url = 'view_stadium.php'");
}
else
{
    echo "<script>alert('Could not update stadium due to unknown error, please try again!')</script>";
    header('refresh: 0; url = "view_stadium.php"');
    die;
}

?>