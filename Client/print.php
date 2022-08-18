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
        </style>
    </head>
    <body>
        <script> </script>
        
        <?php

        // Array ( [uname] => Chetan S [mobile] => 8762625727 [address] => dfjgkdlfgj [ename] => RCB vs KKR 
        // [eimage] => RCB vs KKR2022-08-21.jpg [date_format(e.edate, '%D %b %Y %a')] => 21st Aug 2022 Sun 
        // [time_format(e.stime, '%h:%i %p')] => 09:45 PM [e_desc] => shfdsjkdfhjk [sname] => Chinnaswamy 
        // [simage] => Chinnaswamy.jpg [city] => Bengaluru [diamond] => [gold] => 1,3,5 [silver] => 1,3,5,4 
        // [price] => 4800 )
        
        include_once "../Shared/connection.php";
        $bid = $_GET['bid'];

        $query = "SELECT u.uname, u.mobile, u.address, e.ename, e.eimage, date_format(e.edate, '%D %b %Y, %a') as edate, time_format(e.stime, '%h:%i %p') as stime, e.e_desc, s.sname, s.simage, s.address, s.city, b.diamond, b.gold, b.silver, b.price
        from user u, booking b, sport_event e, stadium s where bid = $bid and b.uid = u.uid and b.eid = e.eid and e.sname = s.sname;";
        $sql_obj = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($sql_obj);
        // print_r($row);

        $uname = $row['uname'];
        $mobile = $row['mobile'];
        $address = $row['address'];
        $ename = $row['ename'];
        $eimage = $row['eimage'];
        $edate = $row['edate'];
        $stime = $row['stime'];
        $edesc = $row['e_desc'];
        $sname = $row['sname'];
        $simage = $row['simage'];
        $city = $row['city'];
        $dia = $row['diamond'];
        $gold = $row['gold'];
        $sil = $row['silver'];
        $price = $row['price'];

        echo "
    <div class='d-flex flex-wrap justify-content-center mb-5'>
        <div class='card mt-5' style='width:500px;' align='center'>
            <h1> Stadium Seat Booking </h1>
            <div>
                <h4>Customer Details</h4>
                $uname <br>
                $mobile <br>
                $address <br>
            </div>
            <div>
                <h4>Event Details</h4>
                $ename <br>
                <img src='../Images/$eimage' width='300px'> <br>
                $edate, \t $stime <br>
                $edesc <br>
            </div>
            <div>
                <h4>Location Details</h4>
                $sname <br>
                <img src='../Images/$simage' width='200px'> <br>
                $address <br>
                $city <br>
            </div>
            <div>
                <div>
                    Diamond Seats: $dia <br>
                    Gold Seats: $gold <br>
                    Silver Seats: $sil <br>
                </div>
                Total Price:$$price <br>
            </div>
        </div>;
    </div>";

        ?>
        
        
        
  </body>
</html>