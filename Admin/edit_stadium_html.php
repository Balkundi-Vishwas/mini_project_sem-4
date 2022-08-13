<!DOCTYPE html>
<html>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
            body
            {
                font-family: 'Times New Roman', Times, serif !important;
                overflow: hidden;
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
    </head>
    <body>

        <?php

        session_start();

        include "../Shared/session_login.php";
        include_once "../Shared/connection.php";

        $old_sname = $_GET['sname'];

        $query = "SELECT * from stadium where sname = '$old_sname';";
        $sql_obj = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql_obj);

        $image = $row['simage'];
        $address = $row['address'];
        $city = $row['city'];

        $query = "SELECT * from division where sname = '$old_sname';";
        $sql_obj = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql_obj);

        $diamond = $row['diamond'];
        $gold = $row['gold'];
        $silver = $row['silver'];

        echo
        "
        <div class='d-flex justify-content-center align-items-center vh-100'>
            <form action='edit_stadium_php.php?old_sname=$old_sname' method='post' enctype='multipart/form-data' class='w-25 bg-warning p-4 text-center'>
                <div>
                    <h2>Update Stadium</h2>
                    <input type='text' name='sname' value='$old_sname' placeholder='Enter Stadium Name' class='mt-3 form-control' required>
                    <img width='200px' class='mt-2' src='../Images/$image'>
                    <input type='file' name='simage' id='img' accept='image/*' class='mt-3 form-control' style='display:none;'>
                    <label for='img' style='width: 200px;' class='mt-3 form-control btn btn-primary'>Select Another Image</label>
                    
                    <input type='text' name='address' value='$address' placeholder='Enter Stadium Address' class='mt-3 form-control' required>
                    <input type='text' name='city' value='$city' placeholder='Enter Stadium City' class='mt-3 form-control' required>
                </div>
                <div>
                    <h4 class='mt-3'>Seats in Each Division</h4>
                    <input type='number' placeholder='class diamond' name='diamond' value='$diamond' min='1' step='1' class='mt-3 form-control' required>
                    <input type='number' placeholder='class gold' name='gold' value='$gold' min='1' step='1' class='mt-3 form-control' required>
                    <input type='number' placeholder='class silver' name='silver' value='$silver' min='1' step='1' class='mt-3 form-control' required>
                </div>
                <input type='submit' value='Update Stadium Details' class='mt-3 form-control btn btn-success'>
            </form>
        </div>
        ";

        ?>
    
    </body>
</html>