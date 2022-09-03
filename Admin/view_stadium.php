<?php

session_start();

include_once "../Shared/connection.php";
include "admin_session_login.php";
include "option_page.html";

?>

<!DOCTYPE html>
<html>
    <head>
        
        <title>View, Edit, Delete Stadiums</title>

    </head>
    <body>
        <?php

        $query = "SELECT * from stadium;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);

        ?><div class='d-flex flex-wrap justify-content-around mb-5'><?php
        if ($count == 0)
        {
            ?><div class="text-center"><h1> No Stadium added</h1>
            <button class = 'btn btn-success'><a href = 'add_stadium_html.php'>Add Stadium</a></button>
            </div><?php
        }
        else
        {
            for ($i = 0; $i < $count; $i++)
            {
                $row = mysqli_fetch_assoc($sql_obj);
                $imgname = $row['simg'];
                $sname = $row['sname'];
                $address = $row['address'];
                $city = $row['city'];
    
                ?>
                <div class='card mt-5 cbody border-dark'>
                    <img class='card-img-top cbody' src = '../Images/<?php echo $imgname ?>' alt='Card image' style='height: 250px;'> 
                    <div class='card-body bg-dark cbody'>
                        <h3 class='text-white'>Stadium Name: <?php echo $sname ?></h3>
                        <h5 class='text-white ellipses'>Address: <?php echo $address ?></h5>
                        <h6 class='text-white'>City: <?php echo $city ?></h6>
                        <button class='button1' onClick="return confirm('Are you sure you want to delete stadium <?php echo $sname ?>?')"><a class="noul" href = 'delete_stadium.php?sname=<?php echo $sname ?>'>Delete</a></button>
                        <button class='button2'><a class="noul" href = 'edit_stadium_html.php?sname=<?php echo $sname ?>'>Edit</a></button>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        </div>
    </body>
</html>