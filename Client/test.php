<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <table border = 1>
            <tr>
                <th> Sl no. </th>
                <th> Event </th>
                <th> Date </th>
                <th> Time </th>
                <th> Stadium </th>
                <th> Total Seats </th>
                <th> Total Price </th>
                <th></th>
            </tr>

            <?php

            include_once "../Shared/connection.php";

            $query = "SELECT * from ticket_info where uid = 1;";
            $sql_obj = mysqli_query($conn, $query);
            $count = mysqli_num_rows($sql_obj);
            // echo $count;
            // echo "<br>";

            $events = [];

            for ($i = 0; $i < $count; $i++)
            {
                $row = mysqli_fetch_assoc($sql_obj);
                $tid = $row['tid'];
                $query = "SELECT e.eid from sport_event e, booking b, ticket_info t where t.tid = $tid and t.bid = b.bid and 
                b.eid = e.eid;";
                $eid = mysqli_fetch_assoc(mysqli_query($conn, $query))['eid'];
                if (!in_array($eid, $events))
                {
                    array_push($events, $eid);
                }
            }
            // print_r($events);
            // echo "<br>";

            // ticket no., ename, date, time, sname, no. of seats, total
            $eid = reset($events);
            for ($i = 1; $i <= count($events); $i++)
            {
                $query = "SELECT t.tid, e.ename, date_format(e.edate, '%D %b %Y') as edate,
                time_format(e.etime, '%h:%i %p') as etime, e.sname, count(d.seat_id) as numseats, sum(b.price) as price
                from user u, sport_event e, booking b, ticket_info t, seat d
                where u.uid = 1 and e.eid = $eid and t.uid = u.uid and t.bid = b.bid and b.eid = e.eid and
                b.seat_id = d.seat_id;";
                $sql_obj = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($sql_obj);
                // print_r($row);
                // echo "<br>";
                // Array ( [tid] => 1 [ename] => RCB vs KKR [edate] => 1st Sep 2022 [etime] => 06:30 PM [sname] => Chinnaswamy
                // [numseats] => 9 [price] => 8600 )
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
                    <td> <button><a href="print.php?tid=<?php echo $tid ?>"> Full Details </a></button> </td>
                </tr>
                
                <?php

                $eid = next($events);
            }

            ?>

        </table>
    </body>
</html>