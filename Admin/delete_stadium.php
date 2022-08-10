<?php

session_start();

include "../Shared/session_login.php";
include_once "../Shared/connection.php";

$sname=$_GET['sname'];

$sql_del_event = mysqli_query($conn, "SELECT * from sport_event where sname = '$sname';");
$count = mysqli_num_rows($sql_del_event);
for ($i = 0; $i < $count; $i++)
{
    $row = mysqli_fetch_assoc($sql_del_event);
    $ename = $row['ename'];
    $edate = $row['edate'];
    header("../Admin/delete_event.php?ename=$ename&edate=$edate");
}

$sql_delpho = mysqli_query($conn, "SELECT * from stadium where sname = '$sname';");
$row = mysqli_fetch_assoc($sql_delpho);
$photo = $row['simage'];
$sql_status = mysqli_query($conn,"DELETE from stadium where sname = '$sname';");

if($sql_status == true)
{
    unlink("../Images/$photo"); 
    echo "<script>alert('Stadium deleted!')</script>";
    header('refresh: 10; url="view_stadium.php"');
}
else
{
    echo "<script>alert('Could not delete stadium due to unknown error, please try again')</script>";
    header('refresh: 0; url="view_stadium.php"');
}



?>

