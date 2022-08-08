<!DOCTYPE html>
<html>
    <head>

        <title>Welcome to Stadium Seat Booking!</title>
        <style>
            .bgimg
            {
                z-index: -1;
                position: fixed;
                width: 100%;
                top: -30px;
            }
            .cbody
            {
                width: 400px;
            }
        </style>

    </head>
    <body>
        
        <?php

        include "../Shared/menu.html";

        ?>

        <img src="../Shared/bgstadium.jpg" class="bgimg"></img>
        <h2 class="m-3"><b>Upcoming Matches &darr;</b></h2>

        <?php 
        
        include_once "../Shared/connection.php";
        $query = "SELECT * from sport_event;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);

        echo
        "<div class='d-flex flex-wrap justify-content-around mb-5'>";

        for ($i = 0; $i < $count; $i++)
        {

            $row = mysqli_fetch_assoc($sql_obj);
            $ename = $row['ename'];
            $imgname = $row['eimage'];
            $sname = $row['sname'];
            $stime= $row['stime'];
            $edate = $row['edate'];
            $desc = $row['e_desc'];

            echo
            "<div class='card mt-5' style='width:400px;'>
                <img class='card-img-top' src = '../Images/$imgname' alt='Card image' style='width: 400px; height: 250px;'>
                <div class='card-body bg-dark cbody'>
                    <h4 class='card-title text-warning'> $ename </h4>
                    <h5 class='text-white'> $sname </h5>
                    <h5 class='text-primary'> $stime $edate</h5>
                    <h5 class='text-danger'> 5000 Rs onwards </h5>
                    <h6 class='text-success'> Seats Available: </h6>
                </div>
            </div>";
        }

        echo "</div>";
        ?>

    </body>
</html>