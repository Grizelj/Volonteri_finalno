<?php

if(!isset($_POST["email"]) || !isset($_POST["lozinka"])){
	exit;
}

include_once 'konfiguracija.php';
$izraz=$veza->prepare("insert into osoba (email,lozinka,ime,prezime,uloga,aktivan,sessionid)
 values (:email,md5(:lozinka),:ime,:prezime,'volonter',false,'" . session_id() . "');");
$izraz->execute($_POST);
$poruka = "Klikom na http://edunovanastava.byethost33.com/EdunovaAPP/aktiviraj.php?id=" 
. session_id() . " završite registraciju!";

require 'PHPmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
saljiEmail($mail,array(array("email"=>$_POST["email"], "ime"=>$_POST["ime"] . " " . 
$_POST["prezime"])),"Volonter registracija",$poruka);
session_regenerate_id();
session_destroy();

?>
Pogledajte email

