<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Choistory</title>
</head>

<body>

<header>
    <?php if (!is_logged()) { ?>

        <div class="menu_header">
            <div class="option_menu"><a href="index.php">Accueil</a></div>
            <div class="option_menu"><a href="histoires.php">Mes histoires</a></div>
            <div class="option_menu"><a href="">Contact</a></div>
            <div class="option_menu"><a href="connexion.php">Connexion</a></div>
        </div>

    <?php }else { ?>

        <div class="menu_header">
            <div class="option_menu"><a href="../../index.php">Accueil</a></div>
            <div class="option_menu"><a href="../../histoires.php">Mes histoires</a></div>
            <div class="option_menu"><a href="">Contact</a></div>
            <div class="option_menu"><a href="../../compte.php">Mon compte</a></div>
        </div>

    <?php }?>

    <div>
        <div class="starsec"></div>
        <div class="starthird"></div>
        <div class="starfourth"></div>
        <div class="starfifth"></div>
    </div>
</header>

<div class="marge">