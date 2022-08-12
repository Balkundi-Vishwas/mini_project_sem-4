<!DOCTYPE html>
<html>
    <head>

        <title>Stadium Seat Admin Login</title>
        <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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

        include "../Shared/menu.html";
        include_once "../Shared/connection.php";

        ?>

        <div class="d-flex justify-content-center align-items-center align-self-center vh-100">
            <form action="admin_login_php.php" method="post" class="w-25 bg-warning p-4 text-center">
                <h2>Admin Login</h2>
                <input type="text" name="uname" placeholder="Enter Username" class="mt-3 form-control" required>
                <input type="password" name="password" placeholder="Enter Password" class="mt-3 form-control" required>      
                <input type="submit" value="Login" class="mt-3 form-control btn btn-success">
            </form>
        </div>

    </body>
</html>