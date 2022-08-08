<?php

session_start();

include "session_login.php";

include_once "../Shared/connection.php";

$sname = $_POST['sname'];
$address = $_POST['address'];
$city = $_POST['city'];

if (isset($_FILES['simage']) && !empty($_FILES['simage']['name']))
{
    $img = $_FILES['simage'];
    $tmp_name = $img['tmp_name'];
    $error=$img['error'];
    if($error)
    {
        echo"<h3>Upload Failed Try again</h3>";
        die;
    }
    
    $jpg_name = $sname.".jpg";
    unlink("../Images/$jpg_name");
    move_uploaded_file($tmp_name,"../Images/$jpg_name");
    $query = "UPDATE stadium set sname = '$sname', simage = '$jpg_name', address = '$address', city = '$city' where sname = '$sname';";
    $result = mysqli_query($conn, $query);
}
else
{
    $query = "UPDATE stadium set sname = '$sname', address = '$address', city = '$city' where sname = '$sname';";
    $result = mysqli_query($conn, $query);
}

if ($result==true)
{
    echo "<script>alert('Stadium updated!')</script>";
    header("refresh: 0; url = 'option_page.html'");
}
else echo "failure";

?>