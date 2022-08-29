<?php

session_start();

include_once "../Shared/connection.php";
include "session_login.php";

$uid = $_SESSION['user'];
$arr = $_POST['arr'];
$count = 0;
$bid = reset($arr);

for ($i = 0; $i < count($arr); $i++)
{
    if ($bid != 0)
    {
        $query = "UPDATE booking set occupied = 1 where bid = $bid;";
        mysqli_query($conn, $query);
        $query = "INSERT into ticket_info (bid, uid) values ($bid, $uid);";
        mysqli_query($conn, $query);
        $count++;
    }
    $bid = next($arr);
}
if ($count == 0)
{
    ?> <script>
        alert("Please select one or more seats!") 
        history.back();
    </script> <?php
    die;
}

$query = "SELECT tid from ticket_info where bid = $bid and uid = $uid;";
$tid = mysqli_fetch_assoc(mysqli_query($conn, $query))['tid'];

?>
<html>
    <style>
        body
        {
            font-family: 'Times New Roman', Times, serif !important;
        }  
    </style>
    <body>
        <h3>Do you want to print the ticket?</h3>
        <button><a href='print.php?tid=<?php echo $tid ?>'>Print Ticket</a></button>
    </body>
</html>
