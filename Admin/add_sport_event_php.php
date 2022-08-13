<?php

session_start();

include "../Shared/session_login.php";
include_once "../shared/connection.php";

$ename = $_POST['ename'];
$edate = $_POST['edate'];
$img = $_FILES['eimage'];
$dprice=$_POST['dprice'];
$gprice=$_POST['gprice'];
$sprice=$_POST['sprice'];


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
$jpg_name = $ename.$edate.".jpg";

$query = "SELECT * from sport_event where ename = '$ename' and edate = '$edate';";
$sql_obj = mysqli_query($conn, $query);
$isExist = mysqli_num_rows($sql_obj);
if ($isExist)
{
    echo "<script>alert('Event already existing!')</script>" ;
    header('refresh: 0; url ="add_sport_event.html"');
    die;
}

$query = "INSERT into sport_event(ename, eimage, edate, stime, sname, e_desc) values('$ename', '$jpg_name', '$edate', '$stime', '$sname', '$desc');";
$query2="INSERT into ticket_price(ename,edate,dprice,gprice,sprice)values('$ename','$edate',$dprice,$gprice,$sprice);";
$result = mysqli_query($conn, $query);
$result1=mysqli_query($conn, $query2);
if ($result == true && $result1==true)
{
    move_uploaded_file($tmp_name,"../Images/$jpg_name");
    echo "<script>alert('Event added!')</script>";
    header('refresh: 0; url = "option_page.html"');
}
else
{
    echo "<script>alert('could not add event, please try again!')</script>";
    header('refresh: 0; url = "add_sport_event.php"');
}

?>