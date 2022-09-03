<?php

session_start();

include_once "../Shared/connection.php";
include "admin_session_login.php";
include "option_page.html";

?>

<!DOCTYPE html>
<html>
    <head>

        <title>View, Edit, Delete Events</title>

    </head>
    <body> 
    
        <?php

        $query = "SELECT eid, ename, eimg, sname, time_format(etime, '%h:%i %p') as etime,
        date_format(edate, '%D %b %Y (%a)') as edate, edesc from sport_event;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);
        ?>
        <div class='d-flex flex-wrap justify-content-around mb-5'>
        <?php
        if ($count == 0)
        {
            ?><div class="text-center"><h1> No Sport Events at the moment</h1>
            <button class = 'btn btn-success'><a class="noul" href = 'add_sport_event_html.php'>Add Event</a></button>
            </div><?php
        }
        else
        {
            for ($i = 0; $i < $count; $i++)
            {
                $row = mysqli_fetch_assoc($sql_obj);
                $eid = $row['eid'];
                $ename = $row['ename'];
                $imgname = $row['eimg'];
                $sname = $row['sname'];
                $etime = $row['etime'];
                $edate = $row['edate'];
                $desc = $row['edesc'];
                ?>
                <div class='card mt-5 cbody border-dark'>
                    <img class='card-img-top cbody' src = '../Images/<?php echo $imgname ?>' alt='Card image' style='height: 250px;'>    
                    <div class='card-body bg-dark cbody'>
                        <h2 class='text-warning'>Event : <?php echo $ename ?></h2>
                        <h3 class='text-white'>Stadium Name : <?php echo $sname ?></h3>
                        <h5 class='text-primary'>Date : <?php echo $edate ?></h5>
                        <h5 class='text-primary'>Time : <?php echo $etime ?></h5>
                        <p class='text-white ellipses'> Event Description: <?php echo $desc ?></p>
                        <button class='button1' onClick="return confirm('Are you sure you want to cancel the event <?php echo $ename ?>?')"><a class="noul" href='delete_event.php?eid=<?php echo $eid ?>'>Delete</a></button>
                        <button class='button2'><a class="noul" href='edit_sport_event_html.php?eid=<?php echo $eid ?>'>Edit</a></button>
                    </div>
                </div>
            <?php
            }
        }
        ?>
        </div>

    </body>
</html>