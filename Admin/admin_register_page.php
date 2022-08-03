<?php

include_once "../Shared/connection.php";
if (!isset($_POST['aname']) || !isset($_POST['uname']) || !isset($_POST['pass']))
{
    echo "validation failed";
    header('location:admin_register_page.html');
    die;
}
else{
$name = $_POST['aname']; 
$uname = $_POST['uname'];
$pass = $_POST['pass'];

$query = "insert into admin(aname, uname, pass) values('$name','$uname','$pass');";
$result = mysqli_query($conn, $query);
if ($result)
    header('location:admin_login_page.php');
else echo "failure";
}
?>