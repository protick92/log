<html>
	<head>
	<title>PHP Test</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="font-awesome/css/font-awesome-animation.min.css" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<?php
		$page = $_SERVER['PHP_SELF'];
		$sec = "50000000";
		header("Refresh: $sec; url=$page");
		
	?> 
	
	 
	<script language="javascript">
	
	// JS for demo
$( document ).ready(function() {

$( "#dialog1" ).dialog({
			autoOpen: false,
			show: {
				effect: "fade",
				duration: 150
			},
			hide: {
				effect: "fade",
				duration: 150
			},
			position: {
  			my: "center",
  			at: "center"
			},
			// Add the 2 options below to use click outside feature
			clickOutside: true, // clicking outside the dialog will close it
			clickOutsideTrigger: "#opener1"  // Element (id or class) that triggers the dialog opening 
		});

$('#dialog1').dialog("option", "width", "auto"); 

		$( "#opener1" ).click(function() {
			$( "#dialog1" ).dialog( "open" );
		});
});

</script>
	
	
	</head>
	<body>
		<?php 
		// fopen -> Funzione che serve per aprire i file
		$var=fopen(
				   "connector.log"		/* Nome del file da aprire 	 */
				   ,"r"					/* Apro file in sola lettura */
				   );

		// Popolo l'oggetto $contents  con il contenuto del file
		$contents = fread($var, filesize("connector.log"));
		
		// Chiudo il file
		fclose($var);

		// dividi contents in un'array composto da ogni riga
		$array_contents = explode("\n", $contents);
		
		// Contiene l'insieme delle righe che si vogliono catturare.
		// Viene anche usata per popolare il dialog
		$tieniTraccia="";
		
		// barra di navigazione
		echo '<nav class="navbar navbar-default"><h4 style="font-size:18pt; text-align:center; padding:2px; color:black;font-family:Dosis,sans-serif;">Riepilogo File</h4></nav>';
		
		// Scorro l'array
		foreach ($array_contents AS $key=>$value) {
			//qui stai scorrendo le righe
			
			// Prendo il valore trimato
			$valore = trim($value, " \t\n\r");
			
			/*Controllo per catturare la Eccezione*/
			$findme   = 'EXCEPTION';
			
			// strtoupper -> funzione trasforma i caratteri in mauscolo
			// strpos -> Funzione che serve per confrontare le due stringhe
			$pos = strpos(strtoupper ($valore) , $findme);
			
			// Caso verde
			if ($pos === false) 
			{
				//echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">';
				//echo '<div class="panel panel-green">';
				//echo '		<div class="panel-heading">';
				//echo '			<div class="row">';
				//echo '				<div class="col-xs-3 iconaBox faa-parent animated-hover">';
				//echo '					<i class="fa fa-check-circle fa-3x faa-tada" id="opener2"></i>';
				//echo '				</div>';
				//echo '				<div  text-left">';
				//echo '					<div style="font-size:10pt;text-align:center;">';
				//echo $valore ;
				//echo '				    </div>';
				//echo '				</div>';
				//echo '			</div>';
				//echo '		</div>';
				//echo '	</div>';
				//echo '</div>';				
			}
			else
			{
				$tieniTraccia=$tieniTraccia . $valore . "<br>";
				echo '<div class="col-lg-6 col-md-6 col-sm-4 col-xs-3">';
				echo '<div class="panel panel-red">';
				echo '		<div class="panel-heading">';
				echo '			<div class="row">';
				echo '				<div class="col-xs-3 iconaBox faa-parent animated-hover">';
				echo '					<i class="fa fa-check-circle fa-3x faa-tada" onclick="openDialog();"></i>';
				echo '				</div>';
				echo '				<div  text-left">';
				echo '					<div style="font-size:10pt;text-align:center;">';
				echo $valore ;
				echo '				    </div>';
				echo '				</div>';
				echo '			</div>';
				echo '		</div>';
				echo '	</div>';
				echo '</div>';
			}
		}	// Fine loop
		?> 
	
	<!-- button utilizzato per vedere il dettaglio -->
	<div class="button-holder" >
		<button type="button" class="btn btn-info center-block" id="opener1">Vedere il dettaglio</button>
	</div>

	<div id="dialog1" title="Dialog">
		<p>Ci sono state le seguenti righe che hanno dato Eccezione :<br><?=$tieniTraccia ?></p>
	</div>

	</body>
</html>