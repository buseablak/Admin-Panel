<?php

$dbname="eticaret";
$user="root";
$password="";

try
{

 $db= new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8",$user,$password);
 //echo "bağlantı okey.";

}catch(PDOExpception $e){

   echo $e->getMessage();
}

