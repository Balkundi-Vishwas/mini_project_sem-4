<?php

session_start();

include "admin_session_login.php";
include_once "../Shared/connection.php";

$ename = $_GET['ename'];
$edate = $_GET['edate'];

$sql_delpho = mysqli_query($conn, "SELECT * from sport_event where ename = '$ename' and edate = '$edate';");
$row = mysqli_fetch_assoc($sql_delpho);
$photo = $row['eimage'];
$sql_status=mysqli_query($conn,"DELETE from sport_event where ename='$ename' and edate = '$edate';");


if($sql_status == true)
{
    unlink("../Images/$photo");
    echo "<script>alert('Event deleted!')</script>";
    header('refresh: 0; url="view_sport_event.php"');
}
else
{
    echo "<script>alert('Could not delete event due to unknown error, please try again')</script>";
    header('refresh: 0; url="view_sport_event.php"');
}
?>