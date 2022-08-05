<?php
// Array ( [name] => aothd.jpg [full_path] => aothd.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\php5BDB.tmp [error] => 0 [size] => 160076 )

session_start();

include "session_login.php";

include_once "../Shared/connection.php";

$img = $_FILES['simage'];
$tmp_name = $img['tmp_name'];
$error=$img['error'];
if($error)
{
    echo"<h3>Upload Failed Try again</h3>";
    die;
}
$sname = $_POST['sname'];
$address = $_POST['address'];
$city = $_POST['city'];
$jpg_name = $sname.".jpg";
move_uploaded_file($tmp_name, "../Images/$jpg_name");
$query = "INSERT into stadium(sname, simage, address, city) values('$sname', '$jpg_name', '$address', '$city');";

$result = mysqli_query($conn, $query);

if ($result)
{
    $_SESSION['sname'] = $sname;
    header('refresh: 0; url = "add_seats.html"');
}
else echo "failure";

?>