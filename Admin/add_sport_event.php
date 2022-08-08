<!DOCTYPE html>

      <head>
            <title>Add Sport Event</title>
      </head>
      <body>

            <form action="add_sport_event_php.php" method="post" enctype="multipart/form-data">
                  <h1>Add Sport Event</h1>
                  <input type="text" name="ename" placeholder="Add Event Name" required>
                  <input type="file" name="eimage" placeholder="Upload Image" accept="image/*"  required>
                  <select name="sname" required>
                  <?php

                  session_start();

                  include "../Shared/session_login.php";
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
                  <input type="date" name="edate" required>
                  <input type="time" name="stime" required>
                  <textarea name="edesc" placeholder="Add description of event" required></textarea>
                  <input type="submit">
            </form>

      </body>
</html>