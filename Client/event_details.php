<?php

session_start();

include_once "../Shared/connection.php";
include "session_login.php";
include "option_page.html";

$eid = $_GET['eid'];

$query = "SELECT * from sport_event where eid = $eid;";
$event = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($event);

$ename = $row['ename'];
$imgname = $row['eimg'];
$sname = $row['sname'];
$etime = $row['etime'];
$edate = $row['edate'];
$desc = $row['edesc'];

$query = "SELECT * from stadium where sname = '$sname';";
$stadium = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($stadium);

$simg = $row['simg'];
$scity = $row['city'];
$saddr = $row['address'];

$query = "SELECT b.price from booking b, seat d where b.eid = $eid and b.seat_id = d.seat_id and d.class = 'diamond';";
$dprice = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];
$query = "SELECT b.price from booking b, seat d where b.eid = $eid and b.seat_id = d.seat_id and d.class = 'gold';";
$gprice = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];
$query = "SELECT b.price from booking b, seat d where b.eid = $eid and b.seat_id = d.seat_id and d.class = 'silver';";
$sprice = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];

$query = "SELECT count(b.occupied) as d_occ from booking b, seat d where b.eid = $eid and b.seat_id = d.seat_id and d.class = 'diamond' and b.occupied = 0;";
$dseats = mysqli_fetch_assoc(mysqli_query($conn, $query))['d_occ'];
$query = "SELECT count(b.occupied) as g_occ from booking b, seat d where b.eid = $eid and b.seat_id = d.seat_id and d.class = 'gold' and b.occupied = 0;";
$gseats = mysqli_fetch_assoc(mysqli_query($conn, $query))['g_occ'];
$query = "SELECT count(b.occupied) as s_occ from booking b, seat d where b.eid = $eid and b.seat_id = d.seat_id and d.class = 'silver' and b.occupied = 0;";
$sseats = mysqli_fetch_assoc(mysqli_query($conn, $query))['s_occ'];

?>
<html lang="en">
    <head>

        <title> <?php echo $ename ?> </title>

    </head>
    <body>

        <div>
            <div>
                <h1>Event: <?php echo $ename ?></h1><br>
                <img src="../Images/<?php echo $imgname ?>" width="500px"><br>
                <h3>Time: <?php echo $etime ?></h3><br>
                <h3>Date: <?php echo $edate ?></h3>
            </div>
            <div>
                <h2>Stadium: <?php echo $sname ?></h2><br>
                <img src="../Images/<?php echo $simg ?>" width="500px"><br>
                <h4>City: <?php echo $scity ?></h4><br>
                <h4>Address: <?php echo $saddr ?></h4>
            </div>
            <div>
                <h2>Diamond Price: <?php echo $dprice ?>, Seats Left: <?php echo $dseats ?></h2><br>
                <h2>Gold Price: <?php echo $gprice ?>, Seats Left: <?php echo $gseats ?></h2><br>
                <h2>Silver Price: <?php echo $sprice ?>, Seats Left: <?php echo $sseats ?></h2> 
            </div>
        </div>

    </body>
</html>