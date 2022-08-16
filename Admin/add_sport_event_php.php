<?php

session_start();

include "admin_session_login.php";
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
$result = mysqli_query($conn, $query);

$sql_obj = mysqli_query($conn, "SELECT * from sport_event where ename = '$ename' and edate = '$edate';");
$eid = mysqli_fetch_assoc($sql_obj)['eid'];

$countd = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from division where sname = '$sname';"))['diamond'];
for ($i = 1; $i <= $countd; $i++)
{
    $query2="INSERT into ticket_price(eid, class, seatnum, price, occupied) values($eid, 'diamond', $i, $dprice, 0);";
    mysqli_query($conn, $query2);
}

$countg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gold from division where sname = '$sname';"))['gold'];
for ($i = 1; $i <= $countg; $i++)
{
    $query3="INSERT into ticket_price(eid, class, seatnum, price, occupied) values($eid, 'gold', $i, $gprice, 0);";
    mysqli_query($conn, $query3);
}

$counts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT silver from division where sname = '$sname';"))['silver'];
for ($i = 1; $i <= $counts; $i++)
{
    $query4="INSERT into ticket_price(eid, class, seatnum, price, occupied) values($eid, 'silver', $i, $sprice, 0);";
    mysqli_query($conn, $query4);
}

if ($result == true)
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