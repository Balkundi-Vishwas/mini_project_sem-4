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
    ?><h3>Upload Failed, Try again</h3><?php
    die;
}
$sname = $_POST['sname'];
$etime = $_POST['etime'];
$desc = $_POST['edesc'];
$jpg_name = $ename.$edate.".jpg";

$query = "SELECT * from sport_event where edate = '$edate' and etime = '$etime' and sname = '$sname';";
$sql_obj = mysqli_query($conn, $query);
$isExist = mysqli_num_rows($sql_obj);
if ($isExist)
{
    ?><script>alert("An event already exists in the stadium during the time and date mentioned!")</script><?php
    header("refresh: 0; url ='add_sport_event_html.php'");
    die;
}

$query = "INSERT into sport_event(ename, eimg, edate, etime, sname, edesc) values('$ename', '$jpg_name', '$edate', '$etime', '$sname', '$desc');";
$result = mysqli_query($conn, $query);

$sql_obj = mysqli_query($conn, "SELECT * from sport_event where ename = '$ename' and edate = '$edate';");
$eid = mysqli_fetch_assoc($sql_obj)['eid'];

$query = "SELECT * from seat where sname = '$sname' and class = 'diamond';";
$sql_obj = mysqli_query($conn, $query);
$diamond = mysqli_num_rows($sql_obj);

for ($i = 0; $i < $diamond; $i++)
{
    $seat_id = mysqli_fetch_assoc($sql_obj)['seat_id'];
    $query = "INSERT into booking(seat_id, eid, price, occupied) values($seat_id, $eid, $dprice, 0);";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert("Could not add sport event due to unknown error, please try again!")</script><?php
        header("refresh: 0; url = 'add_sport_event_html.php'");
        die;
    }
}

$query = "SELECT * from seat where sname = '$sname' and class = 'gold';";
$sql_obj = mysqli_query($conn, $query);
$gold = mysqli_num_rows($sql_obj);

for ($i = 0; $i < $gold; $i++)
{
    $seat_id = mysqli_fetch_assoc($sql_obj)['seat_id'];
    $query = "INSERT into booking(seat_id, eid, price, occupied) values($seat_id, $eid, $gprice, 0);";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert('Could not add sport event due to unknown error, please try again!')</script><?php
        header('refresh: 0; url = "add_sport_event_html.php"');
        die;
    }
}

$query = "SELECT * from seat where sname = '$sname' and class = 'silver';";
$sql_obj = mysqli_query($conn, $query);
$silver = mysqli_num_rows($sql_obj);

for ($i = 0; $i < $silver; $i++)
{
    $seat_id = mysqli_fetch_assoc($sql_obj)['seat_id'];
    $query = "INSERT into booking(seat_id, eid, price, occupied) values($seat_id, $eid, $sprice, 0);";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert("Could not add sport event due to unknown error, please try again!")</script><?php
        header("refresh: 0; url = 'add_sport_event_html.php'");
        die;
    }
}

if ($result == true)
{
    move_uploaded_file($tmp_name,"../Images/$jpg_name");
    ?><script>alert("Event added!")</script><?php
    header("refresh: 0; url = 'view_sport_event.php'");
}
else
{
    ?><script>alert("could not add event, please try again!")</script><?php
    header("refresh: 0; url = 'add_sport_event.php'");
}

?>