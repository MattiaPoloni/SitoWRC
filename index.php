<!DOCTYPE html>
<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/slide.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>HomePage</title>
    <meta name="description" content="Descrizione sommaria.">
</head>
<body class="home">
<?php session_start(); ?>
<?php include('common/header.html') ?>
<div class="slider content">
    <ul>
        <li>
            <input type="radio" id="slide1" name="slide" checked>
            <label for="slide1"></label>
            <div class="cont-img" alt="panel 1"></div>
        </li>
        <li>
            <input type="radio" id="slide2" name="slide">
            <label for="slide2"></label>
            <div class="cont-img-1" alt="panel 1"></div>
        </li>
        <li>
            <input type="radio" id="slide3" name="slide">
            <label for="slide3"></label>
            <div class="cont-img" alt="panel 1"></div>
        </li>
        <li>
            <input type="radio" id="slide4" name="slide">
            <label for="slide4"></label>
            <div class="cont-img-1" alt="panel 1"></div>
        </li>
    </ul>
</div>

<main>
    <!-- div padre -->
    <div class="container">

    <div class="space"></div>
        <!-- news -->
        <div>
        <?php
        include("connessione.php");
        $sql = "SELECT marca FROM Auto WHERE 1";
        $results = mysqli_query($connessione, $sql);
        $values = array();
        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
            $values[] = $row;
        ?>
        <?php foreach ($values as $value) : ?>
            <article class="news-home">
                <a href="" target="_self">
                    <img src="" alt="">gs
                    <time></time>
                    <h3><?php echo stripslashes($value['marca']); ?></h3>
                    <p></p>
                </a>
            </article>
        <?php endforeach; ?>
        </div>
        Top 3 Piloti
        News
        <br>
        <br>
        <br>
        <p>TEST GALLERY (ditemi se vi piace)</p>
        <a href="TestGallery/testGalleryPiloti.html">link</a>
        <br>
        <br>
        <br>

    </div>
</main>

<?php include('common/footer.php') ?>

</body>

</html>
