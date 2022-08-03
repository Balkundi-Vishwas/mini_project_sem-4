

<!DOCTYPE html>
<html>
    <head>

        <style>
            body
            {
                font-family: 'Nunito' !important;
                overflow: hidden;
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
        
        //include "../Shared/menu.html";
        include_once "../Shared/connection.php";

        ?>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <form  method="post" class="w-25 bg-warning p-4 text-center">
                <h2>Admin Register</h2>
                <input type="text" name="aname" onblur="checkname()" placeholder="Enter Name" class="mt-3 form-control" required>
                <input type="text" name="uname" placeholder="Enter Userame" class="mt-3 form-control" required>
                <input type="password" name="pass" placeholder="Enter Password" class="mt-3 form-control" required>
                <input type="password" name="pass1" placeholder="confirm Password" class="mt-3 form-control" required>
                <input type="submit" name="button12" value="Register" class="mt-3 form-control btn btn-success" required>
                <h5 class="mt-3"></h5>
            </form>
            <?php

//include_once "../Shared/connection.php";

if(ISSET($_POST['button12']))
{
    $name=$_POST['aname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $pass1=$_POST['pass1'];
    if($pass1==$pass){
        $conn->query("INSERT into admin values(' ','$name','$uname','$pass')") or die($conn->error);
        ?><script>alert("Registred Successfully");window.location='admin_login_page.php';</script><?php
    }
    else{
        ?><script>alert("name or password mismatch");window.location='admin_register_page.html';</script><?php
    }
}

?>
        </div>
        <script>
            var namePat = /^[a-z A-Z]{5}$/;
            function checkname()
            {
                var name=document.getElementsByTagName('input')[0].value;
                if (!name.match(namePat))
                    document.getElementsByTagName('h5')[0].innerHTML = "name not matching";
                    
            }
        </script>
    </body>
</html>