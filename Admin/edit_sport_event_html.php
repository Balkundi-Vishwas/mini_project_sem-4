<!DOCTYPE html>

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

        $old_ename = $_GET['ename'];
        $old_edate = $_GET['edate'];


        $query = "SELECT * from sport_event where ename = '$old_ename' and edate = '$old_edate';";
        $sql_obj = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql_obj);
        $eid = $row['eid'];
        $query1 = "SELECT * from ticket_price where eid = $eid and class = 'diamond';";
        $sql_obj1= mysqli_query($conn, $query1);
        $row1= mysqli_fetch_assoc($sql_obj1);
        $dprice=$row1['price'];
        $query1 = "SELECT * from ticket_price where eid = $eid and class = 'gold';";
        $sql_obj1= mysqli_query($conn, $query1);
        $row1= mysqli_fetch_assoc($sql_obj1);
        $gprice=$row1['price'];
        $query1 = "SELECT * from ticket_price where eid = $eid and class = 'silver';";
        $sql_obj1= mysqli_query($conn, $query1);
        $row1= mysqli_fetch_assoc($sql_obj1);
        $sprice=$row1['price'];
        
        $sname = $row['sname'];
        $stime = $row['stime'];
        $desc = $row['e_desc'];
        $imgname = $row['eimage'];

        echo
        "
        <div class='d-flex justify-content-center align-items-center vh-180 mt-5 mb-5'>
            <form action='edit_sport_event_php.php?old_ename=$old_ename&old_edate=$old_edate&eid=$eid' method='post' enctype='multipart/form-data' class='w-25 bg-warning p-4 text-center'>
                <div>
                        <h1>Edit sport event </h1>
                        <input type='text' name='ename' value='$old_ename' placeholder='Add Event Name' class='mt-3 form-control' required>
                        <img src='../Images/$imgname' style='width: 200px;' class='mt-3'></img>
                        <input type='file' name='eimage' placeholder='Upload Image' accept='image/*' class='mt-3 form-control'>
                        <select name='sname' placeholder='Select the Stadium' value='$sname' class='mt-3 form-control' required>
                            <option value='' disabled>Select the Stadium</option>
                            ";
                            include_once '../Shared/connection.php';
                            $query = 'SELECT sname from stadium;';
                            $sql_obj = mysqli_query($conn, $query);
                            $count = mysqli_num_rows($sql_obj);
                            for ($i = 0; $i < $count; $i++)
                            {
                                $rows = mysqli_fetch_assoc($sql_obj);
                                $sname = $rows['sname'];
                                echo "<option value = '$sname'> $sname </option>";
                            }
                            echo
                            "
                        </select>
                        <input type='date' value='$old_edate' name='edate' class='mt-3 form-control' required>
                        <input type='time' name='stime' value='$stime' class='mt-3 form-control' required>
                        <textarea name='edesc' class='mt-3 form-control' required>$desc</textarea>
                 </div>
                <div>
                        <h2>Seat Price</h2>
                        <input type='number' min='1' placeholder='diamond price' value=$dprice class='mt-3 form-control' name='dprice' required>
                        <input type='number' min='1' placeholder='gold price' value=$gprice class='mt-3 form-control' name='gprice' required>
                        <input type='number' min='1' placeholder='silver price' value=$sprice class='mt-3 form-control' name='sprice' required>
                 </div>
                        <input type='submit' value='Update Event Details' class='mt-3 form-control btn btn-success'>
            
            </form>
        </div>   
        ";

        ?>

    </body>
</html>