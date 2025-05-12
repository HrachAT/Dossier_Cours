<?php

require_once __DIR__ . '/france2015.inc.php';

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'GET') {
    $id = filter_input(INPUT_GET, 'user');
    $nouvelleDateDeNaissance = filter_input(INPUT_GET, 'ddn');
    mettreAJourDateDeNaissance($id,$nouvelleDateDeNaissance);
    header("Location: ../index.php");
}
