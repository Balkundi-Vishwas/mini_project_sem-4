<!DOCTYPE html>

      <head>
            <title>Add Sport Event</title>
            <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
            body
            {
                font-family: 'Times New Roman', Times, serif !important;
                background-image: url('../Shared/bgstadium.jpg');
                background-size: cover;
                
            }
            img
            {
                pointer-events: none;
            }
            .bg
            {
                top: -40px;
                position: absolute;
                z-index: -1;
                width: 100%;
            }
            h2{
                  text-align: center;
                  vertical-align: middle;
                  font-family: 'Times New Roman', Times, serif;
                  font-size:25px;
            }
        </style>
      </head>
      <body>
          <div class="d-flex justify-content-center align-items-center vh-180">
            <form action="add_sport_event_php.php" method="post" enctype="multipart/form-data" class="w-25 bg-warning p-4 text-center mt-5 mb-5">
                  <div>
                        <h1>Add Sport Event</h1>
                        <input type="text" name="ename" placeholder="Add Event Name" class="mt-3 form-control" required>
                        <input type='file' name='eimage' placeholder='Upload Image' id='img' accept='image/*' class="mt-3 form-control" required>
                        <label for='img' style='width: 200px;' class='mt-3 form-control btn btn-success'>Add Stadium Image</label>
                        <select name="sname" placeholder="Select the Stadium" class="mt-3 form-control" required>
                            <option value="" disabled selected>Select the Stadium</option>
                            <?php


                            session_start();

                            include "admin_session_login.php";
                            include_once "../Shared/connection.php";
    
                            $query = "SELECT sname from stadium;";
                            $sql_obj = mysqli_query($conn, $query);
                            $count = mysqli_num_rows($sql_obj);
                            for ($i = 0; $i < $count; $i++)
                            {
                                $rows = mysqli_fetch_assoc($sql_obj);
                                $sname = $rows['sname'];
                                echo "<option value = '$sname'> $sname </option>";
                            }
        
                            ?>
                         </select>
                         
                         <input type="date" id="date" placeholder="Set Event Date" name="edate" class="mt-3 form-control" required>
                         <label for="date" style='width: 200px;' class='mt-3 form-control btn btn-success'>Set Event Date</label>
                         <input type="time" id ="time" placeholder="Set Event Time" name="stime" class="mt-3 form-control" required>
                         <label for="time" style='width: 200px;' class='mt-3 form-control btn btn-success'>Set Event Time</label>
                         <textarea name="edesc" placeholder="Add description of event" class="mt-3 form-control" required></textarea>
                    </div> 
                    <div>
                        <h4>Seat Prices</h4>
                        <input type="number" name="dprice" placeholder="Diamond Seat Price" class="mt-3 form-control" required>
                        <input type="number" name="gprice" placeholder="Gold Seat Price" class="mt-3 form-control" required>
                        <input type="number" name="sprice" placeholder="Silver Seat Price" class="mt-3 form-control" required>
                        <input type="submit" value="Add Sport Event" class="mt-3 form-control btn btn-success">
                    </div>
                
     
            </form>       
          </div>

      </body>
</html>
