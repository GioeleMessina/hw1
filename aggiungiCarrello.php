<?php 

   session_start();
    
   
   if(!isset($_SESSION['username'])){
      header("Location: Login.php");
      exit;
   }
    
    header('Content-Type: application/json');
    $conn=mysqli_connect("localhost","root","","utenti")or die(mysqli_connect_error());

    $immagine=mysqli_real_escape_string($conn,$_GET['image']);
    $titolo=mysqli_real_escape_string($conn,$_GET['title']);
    $prezzo=mysqli_real_escape_string($conn,$_GET['prezzo']);
    
    $idGame=mysqli_real_escape_string($conn,$_GET['idGame']);
    $userID=$_SESSION['username'];

    $query=" SELECT *  FROM store where binary userID= '".$userID."' AND idGioco ='".$idGame."'";

    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        $response=array("aggiunto"=> false);
        mysqli_close($conn);
        echo json_encode($response);
        exit;
    }

    else{
        $query="INSERT INTO store value('".$userID."','".$immagine."','".$titolo."','".$prezzo."','".$idGame."','')";
        $res=mysqli_query($conn,$query);
        if($res==true){
            $response=array("aggiunto"=> true);
        }else{
            $response=array("aggiunto"=> false);
        }
        mysqli_close($conn);
    }
    

    echo json_encode($response);
    
?>
