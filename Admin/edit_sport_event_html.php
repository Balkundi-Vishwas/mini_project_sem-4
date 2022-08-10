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
      $query1 = "SELECT * from ticket_price where ename = '$old_ename' and edate = '$old_edate';";
      $sql_obj = mysqli_query($conn, $query);
      $sql_obj1= mysqli_query($conn, $query1);
      $row = mysqli_fetch_assoc($sql_obj);
      $row1= mysqli_fetch_assoc($sql_obj1);
      $dprice=$row1['dprice'];
      $gprice=$row1['gprice'];
      $sprice=$row1['sprice'];
      
      $stime = $row['stime'];
      $desc = $row['e_desc'];
      $imgname = $row['eimage'];

      echo
      "
      <form action='edit_sport_event_php.php?old_ename=$old_ename&old_edate=$old_edate' method='post' enctype='multipart/form-data'>
      <div>
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
            </div>
            <div>
                   seat price:
                  <input type='number' min='1' placeholder='diamond price' value=$dprice name='dprice'>
                  <input type='number' min='1' placeholder='gold price' value=$gprice name='gprice'>
                  <input type='number' min='1' placeholder='silver price' value=$sprice name='sprice'>
            </div>
            <input type='submit'>

      </form>
      ";

      ?>

</body>
</html>