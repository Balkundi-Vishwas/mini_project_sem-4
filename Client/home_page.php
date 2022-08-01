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
        
        echo
        "<div class='d-flex flex-wrap justify-content-around mb-5'>";

        for ($i = 0; $i < 4; $i++)
        {

            echo
            "<div class='card mt-5' style='width:400px;'>
                <img class='card-img-top' src='https://img.inextlive.com/inext/12102020/rcbvskkrpitch_b_12.jpg' alt='Card image' style='width: 400px; height: 250px;'>
                <div class='card-body bg-dark cbody'>
                    <h4 class='card-title text-warning'> RCB vs KKR </h4>
                    <h5 class='text-white'> Chinnaswamy Stadium </h5>
                    <h5 class='text-danger'> 5000 Rs onwards </h5>
                    <h6 class='text-success'> Seats Available: </h6>
                </div>
            </div>";
        }

        echo "</div>";
        ?>

    </body>
</html>