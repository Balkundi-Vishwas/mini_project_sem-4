<?php

session_start();

if (!isset($_POST['uname']) || !isset($_POST['password']))
{
    ?>
    <script>alert('Username or Password Field Empty!');</script>
    <?php
    header("refresh: 0; url = 'admin_login_page_html.php'");
}

include_once "../Shared/connection.php";

$uname = $_POST['uname'];
$pass = $_POST['password'];

$query = "SELECT * from admin where uname = '$uname';";
$sql_obj = mysqli_query($conn, $query);
$isExist = mysqli_num_rows($sql_obj);

if ($isExist)
{
    $pass1 = mysqli_fetch_assoc($sql_obj)['pass'];
    if ($pass1 == $pass)
    {
        ?>
        <script>alert("User Login Successful!");</script>
        <?php

        $_SESSION['admin_login'] = true;
        header('location: view_sport_event.php');
    }
    else
    {
        ?>
        <script>
            alert("Password Incorrect, please enter the correct password!");
            window.location='admin_login_page_html.php';
        </script>
        <?php
    }
}
else
{
    ?>
    <script>alert('Username not registered, please register!');</script>
    <?php
    header("refresh: 0; url = 'admin_login_page_html.php'");
}

?>