<?php

session_start();

include_once "../Shared/connection.php";
include "session_login.php";

$uid=$_SESSION['user'];
$tid = $_GET['tid'];

$query = "SELECT b.eid from ticket_info t, booking b where t.tid = $tid and t.uid = $uid and t.bid = b.bid;";
$eid = mysqli_fetch_assoc(mysqli_query($conn, $query))['eid'];

$query = "UPDATE booking set occupied = 0 where bid in
(SELECT b.bid from booking b, ticket_info t where b.eid = $eid and t.bid = b.bid and t.uid = $uid);";
$updated_booking = mysqli_query($conn, $query);

$query = "DELETE from ticket_info where tid in
(SELECT t.tid from ticket_info t, booking b where b.eid = $eid and t.bid = b.bid and t.uid = $uid);";
$ticket_deleted = mysqli_query($conn, $query);

if ($updated_booking != 0 && $ticket_deleted != 0)
{
    ?><script>
        alert("Ticket deleted successfully!");
        window.location='see_tickets.php';
    </script><?php
}
else
{
    ?>
    <script>alert("Could not delete ticket due to unknown error, please try again!")</script>
    <?php
    header("refresh: 0; url = 'see_tickets.php'");
    die;
}

?>