<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function test_input_numeric($data)
{
  $res = test_input($data);
  if( ($res!="") and is_numeric($data) ){
      return $res;
  }else{
    return "";    
  }
}

function test_input_integer($data)
{
  $res = test_input($data);
  if( ($res!="") and is_int($data) ){
      return $res;
  }else{
    return "";    
  }
  
}