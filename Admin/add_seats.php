<?php

$silver = $_POST['sseats'];
$gold = $_POST['gseats'];
$diamond = $_POST['dseats'];

include_once "../Shared/connection.php";
$query = "insert into admin(, uname, pass) values('$name','$uname','$pass');";
$result = mysqli_query($conn, $query);


?>