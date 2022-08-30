<!DOCTYPE html>
<html>
    <head>
        <style>
            body::-webkit-scrollbar
            {
                display: none;
            }
            body
            {
                font-family: 'Times New Roman', Times, serif;
            }
            .cbody
            {
                width: 500px;
            }
            .button1
            {
                background-color:red;
                border:darkred;
            }
            .button2
            {
                background-color:green;
                border:green;

            }
            p
            {
                text-size-adjust: 30px;
            }
            .cbody
            {
                width: 400px;
            }
            
        </style>

    </head>
    <body> 
    
        <?php

        session_start();

        include "admin_session_login.php";
        include "option_page.html";
        include_once "../Shared/connection.php";

        $query = "SELECT eid, ename, eimg, sname, time_format(etime, '%h:%i %p') as etime,
        date_format(edate, '%D %b %Y (%a)') as edate, edesc from sport_event;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);
        ?>
        <div class='d-flex flex-wrap justify-content-around mb-5'>
        <?php
        if ($count == 0)
        {
            echo "<h1> No Sport Events at the moment</h1>";
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
                    <img class='card-img-top' src = '../Images/<?php echo $imgname ?>' alt='Card image' style='width: 400px; height: 250px;'>    
                    <div class='card-body bg-dark cbody'>
                        <h2 class='text-warning'>Event : <?php echo $ename ?></h2>
                        <h3 class='text-white'>Stadium Name : <?php echo $sname ?></h3>
                        <h5 class='text-primary'>Date : <?php echo $edate ?></h5>
                        <h5 class='text-primary'>Time : <?php echo $etime ?></h5>
                        <p class='text-white'> Event Description: <?php echo $desc ?></p>
                        <button class='button1' onClick="return confirm('Are you sure you want to cancel the event <?php echo $ename ?>?')"><a href='delete_event.php?eid=<?php echo $eid ?>'>Delete</a></button>
                        <button class='button2'><a href='edit_sport_event_html.php?eid=<?php echo $eid ?>'>Edit</a></button>
                    </div>
                </div>
            <?php
            }
        }
        ?>
        </div>

    </body>
</html>