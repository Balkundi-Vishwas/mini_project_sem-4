<?php

// include "session_login.php";
include_once "../Shared/connection.php";

echo "<script>confirm('Are you sure you want to delete the stadium?')</script>";
// header("refresh: 4");

// if($choice)
// {
//     $sname = $_GET['sname'];
//     $query = "DELETE from stadium where sname = '$sname';";
//     $result = mysqli_query($conn, $cmd);

//     if ($result)
//     {
//         echo "<script>alert('Stadium deleted')</script>";
//         header("refresh: 0; url = 'option_page.html'");
//     }
//     else
//     {
//         echo "<script>alert('Unknown error has occured, please try again!')</script>";
//         header("refresh: 0; url = 'option_page.html'");
//     }
// }
// else
// {
//     header("location: option_page.html");
// }

?>