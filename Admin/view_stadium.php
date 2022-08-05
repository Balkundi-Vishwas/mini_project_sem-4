<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php

        include_once "../Shared/connection.php";
        $query = "select * from stadium;";
        $sql_obj = mysqli_query($conn, $query);
        $numRows = mysqli_num_rows($sql_obj);

        echo "<div>";
        for ($i = 0; $i < $numRows; $i++)
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
                </div>
            </div>
            ";
        }
        echo "</div>";

        ?>
    </body>
</html>