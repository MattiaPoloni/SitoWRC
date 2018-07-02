<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
    <!-- meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="News Dal Mondo WRC." />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <title>News</title>
</head>
	<body>
		<div id="news">
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
                        echo "<p><h3>$row[0]</h3> <h5>Data: $row[4] Fonte: $row[2]</h5><br/><h6>$row[1] $link</h6></p>";
				}
			}
			$connessione->close();
		?>
		</div>
		<div>
			<form action="news.php" method="post">
				<fieldset>
					<legend>Iscriviti alla nostra Newsletter</legend>
            		<label for="email">E-mail:</label>
            		<input name="email" id="email" />					
					<input type="submit" value="Salva" />
					<input type="reset" value="Cancella"/>
				</fieldset>
			</form>
		</div>
		<?php include('common/footer.php');?>
	</body>
</html>