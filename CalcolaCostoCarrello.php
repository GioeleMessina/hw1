<?php
    session_start();

    header('Content-Type: application/json');
    $conn = mysqli_connect("localhost","root","","utenti")or die(mysqli_connect_error());
    $username=$_SESSION['username'];
    $query="SELECT  CONVERT(sum(SUBSTRING(costo,2)),FLOAT) as costoTot FROM store WHERE userID='".$username."' ";
    
    $res = mysqli_query($conn,$query);
    $calcolaCosto=mysqli_fetch_assoc($res);
    echo json_encode($calcolaCosto);
?>