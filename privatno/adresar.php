<?php include_once '../konfiguracija.php'; 
provjeraOvlasti();
$stranica = isset($_GET["stranica"]) ? $_GET["stranica"] : 1;
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once '../include/head.php'; ?>
    <link rel="stylesheet" href="<?php echo $putanjaAPP; ?>css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" media="print" href="<?php echo $putanjaAPP; ?>css/calendar/fullcalendar.print.min.css">
  </head>
  <body>
    <div class="grid-container">
    	<?php include_once '../include/zaglavlje.php'; ?>
      	<?php include_once '../include/izbornik.php'; ?>
      	
      	<div class="grid-x grid-padding-x">
			<div class="large-12 cell">
				
				<form method="get">
					<input type="text" name="uvjet" 
					placeholder="uvjet pretraživanja ( ime, prezime ili email)"
					value="<?php echo isset($_GET["uvjet"]) ? $_GET["uvjet"] : "" ?>" />
				</form>
				
				<?php
					
					$uvjet = "%" . (isset($_GET["uvjet"]) ? $_GET["uvjet"] : "") . "%";
					
					$izraz = $veza->prepare("
					
						select count(oib)
						from osoba 
						where concat(ime, prezime, email) 
						like :uvjet
					
					");
					$izraz->execute(array("uvjet"=>$uvjet));
					$ukupnoRedova = $izraz->fetchColumn();
					$ukupnoStranica = ceil($ukupnoRedova/$brojRezultataPoStranici);
					
					if($stranica<1){
						$stranica=1;
					}
					if($ukupnoStranica>0 && $stranica>$ukupnoStranica){
						$stranica=$ukupnoStranica;
					}
					

					$izraz = $veza->prepare("
					
						select 
							oib,
							ime, 
							prezime, 
							email,
                            adresa,
                            skola,
                            mobitel,
                            uloga
						from osoba 
						where concat(ime, prezime, email) 
						like :uvjet
						order by prezime, ime
					 	limit :stranica, :brojRezultataPoStranici");
					$izraz->bindValue("stranica", $stranica* $brojRezultataPoStranici -  $brojRezultataPoStranici , PDO::PARAM_INT);
					$izraz->bindValue("brojRezultataPoStranici", $brojRezultataPoStranici, PDO::PARAM_INT);
					$izraz->bindParam("uvjet", $uvjet);
					$izraz->execute();
					$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
				if($ukupnoRedova>$brojRezultataPoStranici){
					include 'paginacija.php';
				}
				  ?>
				  
				<table>
					<thead>
						<tr>
							<th>Polaznik</th>
							<th>Email</th>
                            <th>Adresa</th>
                            <th>Škola</th>
                            <th>Mobitel</th>
                            <th>Uloga</th>
						</tr>
					</thead>
					<tbody>
						
					<?php
					foreach ($rezultati as $red):
					?>
						
						<tr>
							<td><?php echo $red->prezime . " " . $red->ime ?></td>
                            <td><?php echo $red->email; ?></td>
							<td><?php echo $red->adresa; ?></td>
                            <td><?php echo $red->skola; ?></td>
                            <td><?php echo $red->mobitel; ?></td>
                            <td><?php echo $red->uloga; ?></td>
                            
                            
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
                <?php if($ukupnoRedova>$brojRezultataPoStranici){
					include 'paginacija.php';
				}?>
        
		<?php include_once '../include/podnozje.php'; ?>
		
      
                    </div>
                 </div>  
        </div> 
  

    <?php include_once '../include/skripte.php'; ?>
   </body> 
</html>
