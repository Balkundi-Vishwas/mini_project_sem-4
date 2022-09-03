<?php
        
include "../Shared/menu.html";

?>

<!DOCTYPE html>
<html>
    <head>

        <title>Stadium Seat Booking Login</title>

    </head>
    <body> 

        <div class="d-flex justify-content-center align-items-center align-self-center vh-100">
            <form action="login_page_php.php" method="post" class="w-25 bg-warning p-4 text-center">
                <h2>Login</h2>
                <input type="text" maxlength="10" name="mobile" placeholder="Enter Mobile" class="mt-3 form-control" required>
                <input type="password" name="password" placeholder="Enter Password" class="mt-3 form-control" required>      
                <input type="submit" name="login" value="Login" class="mt-3 form-control btn btn-success">
                <h6 class="mt-3"><a href="register_page_html.php"> Not registered yet? </a></h6>
            </form>
        </div>
    </body>
</html>