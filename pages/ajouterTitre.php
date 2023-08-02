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
    <title>NEUVER - ajouterTitre</title>
    <link rel="shortcut icon" href="../assets/icon.png">
    <link rel="stylesheet" href="../assets/css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
      <a href="admin.php"><img class="home" src="../assets/home.png"></a>
      <h1 class="title">Ajouter un Titre</h1>
      <select name="select-artiste" id="select-artiste" onclick="select()">
        <option hidden id="default">Artiste</option>
        <?php
          if (($handle = fopen("../files/infoMusiciens.csv", "r")) !== FALSE) {
              while ((($data = fgetcsv($handle, 1000, ";")) !== FALSE)) {
                echo "<option id='".$data[0]."'>".$data[0]."</option>";
              }
              fclose($handle);
          }
        ?>
      </select>
      <form class="form" id="form" name="form" action="enregistrerTitre.php" method="post">
        <input disabled="disabled" class="input" required="required" type="text" id="titre" name="titre" placeholder="Titre"><br>
        <input disabled="disabled" class="input" required="required" type="number" min="0" id="duree" name="duree" placeholder="Durée"><br>
        <input class="input" type="hidden" id="artiste" name="artiste" value="artiste">
        <input disabled="disabled" class="submit" type="submit" name="submit" value="Ajouter">
      </form>
      <script type="text/javascript">
        function select() {
          if (document.getElementById('select-artiste').selectedIndex) {
            for (var i = 0; i < document.getElementsByClassName('input').length; i++) {
              document.getElementsByClassName('input')[i].removeAttribute('disabled');
            }
            document.getElementsByClassName('submit')[0].removeAttribute('disabled');
          }
          document.getElementById('artiste').setAttribute('value',document.getElementById('select-artiste').options[document.getElementById('select-artiste').selectedIndex].id);
        }
      </script>
      <input class="disconnect" type="submit" onclick="location.href = 'deconnexion.php'" value="Deconnexion">
    </div>
  </body>
</html>
