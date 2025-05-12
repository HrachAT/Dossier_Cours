<?php

if (isset($_COOKIE["nom"])) {
    echo "Bonjour " . $_COOKIE["nom"] . "</br>";
} else {
    echo"pas de cookie present";
}
