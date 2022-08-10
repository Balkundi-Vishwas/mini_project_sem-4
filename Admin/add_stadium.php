<?php

session_start();

include "../Shared/session_login.php";
include_once "../Shared/connection.php";

$sname = $_POST['sname'];
$address = $_POST['address'];
$city = $_POST['city'];

$silver = $_POST['sseats'];
$gold = $_POST['gseats'];
$diamond = $_POST['dseats'];

$query = "SELECT sname from Stadium where sname = '$sname';";
$sql_obj = mysqli_query($conn, $query);
$row = mysqli_num_rows($sql_obj);

if ($row)
{
    echo "<script>alert('Stadium already existing!')</script>" ;
    header('refresh: 0; url ="add_stadium.html"');
    die;
}

$img = $_FILES['simage'];
$tmp_name = $img['tmp_name'];
$error = $img['error'];
if($error)
{
    echo"<script>alert('Upload failed, please try again')</script>";
    header('refresh: 0; url = "add_stadium.html"');
    die;
}

$jpg_name = $sname.".jpg";
move_uploaded_file($tmp_name, "../Images/$jpg_name");
$query = "INSERT into stadium(sname, simage, address, city) values('$sname', '$jpg_name', '$address', '$city');";

$result = mysqli_query($conn, $query);

if (!$result)
{
    echo "<script>alert('Could not add stadium due to unknown error, please try again!')</script>";
    header('refresh: 0; url = "add_stadium.html"');
    die;
}

$query = "INSERT into division(sname, diamond, gold, silver) values('$sname', $diamond, $gold, $silver);";
$result = mysqli_query($conn, $query);
if (!$result)
{
    echo "<script>alert('Could not add stadium due to unknown error, please try again!')</script>";
    header('refresh: 0; url = "add_stadium.html"');
    die;
}

echo "<script>alert('Stadium added!')</script>";
header("refresh: 0; url = 'option_page.html'");

?>