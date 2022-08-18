<?php

session_start();

include "session_login.php";

session_destroy();

header("refresh: 0; url = 'home_page.php'");

?>