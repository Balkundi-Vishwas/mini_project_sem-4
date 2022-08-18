<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
             body
            {
                align-items: center;
                font-family: 'Times New Roman', Times, serif !important;
                background-image: url('../Shared/stadium2.jpg');
                background-size: cover;
            }
            .bgimg
            {
                background-image: url("../Shared/bgticket.webp");
            }
        </style>
    </head>
    <body>
        <script> </script>
        
        <?php
        session_start();

        include_once "../Shared/connection.php";
        include "session_login.php";

        $bid = $_GET['bid'];

        $query = "SELECT u.uname, u.mobile, u.address as uaddress, e.ename, e.eimage, 
        date_format(e.edate, '%D %b %Y, %a') as edate, time_format(e.stime, '%h:%i %p') as stime, 
        s.sname, s.simage, s.address as saddress, s.city, b.diamond, b.gold, b.silver, b.price 
        from user u, booking b, sport_event e, stadium s where bid = $bid and b.uid = u.uid and b.eid = e.eid 
        and e.sname = s.sname;";

        $sql_obj = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql_obj);

        $uname = $row['uname'];
        $mobile = $row['mobile'];
        $uaddress = $row['uaddress'];
        $ename = $row['ename'];
        $eimage = $row['eimage'];
        $edate = $row['edate'];
        $stime = $row['stime'];
        $sname = $row['sname'];
        $simage = $row['simage'];
        $saddress = $row['saddress'];
        $city = $row['city'];
        $dia = $row['diamond'];
        $gold = $row['gold'];
        $sil = $row['silver'];
        $price = $row['price'];

        echo "
    <div class='d-flex flex-wrap justify-content-center mb-5'>
        <div class='card m-5 p-5 bgimg' style='width:500px;' align='center'>
            <h2><b><u> STADIUM SEAT BOOKING </u></b></h2>
            <div>
                <h4><b><u>Customer Details</u></b></h4>
                <b>$uname </b><br>
                $mobile <br>
                $uaddress <br>
            </div>
            <div>
                <h4><b><u>Event Details</u></b></h4>
                <h5><b> $ename </b></h5><br>
                <img src='../Images/$eimage' width='300px' class='rounded border border-dark'> <br><br>
                <b> $edate, \t $stime </b><br>
            </div>
            <div>
                <h4><b><u>Location Details</u></b></h4>
                <h6><b>$sname </b></h6>
                <img src='../Images/$simage' width='200px' class='rounded border border-dark'><br><br>
                $saddress <br>
                $city <br>
            </div>
            <div>
                <div>
                    <b>Diamond Seats: $dia <br>
                    Gold Seats: $gold <br>
                    Silver Seats: $sil </b><br>
                </div>
                <h4><b>Total Price:&#x20B9 $price</b></h4> <br>
            </div>
        </div>;
    </div>";

    ?> 

  </body>
</html>