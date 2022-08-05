<?php

session_start();

include "session_login.php";

session_destroy();

header("refresh: 0; url = 'admin_login_page.php'");

?>