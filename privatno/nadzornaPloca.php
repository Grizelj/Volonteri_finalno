<?php include_once '../konfiguracija.php'; 
provjeraOvlasti();
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
      	
        
		<?php include_once '../include/podnozje.php'; ?>
		
      
    </div>
    
    

    <?php include_once '../include/skripte.php'; ?>

	
	
	
	
	<script src="<?php echo $putanjaAPP; ?>js/calendar/moment.min.js"></script>
	<script src="<?php echo $putanjaAPP; ?>js/calendar/fullcalendar.min.js"></script>
	<script src="<?php echo $putanjaAPP; ?>js/calendar/locale-all.js"></script>
  </body>
</html>
