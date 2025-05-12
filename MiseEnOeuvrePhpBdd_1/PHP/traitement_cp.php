<?php

require_once __DIR__ . '/france2015.inc.php';

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'GET') {
    $code = filter_input(INPUT_GET, 'cp');
    afficherVillesFromCp($code);
    afficherCompteVillesFromCp($code);
}

