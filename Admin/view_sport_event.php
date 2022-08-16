<!DOCTYPE html>
<html>
    <head>
    <style>
            body
            {
                font-family: 'Times New Roman', Times, serif;
            }
            .bgimg
            {
                z-index: -1;
                position: fixed;
                width: 100%;
                top: -30px;
            }
            .cbody
            {
                width: 500px;
            }
            .button1
            {
                background-color:red;
                color: #fff;
                border:darkred;

            }
            .button2
            {
                background-color:greenyellow;
                color: #fff;
                border:greenyellow;

            }
            p
            {
                text-size-adjust: 30px;
            }

            
        </style>

    </head>
    <body> 

       
    
        <?php

        session_start();

        include "admin_session_login.php";
        include "option_page.html";
        include_once "../Shared/connection.php";

        $query = "SELECT * from sport_event;";
        $sql_obj = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sql_obj);

        echo "<div class='d-flex flex-wrap justify-content-around mb-5'>";
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
            "<div class='card mt-5' style='width:500px;'>
                <img class='card-img-top' src = '../Images/$imgname' alt='Card image' style='width: 500px; height: 250px;'>    
                <div class='card-body bg-dark cbody'>
                    <h2 class='text-white'>Event : $ename</h2>
                    <h3 class='text-white'>Stadium Name : $sname</h3>
                    <h4 class='text-white'>Event start date : $edate  </h4>
                    <h5 class='text-white'>Time : $stime</h5>
                    <p class='text-white' > Event Description: $desc</p>
                    <button class='button1' onClick='return confirm(`Are you sure you want to cancel the event $ename?`)'><a href='delete_event.php?ename=$ename&edate=$edate'>Delete</a></button>
                    <button class='button2'><a href='edit_sport_event_html.php?ename=$ename&edate=$edate'>Edit</a></button>
                </div>
            </div>
            ";
        }
        echo "</div>";

        ?>
    </body>
</html>