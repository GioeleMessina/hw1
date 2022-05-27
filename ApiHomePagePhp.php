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



   for($i=0;$i<count($json["results"]);$i++){
      $pref=false;
      $titolo = $json['results'][$i]['slug'];

      $query = "SELECT * from preferiti where binary userID = '".$username."'  AND  titolo ='".$titolo."' ";
      $res = mysqli_query($conn,$query);
      if(mysqli_num_rows($res) > 0){
         $pref=true;
      }
     else{
         $pref=false;
      }

      $nuovoJson[]=array("Titolo"=>$titolo,"Voto"=>$json['results'][$i]["metacritic"],"Copertina"=>$json['results'][$i]["background_image"],"preferiti"=>$pref);

   }
   $array=array("PagSucc"=>$json["next"],"PagPrecc"=>$json["previous"],"json"=> $nuovoJson);

   echo json_encode($array);
     
?>
