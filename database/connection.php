<?php

$serverName = "VEERPRATAP\SQLEXPRESS";
$database="Blood_Management_System";
$uid="";
$pass="";

$Connection=[
    "Database" => $database,
    "UID" =>$uid,
    "PWD" =>$pass
];

$conn= sqlsrv_connect($serverName,$Connection);

/*if (!$conn) 
    die(print_r(sqlsrv_errors(), true));
 else 
    echo "Connection successful!";*/
?>



