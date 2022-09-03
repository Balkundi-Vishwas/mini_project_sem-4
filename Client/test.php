<?php

include_once "../Shared/connection.php";

$uid = 1;
$tid = 9;

$query = "SELECT b.eid from ticket_info t, booking b where t.tid = $tid and t.uid = $uid and t.bid = b.bid;";
$eid = mysqli_fetch_assoc(mysqli_query($conn, $query))['eid'];

echo $eid;
echo "<br>";

$query = "SELECT b.bid from booking b, ticket_info t where b.eid = $eid and t.bid = b.bid and t.uid = $uid;";
$booked = mysqli_query($conn, $query);
$count = mysqli_num_rows($booked);
echo $count;
echo "<br>";

for ($i = 1; $i <= $count; $i++)
{
    $row = mysqli_fetch_assoc($booked);
    print_r($row);
    echo "<br>";
}

$query = "SELECT t.tid from ticket_info t, booking b where b.eid = $eid and t.bid = b.bid and t.uid = $uid;";
$ticket = mysqli_query($conn, $query);
$tcount = mysqli_num_rows($ticket);
echo $tcount;
echo "<br>";

for ($i = 1; $i <= $count; $i++)
{
    $row = mysqli_fetch_assoc($ticket);
    print_r($row);
    echo "<br>";
}

// if ($result != 0 && $result1 != 0)
// {
//     ?><script>
//         alert("ticket deleted successfully");
//         window.location='see_tickets.php';
//     </script><?php
// }
// else
// {
    // ?>
    <!-- <script>alert("Could not delete ticket due to unknown error, please try again!")</script> -->
    <?php
//     header("refresh: 0; url = 'see_tickets.php'");
//     die;
// }

?>