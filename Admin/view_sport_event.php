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
        $numRows = mysqli_num_rows($sql_obj);

        echo "<div>";
        for ($i = 0; $i < $numRows; $i++)
        {
            $row = mysqli_fetch_assoc($sql_obj);
            $imgname = $row['eimage'];
            $ename=$row['ename'];
            $sname = $row['sname'];
            $etime=$row['stime'];
            $sdate=$row['sdate'];
            $desc=$row['e_desc'];
            echo
            "
            <div>
                <div>
                    <h2>event:$ename
                    <img src = '../Images/$imgname' style = 'width: 350px;'></img>
                    <h3>Stadium Name: $ename</h3>
                    <h4>event start date:$sdate </h4>
                    <h4>event time: $etime </h4>
                    <p>event description:$desc</p>
                    <button><a href='delete_event.php?ename=$ename'>click</button>
                </div>
            </div>
            ";
        }
        echo "</div>";

        ?>
    </body>
</html>