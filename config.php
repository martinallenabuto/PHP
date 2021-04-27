<?php
 session_start();

 $DB_host = "localhost";
 $DB_user = "root";
 $DB_pass = "";
 $DB_name = "login_db";

 try
 {
    $DB_con = New PDO("mysql:host=$DB_host;dbname=$DB_name", $DB_user, $DB_pass);
    $DB_con->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)

{
    echo $e->getMessage();
}

require_once ("User_Class.php");
$user = New USER($DB_con);


?>