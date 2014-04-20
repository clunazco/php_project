<?php

require_once 'Config.php';
require_once 'Utils.php';
class AdResponse {
    public $valid = False;
    public $descripcion  = "";
    public $distanceDescription = "";
    public $imageURL = "";
    public $phone = "";    
    public $shareLink = "";
    public $webLink = "";
    public $coordX = "";
    public $coordY = "";
}
$coordX = $coordY = "";



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $coordX = test_input_numeric($_POST["coordX"]);
  $coordY = test_input_numeric($_POST["coordY"]);
  if( ($coordX=="") || ($coordX=="") ){
      //echo "Consulta mal formada";
      $ad = new AdResponse();
      $ad->descripcion = "Consulta mal formada";
      echo json_encode($ad);
      exit;
  }else{
      $cX = floatval($coordX);
      $cY = floatval($coordY);
      //echo "Coordenadas son Lat: ".$cX.", Lon: ".$cY;
      //echo json_encode(new AdResponse());
  }
  $dbConn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_HOST_PORT);
  if (mysqli_connect_errno())
  {
    
    $ad = new AdResponse();
    $ad->descripcion = "Failed to connect to MySQL: " . mysqli_connect_error();
    echo json_encode($ad);
    exit;
  }
  mysqli_set_charset($dbConn,'utf8');
  $result = mysqli_query($dbConn,"SELECT * FROM ORDENES");
  if ( $result ){
      $rowcount=mysqli_num_rows($result);
      $row = mysqli_fetch_array($result);
      //echo $rowcount;
      $ad = new AdResponse();
      $ad->valid = True;
      $ad->descripcion = $row['DESCRIPCIONPRODUCTO'];
      $ad->phone = $row['PHONE_NUMBER'];
      $ad->distanceDescription = 'A menos de 1Km';
      $ad->shareLink = $row['SHARE_LINK'];
      $ad->webLink = $row['WEB_LINK'];
      $ad->coordX = $row['COORDX'];
      $ad->coordY = $row['COORDY'];
      $ad->imageURL  = $row['IMAGEN'].".jpg";
      $resultado = json_encode($ad);
      echo $resultado;  
      mysqli_free_result($result);
      exit;
  }else{
      $ad = new AdResponse();
      $ad->descripcion = "No se han encontrado anuncios";
      echo json_encode($ad);
      exit;
  }

  
  mysqli_close($dbConn);
}else{
    $ad = new AdResponse();
    $ad->descripcion = "Consulta GET no permitida"; 
    echo json_encode($ad);
    exit;
}


