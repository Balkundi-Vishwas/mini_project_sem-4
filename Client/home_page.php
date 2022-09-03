<?php

session_start();

if (isset($_SESSION['user_login']))
{
    if($_SESSION['user_login'] == false)
    {
        include "../Shared/menu.html";
    }  
    else
    {
        include "option_page.html";
    } 
}
else
{
    include "../Shared/menu.html";
}

?>

<!DOCTYPE html>
<html>
    <head>

        <title>Welcome to Stadium Seat Booking!</title>

    </head>
    <body>

        <h2 class="m-3"><b>Upcoming Matches &darr;</b></h2>

        <?php 
        
        include_once "../Shared/connection.php";

        $query = "SELECT eid, ename, eimg, sname, time_format(etime, '%h:%i %p') as etime,
        date_format(edate, '%D %b %Y (%a)') as edate, edesc from sport_event order by etime;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);
        if ($count == 0)
        {
            echo "<h1> No Sport Events at the moment </h1>";
        }
        else
        {

            ?>

            <div class='d-flex flex-wrap justify-content-around mb-5'>

            <?php

            for ($i = 0; $i < $count; $i++)
            {

                $row = mysqli_fetch_assoc($sql_obj);
                $eid = $row['eid'];
                $ename = $row['ename'];
                $imgname = $row['eimg'];
                $sname = $row['sname'];
                $etime= $row['etime'];
                $edate = $row['edate'];

                $desc = $row['edesc'];

                $query2 = "SELECT price from booking b, seat s where b.eid = $eid and s.seat_id = b.seat_id and s.class = 'silver';";
                $minprice = mysqli_fetch_assoc(mysqli_query($conn, $query2))['price'];
                $query3 = "SELECT * from booking where occupied = 0 and eid = $eid;";
                $seatsleft = mysqli_num_rows(mysqli_query($conn, $query3));

                ?>
                <div class='card mt-5 cbody border-dark'>
                    <a href="event_details.php?eid=<?php echo $eid ?>" class="noul">
                        <img class='card-img-top cbody' src = '../Images/<?php echo $imgname ?>' alt='Card image' style='height: 250px;'>
                        <div class='card-body bg-dark cbody'>
                            <h3 class='card-title text-warning text-center'> <?php echo $ename ?> </h3>
                            <h5 class='text-white'> Happening at: <?php echo $sname ?> </h5>
                            <h5 class='text-primary'> <?php echo $etime?>, <?php echo $edate ?> </h5>
                            <h5 class='text-danger'> &#x20B9 <?php echo $minprice ?> onwards </h5>
                            <h6 class='text-success'> Seats Left: <?php echo $seatsleft ?> </h6>
                            <?php
                            if ($seatsleft != 0)
                            {
                                ?><button class='button2'><a class="noul" href='booking_html.php?eid=<?php echo $eid ?>'>Book Now!</a></button><?php
                            }
                            else
                            {
                                ?><button class='button3'>Full House!</button><?php
                            }
                            ?>
                        </div>
                    </a>
                </div>
                <?php
            }
        }

        ?>
        </div>
    </body>
</html>