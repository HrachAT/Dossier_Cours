<?php

if (isset($_COOKIE["nom"], $_COOKIE["prenom"])){
    echo "Bonjour " . $_COOKIE["nom"]. $_COOKIE["prenom"]. "</br>";
}else{
    echo "Pas de cookie prèsent</br>";
}
