<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php

        session_start();

        include "session_login.php";
        include "option_page.html";

        include_once "../Shared/connection.php";
        $query = "SELECT * from sport_event;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);

        echo "<div>";
        for ($i = 0; $i < $count; $i++)
        {
            $row = mysqli_fetch_assoc($sql_obj);
            $ename = $row['ename'];
            $imgname = $row['eimage'];
            $sname = $row['sname'];
            $stime= $row['stime'];
            $edate = $row['edate'];
            $desc = $row['e_desc'];
            echo
            "
            <div>
                <div>
                    <h2>Event: $ename </h2>
                    <img src = '../Images/$imgname' style = 'width: 350px;'></img>
                    <h3>Stadium: $sname</h3>
                    <h5>Event date: $edate </h5>
                    <h5>Start time: $stime </h5>
                    <h5> $desc </h5>
                </div>
            </div>
            ";
        }
        echo "</div>";

        ?>
    </body>
</html>