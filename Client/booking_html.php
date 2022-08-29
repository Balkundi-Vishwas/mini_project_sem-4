<html>
    <head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            body::-webkit-scrollbar
            {
                display: none;
            }
            h2
            {
                text-align: center;
            }
            body
            {
                font-family: 'Times New Roman', Times, serif !important;
                background-image: url('../Shared/bgstadium.jpg');
                background-size: cover;
                background-repeat: repeat;
                background-attachment: fixed;
            }
            .change
            {
                background-color: green !important;
                color: white;
            }
            .change:hover
            {
                background-color: darkgreen !important;
            }
        </style>
    </head>
    <body>
        <form action="booking_php.php" method="POST" class="text-center" style="background-color: rgba(10,10,10,0.5)">

            <?php

            session_start();

            include "session_login.php";
            include_once "../Shared/connection.php";

            $eid = $_GET['eid'];

            $query = "SELECT price from booking b, seat s where b.eid = $eid and s.seat_id = b.seat_id and s.class = 'diamond';";
            $dia_price = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];
            $query = "SELECT price from booking b, seat s where b.eid = $eid and s.seat_id = b.seat_id and s.class = 'gold';";
            $gold_price = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];
            $query = "SELECT price from booking b, seat s where b.eid = $eid and s.seat_id = b.seat_id and s.class = 'silver';";
            $sil_price = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];
            
            ?>

            <div class='bg-warning mt-3 ml-3 mr-3'>
                <h2> Diamond (Price per seat = <?php echo $dia_price ?>) </h2>
                <div class='d-flex flex-wrap justify-content-center p-3 mb-5 bg-primary'>
                    <?php

                    $query = "SELECT * from booking b, seat s where b.eid = $eid and b.seat_id = s.seat_id and s.class = 'diamond';";
                    $sql_obj = mysqli_query($conn, $query);
                    $dcount = mysqli_num_rows($sql_obj);

                    for ($i = 1; $i <= $dcount; $i++)
                    {
                        $row = mysqli_fetch_assoc($sql_obj);
                        $bid = $row['bid'];
                        $seat_num = $row['seat_num'];
                        $d_occ = $row['occupied'];
                        if (!$d_occ)
                        {
                            ?>
                            <button type="button" id = <?php echo $bid ?> onclick="sel(document.getElementById(<?php echo $bid ?>))" class="m-3 btn bg-white border-dark"><?php echo $seat_num ?></button>
                            <input type = "hidden" name = "arr[<?php echo $bid ?>]" value=0>
                            <?php
                        }
                        else
                        {
                            ?><button type="button" id = <?php echo $bid ?> style='background-color:red;' class='m-3 btn border-dark'> <?php echo $seat_num ?> </button><?php
                        }
                    }

                    ?>
                </div>
            </div>
            <div class='bg-warning ml-3 mr-3'>
                <h2> Gold (Price per seat = <?php echo $gold_price ?>) </h2>
                <div class='d-flex flex-wrap justify-content-center p-3 mb-5 bg-primary'>
                    <?php

                    $query = "SELECT * from booking b, seat s where b.eid = $eid and b.seat_id = s.seat_id and s.class = 'gold';";
                    $sql_obj = mysqli_query($conn, $query);
                    $gcount = mysqli_num_rows($sql_obj);

                    for ($i = 1; $i <= $gcount; $i++)
                    {
                        $row = mysqli_fetch_assoc($sql_obj);
                        $bid = $row['bid'];
                        $seat_num = $row['seat_num'];
                        $g_occ = $row['occupied'];
                        if (!$g_occ)
                        {
                            ?>
                            <button type="button" id = <?php echo $bid ?> onclick="sel(document.getElementById(<?php echo $bid ?>))" class="m-3 btn bg-white border-dark"><?php echo $seat_num ?></button>
                            <input type = "hidden" name = "arr[<?php echo $bid ?>]" value=0>
                            <?php
                        }
                        else
                        {
                            ?><button type="button" id = <?php echo $bid ?> style='background-color:red;' class='m-3 btn border-dark'> <?php echo $seat_num ?> </button><?php
                        }
                    }

                    ?>
                </div>
            </div>
            <div class='bg-warning ml-3 mr-3'>
                <h2> Silver (Price per seat = <?php echo $sil_price ?>) </h2>
                <div class='d-flex flex-wrap justify-content-center p-3 mb-5 bg-primary'>
                    <?php

                    $query = "SELECT * from booking b, seat s where b.eid = $eid and b.seat_id = s.seat_id and s.class = 'silver';";
                    $sql_obj = mysqli_query($conn, $query);
                    $scount = mysqli_num_rows($sql_obj);

                    for ($i = 1; $i <= $scount; $i++)
                    {
                        $row = mysqli_fetch_assoc($sql_obj);
                        $bid = $row['bid'];
                        $seat_num = $row['seat_num'];
                        $s_occ = $row['occupied'];
                        if (!$s_occ)
                        {
                            ?>
                            <button type="button" id = <?php echo $bid ?> onclick="sel(document.getElementById(<?php echo $bid ?>))" class="m-3 btn bg-white border-dark"><?php echo $seat_num ?></button>
                            <input type = "hidden" name = "arr[<?php echo $bid ?>]" value=0>
                            <?php
                        }
                        else
                        {
                            ?><button type="button" id = <?php echo $bid ?> style='background-color:red;' class='m-3 btn border-dark'> <?php echo $seat_num ?> </button><?php
                        }
                    }

                    ?>
                </div>

            </div>
            <input type="submit" value="Pay" onClick="return confirm('Seat booking confirm?')" class="btn btn-success mb-2">
        </form>

        <script>

            var sel_arr = [];

            function sel(seat)
            {
                if (!sel_arr.includes(seat.id))
                {
                    seat.classList.add("change");
                    sel_arr.push(seat.id);
                    document.getElementsByName("arr["+seat.id+"]")[0].value = seat.id;
                }
                else
                {
                    for (i = 0; i < sel_arr.length; i++)
                        if (sel_arr[i] == seat.id)
                        {
                            sel_arr.splice(i, 1)
                            seat.classList.remove("change");
                            document.getElementsByName("arr["+seat.id+"]")[0].value = 0;
                        }
                }
                console.log(sel_arr);
            }
        </script>

    </body>
</html>
