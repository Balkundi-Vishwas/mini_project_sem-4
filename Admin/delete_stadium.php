<?php

session_start();

include "admin_session_login.php";
include_once "../Shared/connection.php";

$sname=$_GET['sname'];

$sql_delpho = mysqli_query($conn, "SELECT * from stadium where sname = '$sname';");
$row = mysqli_fetch_assoc($sql_delpho);
$photo = $row['simg'];

$eimg = array();
$sql_deleimg = mysqli_query($conn, "SELECT * from sport_event where sname = '$sname';");
$count = mysqli_num_rows($sql_deleimg);
for ($i = 0; $i < $count; $i++)
{
    $row = mysqli_fetch_assoc($sql_deleimg);
    $eimg[$i] = $row['eimg'];
}
$sql_status = mysqli_query($conn,"DELETE from stadium where sname = '$sname';");

if($sql_status == true)
{
    unlink("../Images/$photo");
    for ($i = 0; $i < $count; $i++)
    {
        $selimg = $eimg[$i];
        unlink("../Images/$selimg");
    }
    ?><script>alert('Stadium deleted!')</script><?php
    header('refresh: 0; url="view_stadium.php"');
}
else
{
    ?><script>alert('Could not delete stadium due to unknown error, please try again')</script><?php
    header('refresh: 0; url="view_stadium.php"');
}



?>

