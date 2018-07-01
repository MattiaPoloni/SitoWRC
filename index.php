<!DOCTYPE html>
<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/slide.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <title>HomePage</title>
    <meta name="description" content="Descrizione sommaria.">
</head>
<body>
<?php include('common/header.html') ?>
<?php include('common/menu.html') ?>

<main>

    <div class="slider">
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
    <div class="container">
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
