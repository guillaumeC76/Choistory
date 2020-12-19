<?php
session_start();
include ('inc/function.php');
include ('inc/pdo.php');

if (!empty($_POST['submitted'])) {

    // Protection des failles XSS
    $pseudo    = trim(strip_tags($_POST['pseudo']));
    $password = trim(strip_tags($_POST['password']));

    if (empty($pseudo) || empty($password)) {
        $errors['pseudo'] = 'Veuillez renseigner ce champ';
    } else {
        $sql = "SELECT * FROM users WHERE pseudo = :pseudo OR email = :pseudo";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        if (!empty($user)) {
            if (password_verify($password, $user['password'])) {

                $_SESSION['pseudo'] = array(
                    'id'     => $user['id'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'pseudo' => $user['pseudo'],
                );

                // Debug *_SESSION
                header('location: histoires.php');

            } else {
                $errors['pseudo'] = 'Pseudo ou email inconnu ou mot de passe oublié';
            }

        } else {
            $errors['pseudo'] = 'Pseudo ou email inconnu';
        }
    }

}

include ('inc/header.php'); ?>

<h3>Connexion</h3>

<form action="connexion.php" method="post" class="formulaire">

    <div class="champs">
        <label for="pseudo">Pseudo ou email *</label>
        <input type="text" name="pseudo" id="pseudo" value="<?php if (!empty($_POST['pseudo'])) { echo $_POST['pseudo'];}?>">
        <p class="erreur"><?php if (!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></p>
    </div>

    <div class="champs">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" value=""><br>
    </div>

    <span>Pas de compte ? <a href="inscription.php">Inscrivez-vous</a></span><br>
    <span class="autrepass">Ou alors vous avez <a href="motDePasseoublier.php">oublier votre mot de passe ?</a></span>

    <input type="submit" id="boutonenvoyer" name="submitted" value="connexion">

</form>

<?php include ('inc/footer.php');