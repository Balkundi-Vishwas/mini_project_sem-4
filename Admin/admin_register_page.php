<?php

include_once "../Shared/connection.php";

if (!isset($_POST['aname']) || !isset($_POST['uname']) || !isset($_POST['pass']))
{
    echo "<script>alert('one or more fields empty!')</script>";
    header("refresh: 0; url = 'admin_register_page.html'");
}
if ($_POST['pass'] != $_POST['pass1'])
{
    echo "<script>alert('passwords not matching!')</script>";
    header("refresh: 0; url = 'admin_register_page.html'");
}

$name = $_POST['aname']; 
$uname = $_POST['uname'];
$pass = $_POST['pass'];

$query = "insert into admin(aname, uname, pass) values('$name','$uname','$pass');";
$result = mysqli_query($conn, $query);

if ($result)
    header('location:admin_login_page.php');
else
{
    echo "<script> alert('An unknown error occured, please try again')</script>";
}

?>