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

if (isset($_FILES['simg']) && !empty($_FILES['simg']['name']))
{
    $img = $_FILES['simg'];
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

$query = "UPDATE stadium set sname = '$sname', simg = '$jpg_name', address = '$address', city = '$city' where sname = '$old_sname';";
$result = mysqli_query($conn, $query);

$diamond_db = mysqli_num_rows(mysqli_query($conn, "SELECT * from seat where sname = '$sname' and class = 'diamond';"));
if ($diamond < $diamond_db)
{
    for ($i = 1; $i <= $diamond_db - $diamond; $i++)
    {
        $query = "DELETE from seat where sname = '$sname' and class = 'diamond' and seat_num = ($i + $diamond);";
        $result = mysqli_query($conn, $query);
        if (!$result)
        {
            ?><script>alert('Could not edit stadium due to unknown error, please try again!')</script><?php
            header('refresh: 0; url = "view_stadium.php"');
            die;
        }
    }
}
else
{
    for ($i = 1; $i <= $diamond - $diamond_db; $i++)
    {
        $query = "INSERT into seat(sname, class, seat_num) values('$sname', 'diamond', ($i + $diamond_db));";
        $result = mysqli_query($conn, $query);
        if (!$result)
        {
            ?><script>alert('Could not edit stadium due to unknown error, please try again!')</script><?php
            header('refresh: 0; url = "view_stadium.php"');
            die;
        }
    }
}

$gold_db = mysqli_num_rows(mysqli_query($conn, "SELECT * from seat where sname = '$sname' and class = 'gold';"));
if ($gold < $gold_db)
{
    for ($i = 1; $i <= $gold_db - $gold; $i++)
    {
        $query = "DELETE from seat where sname = '$sname' and class = 'gold' and seat_num = ($i + $gold);";
        $result = mysqli_query($conn, $query);
        if (!$result)
        {
            ?><script>alert('Could not edit stadium due to unknown error, please try again!')</script><?php
            header('refresh: 0; url = "view_stadium.php"');
            die;
        }
    }
}
else
{
    for ($i = 1; $i <= $gold - $gold_db; $i++)
    {
        $query = "INSERT into seat(sname, class, seat_num) values('$sname', 'gold', ($i + $gold_db));";
        $result = mysqli_query($conn, $query);
        if (!$result)
        {
            ?><script>alert('Could not edit stadium due to unknown error, please try again!')</script><?php
            header('refresh: 0; url = "view_stadium.php"');
            die;
        }
    }
}

$silver_db = mysqli_num_rows(mysqli_query($conn, "SELECT * from seat where sname = '$sname' and class = 'silver';"));
if ($silver < $silver_db)
{
    for ($i = 1; $i <= $silver_db - $silver; $i++)
    {
        $query = "DELETE from seat where sname = '$sname' and class = 'silver' and seat_num = ($i + $silver);";
        $result = mysqli_query($conn, $query);
        if (!$result)
        {
            ?><script>alert('Could not edit stadium due to unknown error, please try again!')</script><?php
            header('refresh: 0; url = "view_stadium.php"');
            die;
        }
    }
}
else
{
    for ($i = 1; $i <= $silver - $silver_db; $i++)
    {
        $query = "INSERT into seat(sname, class, seat_num) values('$sname', 'silver', ($i + $silver_db));";
        $result = mysqli_query($conn, $query);
        if (!$result)
        {
            ?><script>alert('Could not edit stadium due to unknown error, please try again!')</script><?php
            header('refresh: 0; url = "view_stadium.php"');
            die;
        }
    }
}

if ($result == true)
{
    ?><script>alert('Stadium updated!')</script><?php
    header("refresh: 0; url = 'view_stadium.php'");
}
else
{
    ?><script>alert('Could not update stadium due to unknown error, please try again!')</script><?php
    header('refresh: 0; url = "view_stadium.php"');
    die;
}

?>