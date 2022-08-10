<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php

        session_start();

        include "../Shared/session_login.php";
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

                    <h2>event:$ename
                    <img src = '../Images/$imgname' style = 'width: 350px;'></img>
                    <h3>Stadium Name: $sname</h3>
                    <h4>event start date:$edate </h4>
                    <h4>event time: $stime </h4>
                    <p>event description:$desc</p>
                    <button onClick='return confirm(`Are you sure you want to cancel the event $ename?`)'><a href='delete_event.php?ename=$ename&edate=$edate'>Delete</a></button>
                    <button><a href='edit_sport_event_html.php?ename=$ename&edate=$edate'>Edit</a></button>
                </div>
            </div>
            ";
        }
        echo "</div>";

        ?>
    </body>
</html>