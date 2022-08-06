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
            $sname = $row['ename'];
            $etime=
            echo
            "
            <div>
                <div>
                    <img src = '../Images/$imgname' style = 'width: 350px;'></img>
                    <h3>Stadium Name: $sname</h3>
                    <h5>Address: $address </h5>
                    <h5>City: $city </h5>
                </div>
            </div>
            ";
        }
        echo "</div>";

        ?>
    </body>
</html>