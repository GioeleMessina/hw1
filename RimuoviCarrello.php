
<?php 

session_start();
header('Content-Type: application/json');
$conn=mysqli_connect("localhost","root","","utenti")or die(mysqli_connect_error());
$idGame=mysqli_real_escape_string($conn,$_GET['idGame']);
$userID=$_SESSION['username'];
$query=" SELECT *  FROM store where binary userID= '".$userID."' AND idGioco ='".$idGame."'";
$res=mysqli_query($conn,$query);

if(mysqli_num_rows($res)<0){
    mysqli_close($conn);
    $response=array("rimosso"=> false);
    echo json_encode($response);
    exit;
}

else{
    $query="DELETE FROM store where binary userID= '".$userID."' AND idGioco ='".$idGame."'";
    $res=mysqli_query($conn,$query);
    if($res==true){
        $response=array("rimosso"=> true);
    }else{
        $response=array("rimosso"=> false);
    }
    mysqli_close($conn);
}

echo json_encode($response);
?>
