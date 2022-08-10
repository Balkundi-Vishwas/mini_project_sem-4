<?php

session_start();

include "../Shared/session_login.php";
include_once "../Shared/connection.php";

$old_ename = $_GET['old_ename'];
$old_edate = $_GET['old_edate'];
$ename = $_POST['ename'];
$sname = $_POST['sname'];
$edate = $_POST['edate'];
$stime = $_POST['stime'];
$edesc = $_POST['edesc'];
$dprice=$_POST['dprice'];
$gprice=$_POST['gprice'];
$sprice=$_POST['sprice'];

if (isset($_FILES['eimage']) && !empty($_FILES['eimage']['name']))
{
    $img = $_FILES['eimage'];
    $tmp_name = $img['tmp_name'];
    $error=$img['error'];
    if($error)
    {
        echo"<h3>Upload Failed Try again</h3>";
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

$query = "UPDATE sport_event set ename = '$ename', edate = '$edate', eimage = '$jpg_name', stime = '$stime', sname = '$sname', e_desc = '$edesc' where ename = '$old_ename' and edate = '$old_edate';";
$result = mysqli_query($conn, $query);
$query1="UPDATE ticket_price set ename='$ename', edate='$edate',dprice=$dprice,gprice=$gprice,sprice=$sprice where ename = '$old_ename' and edate = '$old_edate'; ";
$result2=mysqli_query($conn, $query1);
if ($result == true && $result==true)
{
    echo "<script>alert('Event updated!')</script>";
    header("refresh: 0; url = 'view_sport_event.php'");
}
else echo "failure";

?>