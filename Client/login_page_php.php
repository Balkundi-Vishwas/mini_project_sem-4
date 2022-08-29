<?php 

$mobile = $_POST['mobile'];
$pass1 = $_POST['password'];

include_once "../Shared/connection.php";
$query = "SELECT * from user where mobile = $mobile;";
$sql_obj = mysqli_query($conn, $query);
$isExist = mysqli_num_rows($sql_obj);

if($isExist == 1)
{
    $row = mysqli_fetch_assoc($sql_obj);
    $pass2 = $row['pass'];

    if($pass2 == $pass1)
    {
        ?><script> alert("User Login Successful!"); </script><?php
        session_start();

        $_SESSION['user_login'] = true;
        $sql_obj = mysqli_query($conn, "SELECT * from user where mobile=$mobile;");
        $row = mysqli_fetch_assoc($sql_obj);
        $uid = $row['uid'];
        $_SESSION['user'] = $uid;
        header('location:home_page.php');
    }
    else
    {
        ?><script>
            alert("Password Incorrect, please enter the correct password!");
            window.location='login_page.php';
        </script><?php
    }
}
else
{
    ?>
    <script>
        alert("Number not registered, please register!");
        window.location='register_page_html.php';
    </script>
    <?php
}

?>