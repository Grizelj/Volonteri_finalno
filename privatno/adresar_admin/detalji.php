<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();
$greska=array();
if(!isset($_GET["sifra"])){
	
	
	if(isset($_POST["sifra"])){
		
		

	if(count($greska)==0){
		
		$veza->beginTransaction();
		
		$izraz=$veza->prepare("update osoba set ime=:ime, prezime=:prezime, 
		email=:email, oib=:oib, skola=:skola, adresa=:adresa, mobitel=:mobitel, dob=:dob, volonterski_ugovor=:volonterski_ugovor  where sifra=:sifra;");
		$izraz->execute(
			array(
				"ime" => $_POST["ime"],
				"prezime" => $_POST["prezime"],
				"email" => $_POST["email"],
				"oib" => $_POST["oib"],
                "skola" => $_POST["skola"],
                "adresa" => $_POST["adresa"],
                "mobitel" => $_POST["mobitel"],
                "dob" => $_POST["dob"],
                "volonterski_ugovor" => $_POST["volonterski_ugovor"],
				"sifra" => $_POST["sifra"]
			)
		);

		
		$veza->commit();
		
		header("location: adresar_admin.php");
	}
	
	}else{
		header("location: " . $putanjaAPP . "logout.php");
	}
	
}else{
	
	$izraz=$veza->prepare("
						select 
							sifra,
							volonterski_ugovor,
							oib,
							ime, 
							prezime, 
							email,
                            skola,
                            adresa,
                            mobitel,
                            dob
						from osoba
						where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST=$izraz->fetch(PDO::FETCH_ASSOC);
	
}




?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once '../../include/head.php'; ?>
  </head>
  <body>
    <div class="grid-container">
    	<?php include_once '../../include/zaglavlje.php'; ?>
      	<?php include_once '../../include/izbornik.php'; ?>
      	<a href="adresar_admin.php"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i></a>
      	<div class="grid-x grid-padding-x">
			<div class="large-4 large-offset-4 cell centered">
				<form class="log-in-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				  <h4 class="text-center">Detalji Volontera</h4>
				  
				  <?php 
				  
				  include_once 'input.php'; 
				  inputText("ime", "Ivan", $greska,"Ime");
				  inputText("prezime", "Horvat", $greska,"Prezime");
				  inputText("email", "ihorvat@edunova.hr", $greska,"E-mail");
				  inputText("oib", "25696568545", $greska,"OIB");
                  inputText("skola", " ", $greska,"Škola");
                  inputText("adresa", " ", $greska,"Adresa");
                  inputText("mobitel", " ", $greska,"Mobitel");
                  inputText("dob", " ", $greska,"Dob");
				  inputText("volonterski_ugovor", " ", $greska,"Volonterski ugovor");
				  ?>
				  
                <input type="hidden" name="sifra" value="<?php echo $_POST["sifra"]; ?>"></input>
				<p><input type="submit" class="button expanded" value="Promjeni Volontera"></input></p>
				
				</form>
				
			</div>
		</div>
		<?php include_once '../../include/podnozje.php'; ?>
		
      
    </div>

    <?php include_once '../../include/skripte.php'; ?>
    <script>
    <?php if(isset($greska["naziv"])):?>	
    		setTimeout(function(){ $("#naziv").focus(); },1000);	
	<?php endif; ?>
    </script>
  </body>
</html>
