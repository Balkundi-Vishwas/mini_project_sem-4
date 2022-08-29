<?php

if (isset($_SESSION['admin_login']))
{
    if($_SESSION['admin_login'] == false)
    {
        ?><script>alert('Invalid Access!')</script><?php
        header('refresh: 0; url = "admin_login_page_html.php"') ;
        die;
    }   
}
else
{
    ?><script>alert('Illegal Attempt!')</script><?php
    header('refresh: 0; url = "admin_login_page_html.php"');
    die;
}

?>