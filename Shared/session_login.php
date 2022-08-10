<?php

if (isset($_SESSION['admin_login']))
{
    if($_SESSION['admin_login'] == false)
    {
        echo "<script>alert('Invalid Access!')</script>" ;
        header('refresh: 0; url = "admin_login_page.php"') ;
        die;
    }   
}
else
{
    echo "<script>alert('Illegal Attempt!')</script>";
    header('refresh: 0; url = "admin_login_page.php"');
    die;
}

?>