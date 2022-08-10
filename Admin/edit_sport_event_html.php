<!DOCTYPE html>

<head>
      <title>Edit sport event</title>
</head>
<body>

      <?php

      session_start();

      include "../Shared/session_login.php";
      include_once "../Shared/connection.php";

      $old_ename = $_GET['ename'];
      $old_edate = $_GET['edate'];

      $query = "SELECT * from sport_event where ename = '$old_ename' and edate = '$old_edate';";
      $sql_obj = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($sql_obj);
      
      $stime = $row['stime'];
      $desc = $row['e_desc'];
      $imgname = $row['eimage'];

      echo
      "
      <form action='edit_sport_event_php.php?ename=$old_ename&edate=$old_edate' method='post' enctype='multipart/form-data'>
            <h1>Edit sport event </h1>
            <input type='text' name='ename' value='$old_ename' placeholder='add event name' required>
            <img src='../Images/$imgname' style='width: 200px;'></img>
            <input type='file' name='eimage' placeholder='Upload Image' accept='image/*'>
            <select name='sname' required>
            ";
            include_once '../Shared/connection.php';
            $query = 'SELECT sname from stadium;';
            $sql_obj = mysqli_query($conn, $query);
            $count = mysqli_num_rows($sql_obj);
            for ($i = 0; $i < $count; $i++)
            {
            $rows = mysqli_fetch_assoc($sql_obj);
            $sname = $rows['sname'];
            echo "<option value = '$sname'> $sname </option>";
            }
            echo
            "         
            </select>
            <input type='date' value='$old_edate' name='edate' required>
            <input type='time' name='stime' value='$stime' required>
            <textarea name='edesc' required>$desc</textarea>
            <input type='submit'>

      </form>
      ";

      ?>

</body>
</html>