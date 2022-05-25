<?php
   session_start();
   header('Content-Type: application/json');
   $conn = mysqli_connect("localhost","root","","utenti")or die(mysqli_connect_error());
   $username = $_SESSION['username'];

   $end_point=$_GET["q"];

   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL,$end_point);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($curl);
   $json = json_decode($result, true);
   curl_close($curl);

   
   $nuovojson=array();

   if(count($json)==0){
      $nuovoJson[]=array("content"=>false);
   }

   else{
      for($i=0;$i<count($json);$i++){

         $carrello=false;
         $idGioco = $json[$i]['gameID'];
         $query = "SELECT * from store where binary userID = '".$username."'  AND  idGioco ='".$idGioco."' ";
         $res = mysqli_query($conn,$query);
            
         if(mysqli_num_rows($res) > 0){
            $carrello=true;
         }
      else{
            $carrello=false;
         }

         $nuovoJson[]=array("Titolo"=>$json[$i]["external"],"Prezzo"=>$json[$i]["cheapest"],"Copertina"=>$json[$i]["thumb"],"carrello"=>$carrello,"cheapestDealID"=>$json[$i]["cheapestDealID"],"gameID"=>$json[$i]["gameID"]);
         
      }
   } 
   echo json_encode($nuovoJson);
     
?>