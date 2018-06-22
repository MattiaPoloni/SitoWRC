<!DOCTYPE html>
<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/slide.css">

    <title>HomePage</title>
    <meta name="description" content="Descrizione sommaria.">
</head>
<body>
<?php include('common/header.html') ?>
<?php include('common/menu.html') ?>

<main>


    <ul class="slider">
        <li>
            <input type="radio" id="slide1" name="slide" checked>
            <label for="slide1"></label>
            <img src="media/gitS.png" alt="Panel 1">
        </li>
        <li>
            <input type="radio" id="slide2" name="slide">
            <label for="slide2"></label>
            <img src="media/nb.jpg" alt="Panel 2">
        </li>
        <li>
            <input type="radio" id="slide3" name="slide">
            <label for="slide3"></label>
            <img src="media/gitS.png" alt="Panel 3">
        </li>
        <li>
            <input type="radio" id="slide4" name="slide">
            <label for="slide4"></label>
            <img src="media/nb.jpg" alt="Panel 4">
        </li>
    </ul>

    Top 3 Piloti
    News
</main>

<?php include('common/footer.html') ?>
Link vari + Amministratori.

</body>

</html>
