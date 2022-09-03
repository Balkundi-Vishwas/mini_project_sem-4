<?php

session_start();

include_once "../Shared/connection.php";
include "option_page.html";
include "session_login.php";

$tid = $_GET['tid'];

$query = "SELECT u.uname, u.mobile, u.address as uaddress, e.ename, e.eimg, time_format(etime, '%h:%i %p')
as etime, date_format(edate, '%D %b %Y, %a') as edate, s.sname, s.simg, s.address as saddress, s.city, b.bid, u.uid
from user u, sport_event e, stadium s, ticket_info t, seat d, booking b
where t.tid = $tid and t.bid = b.bid and t.uid = u.uid and b.seat_id = d.seat_id and b.eid = e.eid and
d.sname = s.sname;";

$sql_obj = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql_obj);

$uname = $row['uname'];
$mobile = $row['mobile'];
$uaddress = $row['uaddress'];
$ename = $row['ename'];
$eimage = $row['eimg'];
$edate = $row['edate'];
$stime = $row['etime'];
$sname = $row['sname'];
$simage = $row['simg'];
$saddress = $row['saddress'];
$city = $row['city'];
$bid = $row['bid'];
$uid = $row['uid'];

$query = "SELECT e.eid from booking b, sport_event e where b.bid = $bid and b.eid = e.eid;";

$sql_obj = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql_obj);
$eid = $row['eid'];

$dia = [];
$query = "SELECT d.seat_num from user u, sport_event e, booking b, ticket_info t, seat d where u.uid = $uid
and e.eid = $eid and d.class = 'diamond' and t.uid = u.uid and t.bid = b.bid and b.eid = e.eid and
b.seat_id = d.seat_id order by d.seat_num;";
$sql_obj = mysqli_query($conn, $query);
$count = mysqli_num_rows($sql_obj);

for ($i = 0; $i < $count; $i++)
{
    $row = mysqli_fetch_assoc($sql_obj);
    $seat = $row['seat_num'];
    array_push($dia, $seat);
}
$dia = implode(", ", $dia);


$gold = [];
$query = "SELECT d.seat_num from user u, sport_event e, booking b, ticket_info t, seat d where u.uid = $uid
and e.eid = $eid and d.class = 'gold' and t.uid = u.uid and t.bid = b.bid and b.eid = e.eid and
b.seat_id = d.seat_id order by d.seat_num;";
$sql_obj = mysqli_query($conn, $query);
$count = mysqli_num_rows($sql_obj);

for ($i = 0; $i < $count; $i++)
{
    $row = mysqli_fetch_assoc($sql_obj);
    $seat = $row['seat_num'];
    array_push($gold, $seat);
}
$gold = implode(", ", $gold);

$sil = [];
$query = "SELECT d.seat_num from user u, sport_event e, booking b, ticket_info t, seat d where u.uid = $uid
and e.eid = $eid and d.class = 'silver' and t.uid = u.uid and t.bid = b.bid and b.eid = e.eid and
b.seat_id = d.seat_id order by d.seat_num;";
$sql_obj = mysqli_query($conn, $query);
$count = mysqli_num_rows($sql_obj);

for ($i = 0; $i < $count; $i++)
{
    $row = mysqli_fetch_assoc($sql_obj);
    $seat = $row['seat_num'];
    array_push($sil, $seat);
}
$sil = implode(", ", $sil);

$query = "SELECT sum(b.price) as price from user u, sport_event e, booking b, ticket_info t, seat d
where u.uid = $uid and e.eid = $eid and t.uid = u.uid and t.bid = b.bid and b.eid = e.eid and
b.seat_id = d.seat_id;";
$sql_obj = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql_obj);
$price = $row['price'];

?>
<!DOCTYPE html>
<html>
    <head>

        <title>View/Print Ticket</title>

    </head>
    <body class="printb">

        <div class="d-flex flex-wrap justify-content-center mt-5 d-print-none">
            <button class="btn btn-success" onclick="window.print()"><a class="noul">Print Ticket</a></button>
        </div>
        <div class='d-flex flex-wrap justify-content-center'>
            <div class='card m-5 p-5 bgimg' style='width:500px;' align = 'center'>
                <h2><b><u> STADIUM SEAT BOOKING </u></b></h2>
                <div>
                    <h4><b><u>Customer Details</u></b></h4>
                    <b> <?php echo $uname ?> </b><br>
                    <?php echo $mobile ?> <br>
                    <?php echo $uaddress ?> <br>
                </div>
                <div>
                    <h4><b><u>Event Details</u></b></h4>
                    <h5><b> <?php echo $ename ?> </b></h5><br>
                    <img src='../Images/<?php echo $eimage ?>' width='300px' class='rounded border border-dark'> <br><br>
                    <b> <?php echo $edate ?>, <?php echo $stime ?> </b><br>
                </div>
                <div>
                    <h4><b><u>Location Details</u></b></h4>
                    <h6><b><?php echo $sname ?> </b></h6>
                    <img src='../Images/<?php echo $simage ?>' width='200px' class='rounded border border-dark'><br><br>
                    <?php echo $saddress ?> <br>
                    <?php echo $city ?> <br>
                </div>
                <div>
                    <div>
                        <b>Diamond Seats: <?php echo $dia?> <br>
                        Gold Seats: <?php echo $gold ?> <br>
                        Silver Seats: <?php echo $sil ?> </b><br>
                    </div>
                    <h4><b>Total Price:&#x20B9 <?php echo $price ?> </b></h4> <br>
                </div>
            </div>
        </div>

  </body>
</html>