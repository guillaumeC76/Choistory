<?php
session_start();
include ('inc/function.php');
include ('inc/pdo.php');
$errors = array();
$success = false;

// Traitement de formulaire

if (!empty($_POST['submitted'])) {

    // Protection des failles XSS
    $nom    = trim(strip_tags($_POST['nom']));
    $prenom     = trim(strip_tags($_POST['prenom']));
    $pseudo    = trim(strip_tags($_POST['pseudo']));
    $email     = trim(strip_tags($_POST['email']));
    $password1 = trim(strip_tags($_POST['password1']));
    $password2 = trim(strip_tags($_POST['password2']));

    // Validation de chaque champs
    // 1 - Pseudo
    if (empty($pseudo)) {
        $errors['pseudo'] = 'Veuillez renseigner ce champs';
    } elseif (mb_strlen($pseudo) > 120) {
        $errors['pseudo'] = 'Votre pseudo doit contenir moins de 120 caractères';
    } elseif (mb_strlen($pseudo) < 2) {
        $errors['pseudo'] = 'Votre pseudo doit contenir plus de 2 caractères';
    } else {
        $sql = "SELECT id FROM users WHERE pseudo = :pseudo LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $query->execute();
        $verifpseudo = $query->fetch();
        if (!empty($verifpseudo)) {
           $errors['pseudo'] = 'Ce pseudo existe dejà !';
        }
    }

    // 2 - Email
    if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $errors['email'] = 'Veuillez renseigner un email valide';
    } else {
        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $verifemail = $query->fetch();
        if (!empty($verifemail)) {
            $errors['email'] = 'Cet email existe dejà !';
        }
    }

    // 3 - Password
    if (!empty($password1)) {
        if ($password1 != $password2) {
            $errors['password'] = 'Vos mots de passe doivent être identiques';
        } elseif (mb_strlen($password1) <= 5) {
            $errors['password'] = 'Le mot de passe doit contenir minimum 6 caractères';
        }
    } else {
        $errors['password'] = 'Veuillez renseigner un mot de passe';
    }

    // 4 - Nom
    if (empty($nom)) {
        $errors['nom'] = 'Veuillez renseigner ce champs';
    } else {
        $sql = "SELECT id FROM users WHERE nom = :nom LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom',$nom,PDO::PARAM_STR);
        $query->execute();
        $verifnom = $query->fetch();
        if (!empty($verifnom)) {
           $errors['nom'] = 'Ce nom existe dejà !';
        }
    }
    // 5 - Prenom
    if (empty($prenom)) {
        $errors['prenom'] = 'Veuillez renseigner ce champs';
    } else {
        $sql = "SELECT id FROM users WHERE prenom = :prenom LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
        $query->execute();
        $verifprenom = $query->fetch();
        if (!empty($verifprenom)) {
           $errors['prenom'] = 'Ce prenom existe dejà !';
        }
    }

    if (count($errors) == 0) {
        // Password Hasher
        $hashPassword = password_hash($password1, PASSWORD_BCRYPT);
        $token = generatorToken(120);

        // Insert
        $sql = "INSERT INTO users VALUES (null,:nom,:prenom,:pseudo,:email,:password,:token)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom',$nom,PDO::PARAM_STR);
        $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
        $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->bindValue(':password',$hashPassword,PDO::PARAM_STR);
        $query->bindValue(':token',$token,PDO::PARAM_STR);
        $query->execute();
        $success = true;

        // Redirection vers la connexion
        header('Location: connexion.php');
    }
}

include ('inc/header.php'); ?>

<h3>Inscription</h3>

<form action="inscription.php" method="post" class="formulaire">

    <div class="champs">
        <label for="nom">Nom :</label><br>
        <input type="text" name="nom" id="nom" value="<?php if (!empty($_POST['nom'])) { echo $_POST['nom'];}?>">
        <p class="erreur"><?php if (!empty($errors['nom'])) { echo $errors['nom']; } ?></p>
    </div>

    <div class="champs">
        <label for="prenom">Prénom :</label><br>
        <input type="text" name="prenom" id="prenom" value="<?php if (!empty($_POST['prenom'])) { echo $_POST['prenom'];}?>">
        <p class="erreur"><?php if (!empty($errors['prenom'])) { echo $errors['prenom']; } ?></p>
    </div>

    <div class="champs">
        <label for="pseudo">Pseudo :</label><br>
        <input type="text" name="pseudo" id="pseudo" value="<?php if (!empty($_POST['pseudo'])) { echo $_POST['pseudo'];}?>">
        <p class="erreur"><?php if (!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></p>
    </div>

    <div class="champs">
        <label for="email">Email :</label><br>
        <input type="email" name="email" id="email" value="<?php if (!empty($_POST['email'])) { echo $_POST['email'];}?>">
        <p class="erreur"><?php if (!empty($errors['email'])) { echo $errors['email']; } ?></p>
    </div>

    <div class="champs">
        <label for="password1">Mot de passe :</label><br>
        <input type="password" name="password1" id="password1" value="">
        <p class="erreur"><?php if (!empty($errors['password'])) { echo $errors['password']; } ?></p>
    </div>

    <div class="champs">
        <label for="password2">Confirmez votre mot de passe :</label><br>
        <input type="password" name="password2" id="password2" value="">
    </div>

    <input type="submit" name="submitted" id="boutonenvoyer" value="Inscrivez-vous">
</form>


<?php include ('inc/footer.php');