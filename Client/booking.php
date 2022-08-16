<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
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
    <body >
        <form method="post" onsubmit="test()">
            <?php

            include_once "../Shared/connection.php";

            $eid = $_GET['eid'];

            $query1 = "SELECT * from ticket_price where eid = $eid and class = 'diamond';";
            $sql_obj1 = mysqli_query($conn, $query1);
            $seats_dia = mysqli_num_rows($sql_obj1);
            $query2 = "SELECT * from ticket_price where eid = $eid and class = 'gold';";
            $sql_obj2 = mysqli_query($conn, $query2);
            $seats_gold = mysqli_num_rows($sql_obj2);
            $query3 = "SELECT * from ticket_price where eid = $eid and class = 'silver';";
            $sql_obj3 = mysqli_query($conn, $query3);
            $seats_sil = mysqli_num_rows($sql_obj3);

            ?>
            <h2>Diamond</h2>
            <div id='div_dia'>
            <?php

            for ($i = 1; $i <= $seats_dia; $i++)
            {
                $occ_dia = mysqli_fetch_assoc($sql_obj1);
                if ($occ_dia['occupied'] == 0)
                {
                    echo
                    "
                    <label id = '$i' onclick='dia(document.getElementById(`div_dia`).getElementsByTagName(`label`)[$i - 1])' class='mt-1 ml-1 btn btn-primary'>$i</label>
                    ";
                }
                else
                {
                    echo
                    "
                    <label id = '$i' style='background-color:red;' class='mt-1 ml-1 btn btn-primary'>$i</label>
                    ";
                }
                if ($i % 10 == 0)
                    echo '<br>';
            }
            ?>
            </div>
            <h2>Gold</h2>
            <div id='div_gold'>
            <?php

            for ($i = 1; $i <= $seats_gold; $i++)
            {
                $occ_gold = mysqli_fetch_assoc($sql_obj2);
                if ($occ_gold['occupied'] == 0)
                {
                    echo
                    "
                    <label id = '$i' onclick='gold(document.getElementById(`div_gold`).getElementsByTagName(`label`)[$i - 1])' class='mt-1 ml-1 btn btn-primary'>$i</label>
                    ";
                }
                else
                {
                    echo
                    "
                    <label id = '$i' style='background-color:red;' class='mt-1 ml-1 btn btn-primary'>$i</label>
                    ";
                }
                if ($i % 10 == 0)
                    echo '<br>';
            }
            ?>
            </div>
            <h2>Silver</h2>
            <div id='div_sil'>
            <?php

            for ($i = 1; $i <= $seats_sil; $i++)
            {
                $occ_sil = mysqli_fetch_assoc($sql_obj3);
                if ($occ_sil['occupied'] == 0)
                {
                    echo
                    "
                    <label id = '$i' onclick='sil(document.getElementById(`div_sil`).getElementsByTagName(`label`)[$i - 1])' class='mt-1 ml-1 btn btn-primary'>$i</label>
                    ";
                }
                else
                {
                    echo
                    "
                    <label id = '$i' style='background-color:red;' class='mt-1 ml-1 btn btn-primary'>$i</label>
                    ";
                }
                if ($i % 10 == 0)
                    echo '<br>';
            }

            
            ?>
            </div>
            <input type="submit" class="mt-3 btn btn-success">
            <input type="text" name="dia_seats">
            <input type="text" name="gold_seats">
            <input type="text" name="sil_seats">
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