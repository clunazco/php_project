<?php

require_once 'Config.php';
require_once 'Utils.php';

class AccederResponse {
    public $valid = false;
    public $descripcion = "";
    public $rol = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    if( ($email=="") || ($password=="") ){
        $response = new AccederResponse();
        $response->descripcion = "Parametros invalidos";
        echo json_encode($response);
        exit;
    }
    $dbConn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_HOST_PORT);
    if (mysqli_connect_errno())
    {
       $ad = new AccederResponse();
       $ad->descripcion = "Failed to connect to MySQL: " . mysqli_connect_error();
       echo json_encode($ad);
       exit;
    }
    $query = "SELECT * FROM USUARIOS WHERE CORREO='".$email."' AND PASSWORD='".SHA1($password)."'";
    //echo $query;
    $result = mysqli_query($dbConn,$query);
    if ( $result ){
      $rowcount=mysqli_num_rows($result);
      $row = mysqli_fetch_array($result);
      $response = new AccederResponse();
      $response->valid = ($rowcount==1);
      echo json_encode($response);
      mysqli_free_result($result);
      exit;
    }else{
        $ad = new AccederResponse();
        $ad->descripcion = "No se ha encontrado al usuario";
        echo json_encode($ad);
        exit;
    }
    
}else{
    $response = new AccederResponse();
    $response->descripcion = "La consulta debe realizarse con el método POST";
    echo json_encode($response);
    exit;
}

