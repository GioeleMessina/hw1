<?php
   session_start();
    
   
   if(!isset($_SESSION['username'])){
      header("Location: Login.php");
      exit;
   }
    header('Content-Type: application/json');
    $conn=mysqli_connect("localhost","root","","utenti")or die(mysqli_connect_error());

    $userID=$_SESSION['username'];
    $query=" SELECT *  FROM store where binary userID= '".$userID."'";
    $res=mysqli_query($conn,$query);
    $array=array();
    while($row=mysqli_fetch_assoc($res)){
        array_push($array,$row);
    }
    $query=" SELECT count * FROM store where binary userID= '".$userID."'";
    
    echo json_encode($array);
?>
