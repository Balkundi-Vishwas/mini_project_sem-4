<?php

session_start();

include_once "../Shared/connection.php";

$uid = $_SESSION['user'];
$eid = $_GET['eid'];
$dia_seats = $_POST['dia_seats'].",";
$dia_seats1 = $_POST['dia_seats'];
$gold_seats = $_POST['gold_seats'].",";
$gold_seats1 = $_POST['gold_seats'];
$sil_seats = $_POST['sil_seats'].",";
$sil_seats1 = $_POST['sil_seats'];

$dia_price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from ticket_price where eid = $eid and class = 'diamond';"))['price'];
$gold_price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from ticket_price where eid = $eid and class = 'gold';"))['price'];
$sil_price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from ticket_price where eid = $eid and class = 'silver';"))['price'];

$test = "";
$total = 0;
for ($i = 0; $i < strlen($dia_seats); $i++)
{
    if ($i == 0 && $dia_seats[$i] == ",")
    {
        continue;
    }
    if ($dia_seats[$i] == ",")
    {
        $test = (int)$test;
        $total += $dia_price;
        $query = "UPDATE ticket_price set occupied = 1 where eid = $eid and class = 'diamond' and seatnum = $test;";
        mysqli_query($conn, $query);
        $test = "";
        continue;
    }
    $test .= $dia_seats[$i];
}
for ($i = 0; $i < strlen($gold_seats); $i++)
{
    if ($i == 0 && $gold_seats[$i] == ",")
    {
        continue;
    }
    if ($gold_seats[$i] == ",")
    {
        $test = (int)$test;
        $total += $gold_price;
        $query = "UPDATE ticket_price set occupied = 1 where eid = $eid and class = 'gold' and seatnum = $test;";
        mysqli_query($conn, $query);
        $test = "";
        continue;
    }
    $test .= $gold_seats[$i];
}
for ($i = 0; $i < strlen($sil_seats); $i++)
{
    if ($i == 0 && $sil_seats[$i] == ",")
    {
        continue;
    }
    if ($sil_seats[$i] == ",")
    {
        $test = (int)$test;
        $total += $sil_price;
        $query = "UPDATE ticket_price set occupied = 1 where eid = $eid and class = 'silver' and seatnum = $test;";
        mysqli_query($conn, $query);
        $test = "";
        continue;
    }
    $test .= $sil_seats[$i];

    
}
if ($total == 0)
{
    echo "<script>alert('Enter seats')</script>";
    die;
}
$query = "INSERT into booking(uid, eid, diamond, gold, silver, price) values($uid, $eid, '$dia_seats1', '$gold_seats1', '$sil_seats1', $total);";
mysqli_query($conn, $query);

$bid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from booking where uid = $uid and eid = $eid;"))['bid'];


echo "<html>
    <body>
        <h3>Do you want to print the ticket?</h3>
        <button><a href='print.php?bid=$bid'>Print Ticket</a></button>
    </body>
</html>"

?>