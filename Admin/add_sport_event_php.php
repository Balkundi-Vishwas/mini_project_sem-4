<?php

session_start();

include "session_login.php";
include_once "../shared/connection.php";

$ename = $_POST['ename'];
$date = $_POST['edate'];
$img = $_FILES['eimage'];

$tmp_name = $img['tmp_name'];
$error = $img['error'];
if($error)
{
    echo"<h3>Upload Failed, Try again</h3>";
    die;
}
$sname = $_POST['sname'];
$stime = $_POST['stime'];
$desc = $_POST['edesc'];
$jpg_name = $ename.$date.".jpg";

$query = "INSERT into sport_event(ename, eimage, edate, stime, sname, e_desc) values('$ename', '$jpg_name', str_to_date('$date', '%Y-%m-%d'), '$stime', '$sname', '$desc');";
 move_uploaded_file($tmp_name,"../Images/$jpg_name");

$result = mysqli_query($conn, $query);

if ($result)
{
    echo "<script>alert('Event added!')</script>";
    header('refresh: 0; url = "option_page.html"');
}
else echo "failure";

?>