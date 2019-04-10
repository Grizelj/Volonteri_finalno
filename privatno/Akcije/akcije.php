<?php include_once '../../konfiguracija.php'; 
provjeraOvlasti();
$stranica = isset($_GET["stranica"]) ? $_GET["stranica"] : 1;
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once '../../include/head.php'; ?>
    <link rel="stylesheet" href="<?php echo $putanjaAPP; ?>css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" media="print" href="<?php echo $putanjaAPP; ?>css/calendar/fullcalendar.print.min.css">
  </head>
  <body>
    <div class="grid-container">
    	<?php include_once '../../include/zaglavlje.php'; ?>
      	<?php include_once '../../include/izbornik.php'; ?>
      	
      	<div class="grid-x grid-padding-x">
			<div class="large-12 cell">
				
				<form method="get">
					<input type="text" name="uvjet" 
					placeholder="uvjet pretraživanja ( ime akcije )"
					value="<?php echo isset($_GET["uvjet"]) ? $_GET["uvjet"] : "" ?>" />
				</form>
				<a href="novi.php" class="button success expanded"><i class="fas fa-plus-circle fa-2x"></i></a>
				
				<?php
					
					$uvjet = "%" . (isset($_GET["uvjet"]) ? $_GET["uvjet"] : "") . "%";
					
					$izraz = $veza->prepare("
					
						select count(sifra)
						from akcija 
						where ime_akcije 
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
							sifra,
							ime_akcije, 
							opis_akcije,
                            datum,
							trajanje,
                            mjesto
						from akcija 
						where ime_akcije
						like :uvjet
						order by ime_akcije
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
							<th>Ime Akcije</th>
							<th>Opis Akcije</th>
                            <th>Datum</th>
                            <th>Trajanje</th>
                            <th>Mjesto</th>
                            <th>Obriši</th>
						</tr>
					</thead>
					<tbody>
						
					<?php
					foreach ($rezultati as $red):
					?>
						
						<tr>
							<td><?php echo $red->ime_akcije?></td>
                            <td><?php echo $red->opis_akcije; ?></td>
                            <td><?php echo $red->datum; ?></td>
							<td><?php echo $red->trajanje; ?></td>
                            <td><?php echo $red->mjesto; ?></td>
                               <td><a href="brisanje.php?sifra=<?php echo $red->sifra ?>"><i class="far fa-trash-alt fa-2x"></i></a>
                                <a href="detalji.php?sifra=<?php echo $red->sifra ?>"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            
                            
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
                <?php if($ukupnoRedova>$brojRezultataPoStranici){
					include 'paginacija.php';
				}?>
        
		<?php include_once '../../include/podnozje.php'; ?>
		
      
                    </div>
                 </div>  
        </div> 
  

    <?php include_once '../../include/skripte.php'; ?>
   </body> 
</html>
