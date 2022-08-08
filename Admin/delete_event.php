<?php

session_start();

        include "session_login.php";
include_once "../Shared/connection.php";
$ename=$_GET['ename'];
$sql_status=mysqli_query($conn,"delete from sport_event where ename='$ename'");

if($sql_status)
{
    echo "<script>alert('sport event deleted')</script>";
    header('refresh:0;url="view_sport_event.php"');
}
else
{
    echo "Sql query failed";
}
?>