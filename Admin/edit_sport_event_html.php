<!DOCTYPE html>
<html>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            body
            {
                font-family: 'Times New Roman', Times, serif !important;
                background-image: url('../Shared/bgstadium.jpg');
                background-size: cover;
                background-repeat: repeat;
                background-position: 0 -40px;
                background-attachment: fixed;
            }
            img
            {
                pointer-events: none;
            }
            .bg
            {
                top: -40px;
                position: absolute;
                z-index: -1;
                width: 100%;
            }
            </style>
        <title>Edit sport event</title>
    </head>
    <body>

        <?php

        session_start();

        include "admin_session_login.php";
        include_once "../Shared/connection.php";

        $eid = $_GET['eid'];

        $query = "SELECT * from sport_event where eid = $eid;";
        $sql_obj = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql_obj);
        
        $ename = $row['ename'];
        $edate = $row['edate'];
        $sname = $row['sname'];
        $etime = $row['etime'];
        $desc = $row['edesc'];
        $imgname = $row['eimg'];

        $query = "SELECT * from seat where sname = '$sname' and class = 'diamond';";
        $dseat = mysqli_fetch_assoc(mysqli_query($conn, $query))['seat_id'];
        $query = "SELECT * from booking where eid = $eid and seat_id = $dseat;";
        $dprice = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];

        $query = "SELECT * from seat where sname = '$sname' and class = 'gold';";
        $gseat = mysqli_fetch_assoc(mysqli_query($conn, $query))['seat_id'];
        $query = "SELECT * from booking where eid = $eid and seat_id = $gseat;";
        $gprice = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];

        $query = "SELECT * from seat where sname = '$sname' and class = 'silver';";
        $sseat = mysqli_fetch_assoc(mysqli_query($conn, $query))['seat_id'];
        $query = "SELECT * from booking where eid = $eid and seat_id = $sseat;";
        $sprice = mysqli_fetch_assoc(mysqli_query($conn, $query))['price'];

        ?>
        <div class='d-flex justify-content-center align-items-center vh-180 mt-5 mb-5'>
            <form action='edit_sport_event_php.php?eid=<?php echo $eid ?>' method='post' enctype='multipart/form-data' class='w-25 bg-warning p-4 text-center'>
                <div>
                    <h1>Edit sport event </h1>
                    <input type='text' name='ename' value='<?php echo $ename ?>' placeholder='Add Event Name' class='mt-3 form-control' required>
                    <img src='../Images/<?php echo $imgname ?>' style='width: 200px;' class='mt-3'></img>
                    <input type='file' name='eimage' placeholder='Upload Image' accept='image/*' class='mt-3 form-control'>
                    <select name='sname' placeholder='Select the Stadium' value='<?php echo $sname ?>' class='mt-3 form-control' required>
                        <option value='' disabled>Select the Stadium</option>
                        <?php
                        include_once '../Shared/connection.php';
                        $query = 'SELECT sname from stadium;';
                        $sql_obj = mysqli_query($conn, $query);
                        $count = mysqli_num_rows($sql_obj);
                        for ($i = 0; $i < $count; $i++)
                        {
                            $rows = mysqli_fetch_assoc($sql_obj);
                            $sname = $rows['sname'];
                            ?><option value = '<?php echo $sname ?>'> <?php echo $sname ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <input type='date' value='<?php echo $edate ?>' name='edate' class='mt-3 form-control' required>
                    <input type='time' name='etime' value='<?php echo $etime ?>' class='mt-3 form-control' required>
                    <textarea name='edesc' class='mt-3 form-control' required><?php echo $desc ?></textarea>
                </div>
                <div>
                    <h2>Seat Price</h2>
                    <input type='number' min='1' placeholder='diamond price' value=<?php echo $dprice ?> class='mt-3 form-control' name='dprice' required>
                    <input type='number' min='1' placeholder='gold price' value=<?php echo $gprice ?> class='mt-3 form-control' name='gprice' required>
                    <input type='number' min='1' placeholder='silver price' value=<?php echo $sprice ?> class='mt-3 form-control' name='sprice' required>
                </div>
                <input type='submit' value='Update Event Details' class='mt-3 form-control btn btn-success'>
            
            </form>
        </div>   

    </body>
</html>