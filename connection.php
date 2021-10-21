<?php

$sHost = "193.198.57.183";
$sUsername = "pin";
$sPassword = "Vsmti1234!";
$sDatabase = "STUDENTI_PIN";

try 
{
    $oDbConnector = new PDO("sqlsrv:Server=$sHost;Database=$sDatabase;ConnectionPooling=0", "$sUsername", "$sPassword");
} 
catch (PDOException $e) 
{
    echo $e;
}


?>