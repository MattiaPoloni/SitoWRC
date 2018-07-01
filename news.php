<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <title>News</title>
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
			$query = "SELECT titolo, descrizione, fonte, indirizzo, data FROM Notizia ORDER BY id DESC;";
			$ris = $connessione->query($query);
			if(!$ris) {
                echo "Errore Database";
            } else {
                while($row = $ris->fetch_array(MYSQLI_NUM)) {
						$link = "<a href='$row[3]'>Continua a leggere</a>";
                        echo "<p><h2>$row[0]</h2> Data: $row[4] Fonte: $row[2]<br/>$row[1] $link</p>";
				}
			}
			$connessione->close();
		?>
		<div>
			<form action="news.php" method="post">
				<fieldset>
				<fieldset>
					<legend>Iscriviti alla nostra Newsletter</legend>
            		<label for="email">E-mail:</label>
            		<input name="email" id="email" maxlenght="30" />					
					<input type="submit" value="Salva" />
					<input type="reset" value="Cancella"/>
				</fieldset>
			</form>
		</div>
		<?php include('common/footer.php');?>
	</body>
</html>