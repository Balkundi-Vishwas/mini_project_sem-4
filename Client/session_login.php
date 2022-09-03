<?php

if (isset($_SESSION['user_login']))
{
    if($_SESSION['user_login'] == false)
    {
        header('refresh: 0; url = "login_page_html.php"') ;
        die;
    }   
}
else
{
    header('refresh: 0; url = "login_page_html.php"');
    die;
}

?>