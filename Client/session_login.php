<?php

if (isset($_SESSION['user_login']))
{
    if($_SESSION['user_login'] == false)
    {
        echo "<script>alert('Invalid Access!')</script>" ;
        header('refresh: 0; url = "login_page_html.php"') ;
        die;
    }   
}
else
{
    echo "<script>alert('Illegal Attempt!')</script>";
    header('refresh: 0; url = "login_page_html.php"');
    die;
}

?>