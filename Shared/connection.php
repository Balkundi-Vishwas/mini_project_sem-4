<?php

$conn=new mysqli('localhost','root','','DBMS_proj');

if(!$conn)
{
    echo "<h1>Connection Error!</h1>";
    die;
}

?>