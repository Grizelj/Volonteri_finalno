<?php

include_once '../../konfiguracija.php'; 
provjeraOvlasti();

$veza->beginTransaction();

    $zadnjaSifra = $veza->lastInsertId();
	$izraz = $veza->prepare("
	insert into osoba ( ime,	prezime, email, adresa, skola, mobitel, uloga, volonterski_ugovor, dob, oib)
			   values ( '',		'',		'',			'',  '', '',  '',    '', '', '')");
	$izraz->execute();
	$sifra = $veza->lastInsertId();

$veza->commit();

header("location: detalji.php?sifra=" . $sifra);
