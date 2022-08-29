<?php

session_start();

include "admin_session_login.php";

session_destroy();

header("refresh: 0; url = 'admin_login_page_html.php'");

?>