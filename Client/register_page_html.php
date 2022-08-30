<!DOCTYPE html>
<html>
    <head>

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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    </head>
    <body>

            <?php

            include "../Shared/menu.html";

            ?>

        <div class="d-flex justify-content-center align-items-center vh-100">
            <form action="register_page_php.php" method="post" class="w-25 bg-warning p-4 text-center">
                <h2>Register</h2>
                <input type="text" name="name" placeholder="Enter Name" class="mt-3 form-control">
                <input type="text" name="mobile" placeholder="Enter Mobile" maxlength="10" class="mt-3 form-control" required>
                <input type="text" name="email" placeholder="Enter Email" class="mt-3 form-control" required>
                
                <input type="password" name="password" placeholder="Enter Password" class="mt-3 form-control" required>
                <input type="password" name="con_pass" placeholder="Confirm Password" class="mt-3 form-control" required>
                <textarea placeholder="Enter Address" name="address" class="mt-3 form-control" required></textarea>
                <input type="submit" name="save" value="Register" class="mt-3 form-control btn btn-success">
            </form>
        </div>
    </body>
</html>
