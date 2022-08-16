<?php 

$mobile = $_POST['mobile'];
$pass1 = $_POST['password'];

include_once "../Shared/connection.php";
$result = $conn->query("SELECT * from user where mobile=$mobile;") or die($conn->error);
$isExist = $result->num_rows;
$row = $result->fetch_array($isExist);
$pass2 = $row['upass'];

if($isExist == 1)
{
    if($pass2 == $pass1)
    {
        ?>
        <script>
            alert("User Login Successful!");
        </script>
        <?php
        $_SESSION['user_login'] = true;
        header('location:home_page.php');
    }
    else
    {
        ?>
        <script>
            alert("Password Incorrect, please enter the correct password!");
            window.location='login_page.php';
        </script>
        <?php
    }
}
else
{
    ?>
    <script>
        alert("Number not registered, please register!");
        window.location='register_page.php';
    </script>
    <?php
}

?>