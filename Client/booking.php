<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
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
            }
            
            .change
            {
                background-color: green;
                color: white;
            }
            .change:hover
            {
                background-color: darkgreen;
            }
        </style>
    </head>
    <body>

        <?php

        session_start();

        include "session_login.php";
        include_once "../Shared/connection.php";

        $eid = $_GET['eid'];

        echo
        "<form action='booking_php.php?eid=$eid' method='post' onsubmit='test()' class='text-center'>";

            $query = "SELECT * from ticket_price where eid = $eid and class = 'diamond';";
            $dia_price = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];
            $query = "SELECT * from ticket_price where eid = $eid and class = 'gold';";
            $gold_price = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];
            $query = "SELECT * from ticket_price where eid = $eid and class = 'silver';";
            $sil_price = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];

            $query = "SELECT * from ticket_price where eid = $eid and class = 'diamond';";
            $sql_obj1 = mysqli_query($conn, $query);
            $seats_dia = mysqli_num_rows($sql_obj1);
            $query = "SELECT * from ticket_price where eid = $eid and class = 'gold';";
            $sql_obj2 = mysqli_query($conn, $query);
            $seats_gold = mysqli_num_rows($sql_obj2);
            $query = "SELECT * from ticket_price where eid = $eid and class = 'silver';";
            $sql_obj3 = mysqli_query($conn, $query);
            $seats_sil = mysqli_num_rows($sql_obj3);

            echo "<h2 class='bg-info'>Prices for each seat: Diamond = $dia_price, Gold = $gold_price, Silver = $sil_price</h2>";

            ?>
            <div class='bg-warning'>
            <h2>Diamond</h2>
            <div id='div_dia' class='d-flex flex-wrap justify-content-center p-3 mb-5 bg-secondary'>
            <?php

            for ($i = 1; $i <= $seats_dia; $i++)
            {
                $row1 = mysqli_fetch_assoc($sql_obj1);
                $dia_occ = $row1['occupied'];
                if ($dia_occ == 0)
                {
                    echo
                    "
                    <label id = '$i' onclick='dia(document.getElementById(`div_dia`).getElementsByTagName(`label`)[$i - 1])' class='mt-1 ml-3 mr-3 btn btn-primary border-dark'>$i</label>
                    ";
                }
                else
                {
                    echo
                    "
                    <label id = '$i' style='background-color:red;' class='mt-1 ml-3 mr-3 btn btn-primary border-dark'>$i</label>
                    ";
                }
            }
            ?>
            </div>
            </div>
            <div class='bg-warning'>
            <h2>Gold</h2>
            <div id='div_gold' class='d-flex flex-wrap justify-content-center p-3 mb-5 bg-secondary'>
            <?php

            for ($i = 1; $i <= $seats_gold; $i++)
            {
                $row2 = mysqli_fetch_assoc($sql_obj2);
                $gold_occ = $row2['occupied'];
                if ($gold_occ == 0)
                {
                    echo
                    "
                    <label id = '$i' onclick='gold(document.getElementById(`div_gold`).getElementsByTagName(`label`)[$i - 1])' class='mt-1 ml-3 mr-3 btn btn-primary border-dark'>$i</label>
                    ";
                }
                else
                {
                    echo
                    "
                    <label id = '$i' style='background-color:red;' class='mt-1 ml-3 mr-3 btn btn-primary border-dark'>$i</label>
                    ";
                }
            }
            ?>
            </div>
        </div>
        <div class='bg-warning'>
            <h2>Silver</h2>
            <div id='div_sil' class='d-flex flex-wrap justify-content-center p-3 mb-5 bg-secondary'>
            <?php

            for ($i = 1; $i <= $seats_sil; $i++)
            {
                $row3 = mysqli_fetch_assoc($sql_obj3);
                $sil_occ = $row3['occupied'];
                if ($sil_occ == 0)
                {
                    echo
                    "
                    <label id = '$i' onclick='sil(document.getElementById(`div_sil`).getElementsByTagName(`label`)[$i - 1])' class='mt-1 ml-3 mr-3 btn btn-primary border-dark'>$i</label>
                    ";
                }
                else
                {
                    echo
                    "
                    <label id = '$i' style='background-color:red;' class='mt-1 ml-3 mr-3 btn btn-primary border-dark'>$i</label>
                    ";
                }
            }
            $query1 = "SELECT * from ticket_price where eid = $eid and class = 'diamond';";
            $sql_obj1 = mysqli_query($conn, $query1);
            $query2 = "SELECT * from ticket_price where eid = $eid and class = 'gold';";
            $sql_obj2 = mysqli_query($conn, $query2);
            $query3 = "SELECT * from ticket_price where eid = $eid and class = 'silver';";
            $sql_obj3 = mysqli_query($conn, $query3);

            
            ?>
            </div>
        </div>
                <div class="form-group mb-2">
                    <input type="submit" value="Pay" onClick='return confirm(`Seat booking confirm?`)' class="btn btn-success mb-2">
                </div>
                <input type="text" name="dia_seats" readonly>
                <input type="text" name="gold_seats" readonly>
                <input type="text" name="sil_seats" readonly>
        </form>

    </body>
    <script>   
        var dia_arr = [];
        var gold_arr = [];
        var sil_arr = [];

        function dia(dia)
        {
            if (!dia_arr.includes(dia.id))
            {
                dia.classList.add("change");
                dia_arr.push(dia.id);
            }
            else
            {
                for (i = 0; i < dia_arr.length; i++)
                    if (dia_arr[i] == dia.id)
                    {
                        dia_arr.splice(i, 1)
                        dia.classList.remove("change");
                    }
            }
            console.log(dia_arr);
            document.getElementsByName('dia_seats')[0].value = dia_arr;
        }
        function gold(gold)
        {
            if (!gold_arr.includes(gold.id))
            {
                gold.classList.add("change");
                gold_arr.push(gold.id);
                
            }
            else
            {
                for (i = 0; i < gold_arr.length; i++)
                    if (gold_arr[i] == gold.id)
                    {
                        gold_arr.splice(i, 1)
                        gold.classList.remove("change");
                    }
            }
            console.log(gold_arr);
            
            document.getElementsByName('gold_seats')[0].value = gold_arr;
        }
        function sil(sil)
        {
            if (!sil_arr.includes(sil.id))
            {
                sil.classList.add("change");
                sil_arr.push(sil.id);
            }
            else
            {
                for (i = 0; i < sil_arr.length; i++)
                    if (sil_arr[i] == sil.id)
                    {
                        sil_arr.splice(i, 1)
                        sil.classList.remove("change");
                    }
            }
            console.log(sil_arr);
            document.getElementsByName('sil_seats')[0].value = sil_arr;
        }
    </script>
</html>