<?php
session_start();
include('inc/function.php');
include('inc/pdo.php');
$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {

    // Faille XSS
    $email = clean($_POST['email']);

    $sql = "SELECT email, token FROM users where email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if (!empty($user)) {
        $token = $user['token'];
        $email = urlencode($email);
        $html = '<p class="ici"><a href="modifMotDePasse.php?token=' . $token . '&email=' . $email . '">C\'est ici</a></p>';
        echo $html;

    } else {
        $errors['email'] = 'Veuillez renseigner un mot de passe';
    }

}

include('inc/header.php'); ?>

    <h3>Changer votre mot de passe</h3>

    <form action="" method="post" class="formulaire">

        <div class="champs">
            <label for="email">Email *</label>
            <input type="email" name="email" id="email" value="<?php if (!empty($_POST['email'])) {echo $_POST['email'];} ?>">
            <p class="erreur"><?php if (!empty($errors['email'])) {echo $errors['email'];} ?></p>
        </div>

        <input type="submit" name="submitted" id="boutonenvoyerMdpOublier" value="Modifier votre mot de passe">
    </form>

<?php include('inc/footer.php');