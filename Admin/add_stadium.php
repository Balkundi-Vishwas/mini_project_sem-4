<?php
// Array ( [name] => aothd.jpg [full_path] => aothd.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\php5BDB.tmp [error] => 0 [size] => 160076 )

include_once "../Shared/connection.php";

if (!isset($_FILES['simage']) && !isset($_POST['sname']) && !isset($_POST['address']) && !isset($_POST['city']))
{
    echo "<h2>no image has been uploaded, please add an image</h2>";
    echo "<script>history.back</script>";
}

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
$query = "insert into stadium(sname, simage, address, city) values('$sname', '$jpg_name', '$address', '$city');";

$result = mysqli_query($conn, $query);

if ($result)
{
    echo "<script>alert('Stadium Added Successfully')</script>";
    header('refresh: 0; url = "option_page.html"');
}
else echo "failure";

?>