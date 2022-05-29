<?php

   session_start();
    
   
   if(!isset($_SESSION['username'])){
      header("Location: Login.php");
      exit;
   }

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


   for($i=0;$i<count($json["results"]);$i++){
            
      $genere=array();
      $piattaforma=array();

      $titolo = $json['results'][$i]['slug'];

      $query = "SELECT * from preferiti where binary userID = '".$username."'  AND  titolo ='".$titolo."' ";
      $res = mysqli_query($conn,$query);
    
      if(mysqli_num_rows($res) > 0){
        $pref=true;
      }
     else{
        $pref=false;
      }


      for($j=0;$j<count($json["results"][$i]["genres"]);$j++){
        
        $gen=$json['results'][$i]["genres"][$j]["name"];
        array_push($genere,$gen);
    
      }

      for($j=0;$j<count($json["results"][$i]["platforms"]);$j++){
        $console=$json['results'][$i]["platforms"][$j]["platform"]["name"];
        array_push($piattaforma,$console);
      }

      $array[]=array("Genere"=>$genere,"Console"=>$piattaforma,"Titolo"=>$titolo,"Voto"=>$json['results'][$i]["metacritic"],"Copertina"=>$json['results'][$i]["background_image"],"preferiti"=>$pref);
   }
   $nuovoJson=array("PagSucc"=>$json["next"],"PagPrecc"=>$json["previous"],"json"=> $array);

   echo json_encode($nuovoJson);
     
?>
