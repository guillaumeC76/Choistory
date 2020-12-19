<?php

///////////////////////////////////////
// FONCTION DE CLEAN
///////////////////////////////////////

function clean($string) {
    $cleaner = trim(strip_tags($string));
    return $cleaner; }


    function debug($tableau) {
    echo '<pre>'; print_r($tableau); echo '</pre>';
}

///////////////////////////////////////
// FONCTION DE VALIDATION DE L'EMAIL
///////////////////////////////////////

function emailValid($err, $mail, $key) {
    if (!empty($mail)) {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $err[$key] = 'Email non valide';
        }
    } else {
        $err[$key] = "Veuillez renseigner ce champ";
    }
    return $err;
}

///////////////////////////////////////
// FONCTION DE VALIDATION DES TEXTES
///////////////////////////////////////

function textValid($err, $text, $key, $x, $y) {
    if (!empty($text)) {
        if (mb_strlen($text) < $x) {
            $err[$key] = 'Minimum '.$x.' caractères';
        }elseif (mb_strlen($text) > $y) {
            $err[$key] = 'Maximum '.$y.' caractères';
        }
    }else {
        $err[$key] = 'Veuillez renseigner ce champ';
    }
    return $err;
}

///////////////////////////////////////
// FONCTION D'OUBLIE DE MOT DE PASSE
///////////////////////////////////////

function generatorToken($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

///////////////////////////////////////
// FONCTION D'AFFICHAGE LORS DE CONNEXION
///////////////////////////////////////

function is_logged() {
    if (!empty($_SESSION['pseudo'])) {
        if (!empty($_SESSION['pseudo']['id']) && is_numeric($_SESSION['pseudo']['id'])) {                    
            return true;
        }
    }
    return false;
}