<?php
session_start();
include('inc/function.php');

if (!is_logged()) { 
    header('Location: connexion.php');
}

include('inc/header.php'); ?>

<div class="histoires_page">
    <a href="histoires/crispaux/crispaux.php">
        <div class="crispaux">
            <div class="image_crispaux">
                <img src="assets/img/ville-moderne.jpg" alt="Illustration de crispaux">
            </div>
            <div class="texte_crispaux">
                <h2>Crispaux</h2>
                <br>
                <p>Beaucoup de jeunes enfants rêvent de devenir agents secrets lorsqu'ils seront plus grands. Aujourd'hui, Peko 31 ans, agent secret et surtout bientôt papa. Réussirez-vous à garder sa femme en vie avant le terrible attentat sur Crispaux ? <br>A vous de jouer ➔</p>
            </div>
        </div>
    </a>

    <div class="crispaux">      
        <div class="texte_crispaux">
            <h2>Crispaux</h2>
            <br>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias voluptate suscipit nam molestiae reprehenderit possimus exercitationem nisi quaerat dolorum nostrum! Praesentium laborum corrupti officiis itaque ratione nemo porro voluptas veniam.</p>
        </div>
        <div class="image_crispaux">
            <img src="assets/img/ville-moderne.jpg" alt="Illustration de crispaux">
        </div>
    </div>

    <div class="crispaux">
        <div class="image_crispaux">
            <img src="assets/img/ville-moderne.jpg" alt="Illustration de crispaux">
        </div>
        <div class="texte_crispaux">
            <h2>Crispaux</h2>
            <br>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias voluptate suscipit nam molestiae reprehenderit possimus exercitationem nisi quaerat dolorum nostrum! Praesentium laborum corrupti officiis itaque ratione nemo porro voluptas veniam.</p>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>