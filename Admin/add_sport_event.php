<!DOCTYPE html>

<head>
      <title>add sport event</title>
</head>
<body>
      <form action="add_sport_event_php.php" method="post" enctype="multipart/form-data">
      add sport event:<input type="text" name="ename" placeholder="add event name" required>
      <input type="file" name="eimage" placeholder="Upload Image" accept="image/*"  required>
      <select name="sname" required>
            <?php
               include_once "../Shared/connection.php";
               $query = "SELECT sname from stadium;";
               $sql_obj = mysqli_query($conn, $query);
               $count = mysqli_num_rows($sql_obj);
               for ($i = 0; $i < $count; $i++)
               {
                  $rows = mysqli_fetch_assoc($sql_obj);
                  $sname = $rows['sname'];
                  echo "<option value = $sname> $sname </option>";
               }   
            ?>
      </select>
      <input type="date" name="edate" required>
      <input type="time" name="stime" required>
      <textarea name="edesc" required></textarea>
      <input type="submit" >
</form>

</body>
</html>