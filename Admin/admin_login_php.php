<?php

session_start();

if (!isset($_POST['uname']) || !isset($_POST['password']))
{
    echo "<script>alert('Username or Password Field Empty!')</script>";
    header("refresh: 0; url = 'admin_login_page.php'");
}

include_once "../Shared/connection.php";

$uname = $_POST['uname'];
$pass = $_POST['password'];

$query = "SELECT * from admin where uname = '$uname' and pass = '$pass';";
$sql_obj = mysqli_query($conn, $query);
$isExist = mysqli_num_rows($sql_obj);

if ($isExist)
{
    $_SESSION['admin_login'] = true;
    header('location: option_page.html');
}
else
{
    echo "<script>alert('Invalid Username or Password!')</script>";
    header("refresh: 0; url = 'admin_login_page.php'");
}

?>