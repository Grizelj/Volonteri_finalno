<?php
include_once('../../konfiguracija.php');
$veza->beginTransaction();

if(isset($_GET['sifra'])) {
    $sifra = $_GET['sifra'];
    $izraz = $veza->prepare("delete from osoba where sifra = :sifra");
    $izraz->execute(array('sifra' => $sifra));
}

$veza->commit();

header('Location: adresar_admin.php'); ?>