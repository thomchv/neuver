<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["type"]!="administrateur"){
      header('Location: ../connexion.php');
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>NEUVER - ajouterUnMusicien</title>
    <link rel="shortcut icon" href="../assets/icon.png">
    <link rel="stylesheet" href="../assets/css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
      <a href="admin.php"><img class="home" src="../assets/home.png"></a>
      <h1 class="title">AJOUTER UN MUSICIEN</h1>
      <form class="form" id="form" name="form" action="enregistrerMusicien.php" method="post">
        <input class="input" required="required" type="text" id="nom" name="nom" placeholder="Nom Artiste/Groupe"><br>
        <input class="input" required="required" type="number" id="date" name="date" placeholder="Date de Formation"><br>
        <input class="input" required="required" type="number" min="0" id="nombre" name="nombre" placeholder="Nombre d'albums"><br>
        <input class="submit" type="submit" name="submit" value="Valider">
      </form>
      <input class="disconnect" type="submit" onclick="location.href = 'deconnexion.php'" value="Deconnexion">
    </div>
  </body>
</html>
