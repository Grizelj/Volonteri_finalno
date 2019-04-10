<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();
$greska=array();
if(!isset($_GET["sifra"])){
	
	
	if(isset($_POST["sifra"])){
		
		

	if(count($greska)==0){
		
		$veza->beginTransaction();
		
		$izraz=$veza->prepare("update akcija set ime_akcije=:ime_akcije,
		opis_akcije=:opis_akcije, datum=:datum, trajanje=:trajanje, mjesto=:mjesto where sifra=:sifra;");
		$izraz->execute(
			array(
                "sifra" => $_POST["sifra"],
				"ime_akcije" => $_POST["ime_akcije"],
				"opis_akcije" => $_POST["opis_akcije"],
                "datum" => $_POST["datum"],
				"trajanje" => $_POST["trajanje"],
                "mjesto" => $_POST["mjesto"]
				
			)
		);
		
	
		$veza->commit();
		
		header("location: akcije.php");
	}
	
	}else{
		header("location: " . $putanjaAPP . "logout.php");
	}
	
}else{
	
	$izraz=$veza->prepare("
						select 
							sifra,
							ime_akcije,
							opis_akcije,
							trajanje, 
							mjesto
						from akcija
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
      	<a href="akcije.php"><i style="color: red;" class="fas fa-chevron-circle-left fa-2x"></i></a>
      	<div class="grid-x grid-padding-x">
			<div class="large-4 large-offset-4 cell centered">
				<form class="log-in-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				  <h4 class="text-center">Detalji Akcije</h4>
				  
				  <?php 
				  
				  include_once 'input.php'; 
				  inputText("ime_akcije", "", $greska,"Ime akcije");
				  inputText("opis_akcije", "", $greska,"Opis akcije");
                  inputText("datum","",$greska,"Datum");
				  inputText("trajanje", "", $greska,"Trajanje");
				  inputText("mjesto", "", $greska,"Mjesto");
				  ?>			  

				  
                <input type="hidden" name="sifra" value="<?php echo $_POST["sifra"]; ?>"></input>
				<p><input type="submit" class="button expanded" value="Promjeni Akciju"></input></p>
				
				</form>
				
			</div>
		</div>
		<?php include_once '../../include/podnozje.php'; ?>
		
      
    </div>

    <?php include_once '../../include/skripte.php'; ?>
    <script>
    <?php if(isset($greska["ime_akcije"])):?>	
    		setTimeout(function(){ $("#ime_akcije").focus(); },1000);	
	<?php endif; ?>
    </script>
  </body>
</html>
