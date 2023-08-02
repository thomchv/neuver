<?php
session_start();
if (isset($_SESSION["type"])){
  if ($_SESSION["type"]=="utilisateur"){
        header('Location: pages/rechercherDesMusiques.php');
        exit ();
  }
  if ($_SESSION["type"]=="administrateur"){
        header('Location: pages/admin.php');
        exit ();
  }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Neuver - connexion</title>
    <link rel="shortcut icon" href="../assets/icon.png">
    <link rel="stylesheet" href="../assets/css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
      <div class="connexion">
        <h1 class="title">CONNEXION</h1>
        <form class="form" id="form" action="pages/verificationConnexion.php" method="post">
          <input class="input" required="required" type="text" id="id" name="id" placeholder="Identifiant">
          <input class="input" required="required" type="password" id="mdp" name="mdp" placeholder="Mot de passe">
          <input class="submit" type="submit" name="submit" value="Se connecter">
        </form>
      </div>
    </div>
  </body>
</html>
