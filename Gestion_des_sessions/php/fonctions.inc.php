<!DOCTYPE html>

<?php

function verifierDoubleMotPasse($mdp, $confirme) {
    $retour = FALSE;
    if ($confirme == $mdp) {       
        $retour = TRUE;
    }
    return $retour;
}
