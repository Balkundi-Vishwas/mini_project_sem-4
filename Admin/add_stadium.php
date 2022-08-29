<?php

session_start();

include "admin_session_login.php";
include_once "../Shared/connection.php";

$sname = $_POST['sname'];
$address = $_POST['address'];
$city = $_POST['city'];

$silver = $_POST['silver'];
$gold = $_POST['gold'];
$diamond = $_POST['diamond'];

$query = "SELECT sname from stadium where sname = '$sname';";
$sql_obj = mysqli_query($conn, $query);
$isExist = mysqli_num_rows($sql_obj);

if ($isExist)
{
    ?><script>alert('Stadium already existing!')</script><?php
    header('refresh: 0; url ="add_stadium.html"');
    die;
}

$img = $_FILES['simg'];
$tmp_name = $img['tmp_name'];
$error = $img['error'];
if($error)
{
    ?><script>alert('Upload failed, please try again')</script><?php
    header('refresh: 0; url = "add_stadium.html"');
    die;
}

$jpg_name = $sname.".jpg";
move_uploaded_file($tmp_name, "../Images/$jpg_name");
$query = "INSERT into stadium(sname, simg, address, city) values('$sname', '$jpg_name', '$address', '$city');";

$result = mysqli_query($conn, $query);

if (!$result)
{
    ?><script>alert('Could not add stadium due to unknown error, please try again!')</script><?php
    header('refresh: 0; url = "add_stadium.html"');
    die;
}
for ($i = 1; $i <= $diamond; $i++)
{
    $query = "INSERT into seat(sname, class, seat_num) values('$sname', 'diamond', $i);";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert('Could not add stadium due to unknown error, please try again!')</script><?php
        header('refresh: 0; url = "add_stadium.html"');
        die;
    }
}

for ($i = 1; $i <= $gold; $i++)
{
    $query = "INSERT into seat(sname, class, seat_num) values('$sname', 'gold', $i);";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert('Could not add stadium due to unknown error, please try again!')</script><?php
        header('refresh: 0; url = "add_stadium.html"');
        die;
    }
}

for ($i = 1; $i <= $silver; $i++)
{
    $query = "INSERT into seat(sname, class, seat_num) values('$sname', 'silver', $i);";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert('Could not add stadium due to unknown error, please try again!')</script><?php
        header('refresh: 0; url = "add_stadium.html"');
        die;
    }
}

?><script>alert('Stadium added!')</script><?php
header("refresh: 0; url = 'view_stadium.php'");

?>