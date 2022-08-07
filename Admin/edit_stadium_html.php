<!DOCTYPE html>
<html>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
            body
            {
                font-family: 'Nunito' !important;
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

        include "session_login.php";
        include_once "../Shared/connection.php";

        $sname = $_GET['sname'];
        $query = "SELECT * from stadium where sname = '$sname';";

        $sql_obj = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql_obj);

        $image = $row['simage'];
        $address = $row['address'];
        $city = $row['city'];

        echo
        "
        <div class='d-flex justify-content-center align-items-center vh-100'>
            <form action='edit_stadium_php.php' method='post' enctype='multipart/form-data' class='w-25 bg-warning p-4 text-center'>
                <h2>Update Stadium</h2>
                <input type='text' name='sname' value='$sname' placeholder='Enter Stadium Name' class='mt-3 form-control' required>
                <img width='200px' class='mt-2' src='../Images/$image'>
                <input type='file' name='simage' id='img' accept='image/*' class='mt-3 form-control' style='display:none;'>
                <label for='img' style='width: 200px;' class='mt-3 form-control btn btn-primary'>Select Another Image</label>
                
                <input type='text' name='address' value='$address' placeholder='Enter Stadium Address' class='mt-3 form-control' required>
                <input type='text' name='city' value='$city' placeholder='Enter Stadium City' class='mt-3 form-control' required>
               
                <input type='submit' name='save' value='Update Stadium' class='mt-3 form-control btn btn-success'>
            </form>
        </div>
        ";

        ?>
    
    </body>
</html>