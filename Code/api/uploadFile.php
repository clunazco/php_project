<?php

require_once 'Config.php';
require_once 'Utils.php';

class UploadFileRequest {
    public $username;
    public $contrato;
}

class UploadFileResponse {
    public $result = "fail";
    public $descripcion = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = test_input_integer($_POST["username"]);
    $contrato = test_input_integer($_POST["contrato"]);
    if( ($contrato=="") ){
        //echo "Consulta mal formada";
        $ad = new UploadFileResponse();
        $ad->descripcion = "Cliente o contrato inválidos";
        echo json_encode($ad);
        exit;
    }
    $dbConn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_HOST_PORT);
    if (mysqli_connect_errno())
    {
       $ad = new AdResponse();
       $ad->descripcion = "Failed to connect to MySQL: " . mysqli_connect_error();
       echo json_encode($ad);
       exit;
    }
    
    
    
}else{
    $ad = new UploadFileResponse();
    $ad->descripcion = "Consulta GET no permitida";
    echo json_encode($ad);
    exit;
}

