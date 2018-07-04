<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
    <!-- meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="News Dal Mondo WRC." />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print /">
    <title>News</title>
</head>
<body class="newsBody">
    <div class="container">
        <?php
        session_start();
        include('common/header.html');
        include('connessione.php');
        if (isset($_POST["email"])) {
            $connessione->query("INSERT INTO iscritto(email) VALUES ('" . $_POST["email"] . "');");
        }
        $query = "SELECT titolo, descrizione, fonte, indirizzo, data FROM Notizia ORDER BY id DESC;";
        $ris = $connessione->query($query);
        if (!$ris) {
            echo "Errore Database";
        } else {
            while ($row = $ris->fetch_array(MYSQLI_NUM)) :
                $link = "<a href='$row[3]'>Continua a leggere</a>";
                ?>
                <div class="viewNews">
                    <h2><?php echo $row[0]; ?></h2>
                    <h6>Data: <?php echo($row[4]); ?></h6>
                    <h6>Fonte: <?php echo $row[2]; ?></h6>
                    <p><?php echo $row[1]; ?></p>
                    <?php echo $link; ?>
                </div>
            <?php endwhile;
        }
        $connessione->close();
        ?>

        <form action="news.php" method="post">
                <fieldset>
                    <legend>Iscriviti alla nostra Newsletter</legend>
                    <label for="email">E-mail:</label>
                    <input name="email" id="email" maxlenght="30"/>
                    <input type="submit" class="button" value="Salva"/>
                    <input class="button" type="reset" value="Cancella"/>
                </fieldset>
        </form>
    </div>
<?php include('common/footer.php'); ?>
</body>
</html>
