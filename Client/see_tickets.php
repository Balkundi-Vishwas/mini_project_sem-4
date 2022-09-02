<?php

session_start();

include "session_login.php";
include "option_page.html";
include_once "../Shared/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>

        <title>Check/Cancel Tickets</title>

    </head>
    <body>
        <div class="text-center m-5 d-flex justify-content-center">
            <table border = 2 style="background-color: silver;">
                <tr style="background-color: lightgreen;">
                    <th width="200"> Sl no. </th>
                    <th width="200"> Event </th>
                    <th width="200"> Date </th>
                    <th width="200"> Time </th>
                    <th width="200"> Stadium </th>
                    <th width="200"> Booked Seats </th>
                    <th width="200"> Total Price (in &#x20B9) </th>
                    <th width="200"></th>
                    <th width="200"></th>
                </tr>

                <?php

                $uid = $_SESSION['user'];

                $query = "SELECT * from ticket_info where uid = $uid;";
                $sql_obj = mysqli_query($conn, $query);
                $count = mysqli_num_rows($sql_obj);

                $events = [];

                for ($i = 0; $i < $count; $i++)
                {
                    $row = mysqli_fetch_assoc($sql_obj);
                    $tid = $row['tid'];
                    $query = "SELECT e.eid from sport_event e, booking b, ticket_info t where t.tid = $tid and
                    t.bid = b.bid and b.eid = e.eid;";
                    $eid = mysqli_fetch_assoc(mysqli_query($conn, $query))['eid'];
                    if (!in_array($eid, $events))
                    {
                        array_push($events, $eid);
                    }
                }

                $eid = reset($events);
                if (count($events) == 0)
                {
                    ?><td colspan=9>
                        You haven't booked any tickets. Book now?<br>
                        <a href="home_page.php"><button class="btn btn-info text-dark"> Book an Event </button></a>
                    </td><?php
                }
                for ($i = 1; $i <= count($events); $i++)
                {
                    $query = "SELECT t.tid, e.ename, date_format(e.edate, '%D %b %Y') as edate,
                    time_format(e.etime, '%h:%i %p') as etime, e.sname, count(d.seat_id) as numseats, sum(b.price) as price
                    from user u, sport_event e, booking b, ticket_info t, seat d
                    where u.uid = $uid and e.eid = $eid and t.uid = u.uid and t.bid = b.bid and b.eid = e.eid and
                    b.seat_id = d.seat_id;";
                    $sql_obj = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($sql_obj);
                    $tid = $row['tid'];
                    $ename = $row['ename'];
                    $edate = $row['edate'];
                    $etime = $row['etime'];
                    $sname = $row['sname'];
                    $numseats = $row['numseats'];
                    $price = $row['price'];

                    ?>
                    
                    <tr>
                        <td> <?php echo $i ?> </td>
                        <td> <?php echo $ename ?> </td>
                        <td> <?php echo $edate ?> </td>
                        <td> <?php echo $etime ?> </td>
                        <td> <?php echo $sname ?> </td>
                        <td> <?php echo $numseats ?> </td>
                        <td> <?php echo $price ?> </td>
                        <td> <a href="print.php?tid=<?php echo $tid ?>"><button class="btn btn-info text-dark"> Full Details </button></a> </td>
                        <td> <a href="cancel_tickets.php?tid=<?php echo $tid ?>" onClick="return confirm('Are you sure you want to cancel the ticket for <?php echo $ename ?>?')"><button class="btn btn-danger text-dark"> Cancel Ticket </button></a> </td>
                    </tr>
                    
                    <?php

                    $eid = next($events);
                }

                ?>

            </table>
        </div>
    </body>
</html>