<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>View, Edit, Delete Stadiums</title>
        <style>
            body
            {
                font-family: 'Times New Roman', Times, serif;
            }
            .bgimg
            {
                z-index: -1;
                position: fixed;
                width: 100%;
                top: -30px;
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

            
        </style>
    </head>
    <body>
        <?php

        session_start();

        include "admin_session_login.php";
        include "option_page.html";
        include_once "../Shared/connection.php";

        $query = "SELECT * from stadium;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);

        echo "<div class='d-flex flex-wrap justify-content-around mb-5'>";
        if ($count == 0)
        {
            echo "<div><h1> No Stadium added</h1>
            <button class = 'btn btn-success'><a href = 'add_stadium.html'>Add Stadium</a></button>
            </div>";
        }
        else
        {
            for ($i = 0; $i < $count; $i++)
            {
                $row = mysqli_fetch_assoc($sql_obj);
                $imgname = $row['simg'];
                $sname = $row['sname'];
                $address = $row['address'];
                $city = $row['city'];
    
                ?>
                <div class='card mt-5' style='width:500px;'>
                    <img class='card-img-top' src = '../Images/<?php echo $imgname ?>' alt='Card image' style='width: 500px; height: 250px;'> 
                    <div class='card-body bg-dark cbody'>
                        <h3 class='text-white'>Stadium Name: <?php echo $sname ?></h3>
                        <h5 class='text-white'>Address: <?php echo $address ?></h5>
                        <h6 class='text-white'>City: <?php echo $city ?></h6>
                        <button class='button1' onClick='return confirm(`Are you sure you want to delete stadium <?php echo $sname ?>?`)'><a href = 'delete_stadium.php?sname=<?php echo $sname ?>'>Delete</a></button>
                        <button class='button2'><a href = 'edit_stadium_html.php?sname=<?php echo $sname ?>'>Edit</a></button>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        </div>
    </body>
</html>