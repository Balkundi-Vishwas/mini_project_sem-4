<?php

session_start();

include "session_login.php";

$sname = $_SESSION['sname'];
$silver = $_POST['sseats'];
$gold = $_POST['gseats'];
$diamond = $_POST['dseats'];

include_once "../Shared/connection.php";
$query = "INSERT into division(sname, class, num_seat) values('$sname', 'silver', $silver);";
$res = mysqli_query($conn, $query);
if (!$res)
{
    echo "<script>alert('Unknown error has occured, please try again!')</script>";
    echo "<script>history.back()</script>";
}
$query = "INSERT into division(sname, class, num_seat) values('$sname', 'gold', $gold);";
$res = mysqli_query($conn, $query);
if (!$res)
{
    echo "<script>alert('Unknown error has occured, please try again!')</script>";
    echo "<script>history.back()</script>";
}
$query = "INSERT into division(sname, class, num_seat) values('$sname', 'diamond', $diamond);";
$res = mysqli_query($conn, $query);
if (!$res)
{
    echo "<script>alert('Unknown error has occured, please try again!')</script>";
    echo "<script>history.back()</script>";
}
echo "<script>alert('Stadium added!')</script>";
header("refresh: 0; url = 'option_page.html'");

?>