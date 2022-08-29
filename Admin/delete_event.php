<?php

session_start();

include "admin_session_login.php";
include_once "../Shared/connection.php";

$eid = $_GET['eid'];
$sql_delpho = mysqli_query($conn, "SELECT * from sport_event where eid = $eid;");
$row = mysqli_fetch_assoc($sql_delpho);
$photo = $row['eimg'];
$sql_status=mysqli_query($conn,"DELETE from sport_event where eid = $eid;");


if($sql_status == true)
{
    unlink("../Images/$photo");
    ?><script>alert('Event deleted!')</script><?php
    header('refresh: 0; url="view_sport_event.php"');
}
else
{
    ?><script>alert('Could not delete event due to unknown error, please try again')</script><?php
    header('refresh: 0; url="view_sport_event.php"');
}
?>