<?php

include "../Shared/menu.html";

?>

<!DOCTYPE html>
<html>
    <head>

        <title>Stadium Management Admin Login</title>

    </head>
    <body> 

        <div class="d-flex justify-content-center align-items-center vh-100">
            <form action="admin_login_page_php.php" method="post" class="w-25 bg-warning p-4 text-center">
                <h2>Admin Login</h2>
                <input type="text" name="uname" placeholder="Enter Username" class="mt-3 form-control" required>
                <input type="password" name="password" placeholder="Enter Password" class="mt-3 form-control" required>      
                <input type="submit" value="Login" class="mt-3 form-control btn btn-success">
            </form>
        </div>

    </body>
</html>