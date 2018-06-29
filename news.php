<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <title>HomePage</title>
    <meta name="description" content="Descrizione sommaria.">
</head>
	<body>
		<?php
			include('common/header.html');
			include('common/menu.html');
			include('connessione.php'); 
			if(isset($_POST["email"])) {
				$connessione->query("INSERT INTO iscritto(email) VALUES ('".$_POST["email"]."');");
			}
			
		?>
		<div>
			<h2>Wrc: si ipotizza un calendario con 15 gare dal 2020</h2>
			Novità per la stagione 2020, quando il calendario Wrc potrebbe essere composto da 15 round. In questo ultimi periodi si è infatti parlato di un ritorno in 				grande stile del Safari Rally, ma non sono da sottovalutare nemmeno Giappone e il Cile, che spinge per una gara già nel 2019. Non sembrano incoraggianti al 			momento le notizie per quanto riguarda il Rally di Croazia, finito anch’essi nel ciclone delle potenziali gare con valenza mondiale.
			<a href="http://www.rallyssimo.it/2018/06/28/wrc-si-ipotizza-un-calendario-con-15-gare-dal-2020/">Continua a Leggere</a>
		</div>
		<div>
			<h2>WRC Sardegna: l’isola che c’è!</h2>
			Finalmente è arrivato il momento di veder sfrecciare i piloti del mondiale rally sulle nostre strade! Come di consuetudine la gara si terrà in Sardegna e quando 				si parla di rally di Italia non si può non pensare subito alle molte insidie che lo caratterizzano. Come per l'Argentina e il Portogallo, troveremo i primi 			piloti molto svantaggiati visto che dovranno spazzare la strada. 
			<a href="https://sport.sky.it/motori/2018/06/06/wrc-sardegna-2018-isola-che-ce.html">Continua a Leggere</a>
		</div>
		<div>
			<h2>WRC Rally Italia 2018 – Neuville re di Sardegna con la Hyundai i20 Coupé</h2>
			Grandi emozioni al Rally Italia Sardegna. Thierry Neuville (al volante della Hyundai i20 Coupé) si è aggiudicato la settima tappa del WRC 2018 beffando Sébastien 				Ogier nella Power Stage e andando a trionfare con soli 7 decimi di vantaggio sul cinque volte campione del mondo.
			I due rivali nella lotta per il titolo iridato hanno lasciato le briciole agli altri: Esapekka Lappi, terzo con la Toyota Yaris, ha infatti chiuso la gara con 				quasi due minuti di ritardo.
			<a href="https://www.panorama-auto.it/sport/rally/wrc-rally-italia-sardegna-2018-risultati-classifiche-neuville-hyundai-i20-coupe">Continua a Leggere</a>
		</div>
		<div>
			<form action="news.php" method="post">
				<fieldset>
					<legend>Iscriviti alla nostra Newsletter</legend>
            		<label for="email">E-mail:</label>
            		<input name="email" id="email" maxlenght="30" />
					<input type="submit" value="Invia" />
				</fieldset>
			</form>
		</div>
		<?php include('common/footer.php')?>
	</body>
</html>