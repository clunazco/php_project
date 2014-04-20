<?php
require_once 'Config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$dbConn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_HOST_PORT);
if (mysqli_connect_errno())
{
  echo "Error conectandose a la base de datos";
  exit;
}
  
$result = mysqli_query($dbConn,"INSERT INTO USUARIOS (IDUSUARIO, NOMBRE, PASSWORD, CORREO)
VALUES ( 'rghp', 'Raul Huertas Paiva','".SHA1("rhuertas")."', 'rax20037@gmail.com')");
  if ( $result ){
      echo "Insercion exitosa";
  }else{
      echo "Insercion fallida de nuevo";
  }