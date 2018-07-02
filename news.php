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
<body class="news">
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
                    <input type="reset" class="button" value="Cancella"/>
                </fieldset>
        </form>
    </div>
<?php include('common/footer.php'); ?>
</body>
</html>