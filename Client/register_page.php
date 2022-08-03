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
            <form  method="post" class="w-25 bg-warning p-4 text-center">
                <h2>Register</h2>
                <input type="text" name="name" placeholder="Enter Name" class="mt-3 form-control">
                <input type="text" name="mobile" placeholder="Enter Mobile" maxlength="10" class="mt-3 form-control" required>
                
                <input type="password" name="password" placeholder="Enter Password" class="mt-3 form-control" required>
                <input type="password" name="con_pass" placeholder="Confirm Password" class="mt-3 form-control" required>
                <textarea placeholder="Enter Address" name="address" class="mt-3 form-control" required></textarea>
                <input type="submit" name="save" value="Register" class="mt-3 form-control btn btn-success">
            </form>
        </div>
            <?php 
            include '../Shared/connection.php';
            if(ISSET($_POST['save'])){
                $name=$_POST['name'];
                $mobile=$_POST['mobile'];
                $pass1=$_POST['password'];
                $pass2=$_POST['con_pass'];
                $address=$_POST['address'];
                $result=$conn->query("select * from customer where mobile=$mobile") or die($conn->error);
                $numberofrows=$result->num_rows;
                if($numberofrows>0){
                    ?><script>alert("Number Already Registered\nPlease login");window.location='login_page.php';</script><?php
                }
                else if ( ( $mobile =='' OR strlen($mobile) <>10 OR substr($mobile,0,2) < 60) )
                {
                    echo "<script type='text/javascript'> alert('Please enter valid mobile number');window.location='register_page.php'; </script>";
                    die();
                }
                else if($pass1==$pass2){
                    $conn->query("INSERT into customer values(' ','$name','$mobile','$pass1','$address')") or die($conn->error);
                    ?><script>alert("Registred Successfully");window.location='login_page.php';</script><?php
                }
                else{
                    ?><script>alert("Password Not Matched");//window.location='register_page.php';</script><?php
                }
            }
            ?>
    </body>
</html>