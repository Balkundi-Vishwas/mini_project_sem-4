
<?php

session_start();

include "session_login.php";
include_once "../Shared/connection.php";
$sname=$_GET['sname'];
$sql_delpho = mysqli_query($conn, "select * from stadiums where sname = '$sname'");
$row = mysqli_fetch_assoc($sql_delpho);
$photo = $row['simage'];
$img_status = unlink("../Images/$photo"); 
$sql_status=mysqli_query($conn,"delete from stadium where sname='$sname'");

if($sql_status && img_status )
{
    echo "<script>alert('stadium deleted')</script>";
    header('refresh:0;url="view_stadium.php"');
}
else
{
    echo "Sql query failed";
}



?>

