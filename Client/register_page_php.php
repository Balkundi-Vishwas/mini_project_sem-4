<?php 

include '../Shared/connection.php';


$name = $_POST['name'];
$mobile = $_POST['mobile'];
$pass1 = $_POST['password'];
$pass2 = $_POST['con_pass'];
$email = $_POST['email'];
$address = $_POST['address'];

$result = $conn->query("SELECT * from user where mobile=$mobile;") or die($conn->error);
$isExist = $result->num_rows;
if($isExist > 0)
{
    ?>
    <script>
        alert("Number Already Registered\nPlease login");
        window.location='login_page_html.php';</script>
    <?php
    die;
}
else if (strlen($mobile) <>10 OR substr($mobile, 0, 1) < 6)
{
    ?>
    <script>
        alert('Please enter valid mobile number');
        window.location='register_page.php';
    </script>
    <?php
    die;
}
else if($pass1 == $pass2)
{
    $conn->query("INSERT into user(uname, mobile, upass, email, address) values('$name', '$mobile', '$pass1', '$email', '$address');") or die($conn->error);
    ?>
    <script>
        alert("Registered Successfully");
        window.location='login_page.php';
    </script>
    <?php
}
else
{
    ?>
    <script>
        alert("Password Not Matched");
        window.location='register_page.php';
    </script>
    <?php
    die;
}

?>