<!DOCTYPE html>
<html>
    <head>
        <title>View, Edit, Delete Stadiums</title>
    </head>
    <body>
        <?php

        session_start();

        include "../Shared/session_login.php";
        include "option_page.html";
        include_once "../Shared/connection.php";

        $query = "SELECT * from stadium;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);

        echo "<div>";
        for ($i = 0; $i < $count; $i++)
        {
            $row = mysqli_fetch_assoc($sql_obj);
            $imgname = $row['simage'];
            $sname = $row['sname'];
            $address = $row['address'];
            $city = $row['city'];

            echo
            "
            <div>
                <div>
                    <img src = '../Images/$imgname' style = 'width: 350px;'></img>
                    <h3>Stadium Name: $sname</h3>
                    <h5>Address: $address </h5>
                    <h5>City: $city </h5>
                    <button onClick='return confirm(`Are you sure you want to delete stadium $sname?`)'><a href = 'delete_stadium.php?sname=$sname'>Delete</a></button>
                    <button><a href = 'edit_stadium_html.php?sname=$sname'>Edit</a></button>
                </div>
            </div>
            ";
        }
        echo "</div>";

        ?>
    </body>
</html>