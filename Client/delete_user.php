<?php

session_start();

include "session_login.php";
include_once "../Shared/connection.php";

    $uid = $_SESSION['user'];
    $query = "UPDATE booking set occupied = 0 where bid in 
    (SELECT b.bid from booking b, ticket_info t
    where t.uid = $uid and t.bid = b.bid);";

    $sql_result = mysqli_query($conn, $query);
    $sql_deluser = mysqli_query($conn, "DELETE from user where uid = $uid;");

?>
<script>
    alert("User deleted successfully");
    <?php session_destroy(); ?>
    window.location='login_page_html.php';
</script>
