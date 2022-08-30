<?php

include_once "../Shared/connection.php";

$uid = 1;
$eid = 1;

$query = "SELECT d.seat_id from user u, sport_event e, booking b, ticket_info t, seat d where u.uid = $uid
and e.eid = $eid and t.uid = u.uid and t.bid = b.bid and b.eid = e.eid and
b.seat_id = d.seat_id order by d.seat_num;";

$sql_obj = mysqli_query($conn, $query);
$count = mysqli_num_rows($sql_obj);
echo $count;

?>