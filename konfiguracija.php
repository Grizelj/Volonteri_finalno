<?php

include_once 'funkcije.php';

session_start();

$putanjaAPP = "/Volonteri/";
$naslovAPP="GDCK Osijek";
$appID="volonteri";

$brojRezultataPoStranici=7;
if($_SERVER["HTTP_HOST"]==="localhost"){
$host="localhost";
	$dbname="volonteri";
	$dbuser="edunova";
	$dbpass="edunova";
	$dev=true;
}
else{
	$host="sql207.byethost.com";
	$dbname="b33_23745272_volonteri";
	$dbuser="b33_23745272";
	$dbpass="volonteri123";
	$dev=false;
}


	
try{
	$veza = new PDO("mysql:host=" . $host . ";dbname=" . $dbname,$dbuser,$dbpass);
	$veza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$veza->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8';");
	$veza->exec("SET NAMES 'utf8';");
}catch(PDOException $e){
	
	switch($e->getCode()){
		case 1049:
			header("location: " . $putanjaAPP . "greske/kriviNazivBaze.html");
			exit;
			break;
		default:
			header("location: " . $putanjaAPP . "greske/greska.php?code=" . $e->getCode());
			exit;
			break;
	}
}