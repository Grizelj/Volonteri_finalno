<?php include_once 'konfiguracija.php'; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once 'include/head.php'; ?>
  </head>
  <body>
    <div class="grid-container">
    	<?php include_once 'include/zaglavlje.php'; ?>
      	<?php include_once 'include/izbornik.php'; ?>
      	
      	<div class="grid-x grid-padding-x">
            <div class="large-6">
                
                Ime: <?php echo $_SESSION[$appID."autoriziran"]->ime; ?> <hr>
                Prezime: <?php echo $_SESSION[$appID."autoriziran"]->prezime; ?> <hr>
                Dob: <?php echo $_SESSION[$appID."autoriziran"]->dob; ?> <hr>
                Email: <?php echo $_SESSION[$appID."autoriziran"]->email; ?> <hr>
                                        
            </div>
            <div class="large-6">
                   
                Adresa: <?php echo $_SESSION[$appID."autoriziran"]->adresa; ?> <hr>
                Škola: <?php echo $_SESSION[$appID."autoriziran"]->skola; ?> <hr>
                Mobitel: <?php echo $_SESSION[$appID."autoriziran"]->mobitel; ?> <hr>
                Uloga: <?php echo $_SESSION[$appID."autoriziran"]->uloga; ?> <hr>
                          
            </div>
    
		</div>
		<?php include_once 'include/podnozje.php'; ?>
		
      
    </div>

    <?php include_once 'include/skripte.php'; ?>
  </body>
</html>
