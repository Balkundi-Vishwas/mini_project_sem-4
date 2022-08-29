<?php

session_start();

include "admin_session_login.php";
include_once "../Shared/connection.php";

$eid = $_GET['eid'];
$ename = $_POST['ename'];
$sname = $_POST['sname'];
$edate = $_POST['edate'];
$etime = $_POST['etime'];
$edesc = $_POST['edesc'];
$dprice = $_POST['dprice'];
$gprice = $_POST['gprice'];
$sprice = $_POST['sprice'];

$query = "SELECT * from sport_event where eid = $eid;";
$sql_obj = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql_obj);
$old_ename = $row['ename'];
$old_edate = $row['edate'];

if (isset($_FILES['eimage']) && !empty($_FILES['eimage']['name']))
{
    $img = $_FILES['eimage'];
    $tmp_name = $img['tmp_name'];
    $error=$img['error'];
    if($error)
    {
        echo "<h3>Upload Failed, Try again!</h3>";
        die;
    }
    
    $old_jpg_name = $old_ename.$old_edate.".jpg";
    unlink("../Images/$old_jpg_name");
    $jpg_name = $ename.$edate.".jpg";
    move_uploaded_file($tmp_name,"../Images/$jpg_name");
}
else
{
    $old_jpg_name = $old_ename.$old_edate.".jpg";
    $jpg_name = $ename.$edate.".jpg";
    rename("../Images/$old_jpg_name", "../Images/$jpg_name");
}
$query = "UPDATE sport_event set ename = '$ename', edate = '$edate', eimg = '$jpg_name', etime = '$etime', sname = '$sname', edesc = '$edesc' where eid = $eid;";
$result = mysqli_query($conn, $query);
if (!$result)
{
    ?><script>alert('Could not edit sport event due to unknown error, please try again!')</script><?php
    header("refresh: 0; url = 'edit_sport_event_html.php?eid=$eid'");
    die;
}

$query = "SELECT * from seat where sname = '$sname' and class = 'diamond';";
$sql_obj = mysqli_query($conn, $query);
$dcount = mysqli_num_rows($sql_obj);

for ($i = 1; $i <= $dcount; $i++)
{
    $dseat = mysqli_fetch_assoc($sql_obj)['seat_id'];
    $query = "UPDATE booking set price = $dprice where eid = $eid and seat_id = $dseat;";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert('Could not edit sport event due to unknown error, please try again!')</script><?php
        header("refresh: 0; url = 'edit_sport_event_html.php?eid=$eid'");
        die;
    }
}

$query = "SELECT * from seat where sname = '$sname' and class = 'gold';";
$sql_obj = mysqli_query($conn, $query);
$gcount = mysqli_num_rows($sql_obj);

for ($i = 1; $i <= $gcount; $i++)
{
    $gseat = mysqli_fetch_assoc($sql_obj)['seat_id'];
    $query = "UPDATE booking set price = $gprice where eid = $eid and seat_id = $gseat;";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert('Could not edit sport event due to unknown error, please try again!')</script><?php
        header("refresh: 0; url = 'edit_sport_event_html.php?eid=$eid'");
        die;
    }
}

$query = "SELECT * from seat where sname = '$sname' and class = 'silver';";
$sql_obj = mysqli_query($conn, $query);
$scount = mysqli_num_rows($sql_obj);

for ($i = 1; $i <= $scount; $i++)
{
    $sseat = mysqli_fetch_assoc($sql_obj)['seat_id'];
    $query = "UPDATE booking set price = $sprice where eid = $eid and seat_id = $sseat;";
    $result = mysqli_query($conn, $query);
    if (!$result)
    {
        ?><script>alert('Could not edit sport event due to unknown error, please try again!')</script><?php
        header("refresh: 0; url = 'edit_sport_event_html.php?eid=$eid'");
        die;
    }
}

if ($result == true)
{
    echo "<script>alert('Event updated!')</script>";
    header("refresh: 0; url = 'view_sport_event.php'");
}
else echo "failure";

?>