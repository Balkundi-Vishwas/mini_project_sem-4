<!DOCTYPE html>
<html>
    <head>

        <title>Stadium Seat Booking Login</title>
        <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
        
        include "../Shared/menu.html";
        include_once "../Shared/connection.php";

        ?>

        <div class="d-flex justify-content-center align-items-center align-self-center vh-100">
            <form method="post" class="w-25 bg-warning p-4 text-center">
                <h2>Login</h2>
                <input type="text" maxlength="10" name="mobile" placeholder="Enter Mobile" class="mt-3 form-control" required>
                <input type="text" id="inc" style="visibility:hidden;"/>
                <input type="password" name="password" placeholder="Enter Password" class="mt-3 form-control" required>      
                <input type="submit" name="login" value="Login" class="mt-3 form-control btn btn-success">
                <h6 class="mt-3"><a href="register_page.php"> Not registered yet? </a></h6>
            </form>
        </div>
            <?php 
            if(ISSET($_POST['login'])){
                $mobile=$_POST['mobile'];
                $pass1=$_POST['password'];  
                $result=$conn->query("select * from customer where mobile=$mobile") or die($conn->error);
                $numberofrows=$result->num_rows;
                $row=$result->fetch_array();
                $pass2=$row['pass'];
                if($numberofrows==1 ){
                    if($pass2==$pass1){
                    ?><script>alert("Verified Successfully");</script><?php
                    }
                    else{
                        ?><script>alert("Please Enter correct password");
                        
                        window.location='login_page.php';</script><?php
                    }
                }
                else{
                    ?><script>alert("Number Not registered \n Please Register");window.location='register_page.php';</script><?php
                }
            }
            ?>
    </body>
</html>