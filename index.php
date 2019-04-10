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
            <div class="large 6">
                <div style="width: 100%; text-align: center;">
                    <img src="<?php echo $putanjaAPP ?>img/logo2.png" alt="ERA" />
                </div>
            </div>
            <div class="large 6">
                <a href="https://www.crvenikrizosijek.hr/" >Gradsko društvo Crvenog Križa Osijek</a>
            </div>
		</div>
		<?php include_once 'include/podnozje.php'; ?>
		
      
    </div>

    <?php include_once 'include/skripte.php'; ?>
  </body>
</html>
