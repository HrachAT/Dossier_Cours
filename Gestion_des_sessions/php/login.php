<?php
$logok = filter_input(INPUT_COOKIE, "logok");
if ($logok === "true") {
    header("Location: acceuil.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Connexion</h1>
    <form action="traitement2.php" method="post">
        <label for="login">Login :</label>
        <input type="text" name="login2" required>
        <br>
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp2" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>