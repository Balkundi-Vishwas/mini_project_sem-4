<?php
// Array ( [name] => aothd.jpg [full_path] => aothd.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\php5BDB.tmp [error] => 0 [size] => 160076 )
include_once "../Shared/connection.php";

if (!isset($_FILES['simage']))
{
    echo "no image";
}

$img = $_FILES['simage'];
$imname = $img['name'];
$sname = $_POST['sname'];
$address = $_POST['address'];
$city = $_POST['city'];

move_uploaded_file($imname, "../Images/".$img);
$query = "insert into stadium(sname, simage, address, city) values('$sname', '$imname', '$address', '$city');";

$result = mysqli_query($conn, $query);

if ($result)
{
    echo "successful";
}
else echo "failure";

?>