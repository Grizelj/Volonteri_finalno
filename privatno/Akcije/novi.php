<?php

include_once '../../konfiguracija.php'; 
provjeraOvlasti();

$veza->beginTransaction();

    $zadnjaSifra = $veza->lastInsertId();
	$izraz = $veza->prepare("
	insert into akcija (ime_akcije, opis_akcije, trajanje, mjesto)
			   values ( '', '', '', '')");
	$izraz->execute();
	$sifra = $veza->lastInsertId();

$veza->commit();

header("location: detalji.php?sifra=" . $sifra);
