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
    <title>NEUVER - enregistrerMusicien</title>
    <link rel="shortcut icon" href="../assets/icon.png">
    <link rel="stylesheet" href="../assets/css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
      <a href="admin.php"><img class="home" src="../assets/home.png"></a>
      <?php
        //enregistrement de l'artiste/groupe dans le fichier
        if( !empty($_POST) ){
          $file = fopen("../files/infoMusiciens.csv", "a+");
          fwrite($file,$_POST["nom"]);
          fwrite($file,";");
          fwrite($file,$_POST["date"]);
          fwrite($file,";");
          fwrite($file,$_POST["nombre"]);
          fwrite($file, "\n");
          fclose($file);
        }

        //affichage du fichier sous forme de tableau
        echo "<table>";
        echo "<tr>";
        echo "<th> ARTISTE/GROUPE </th><th> DATE DE FORMATION </th><th> NOMBRE D'ALBUMS </th>";
        echo "</tr>";
        if (($handle = fopen("../files/infoMusiciens.csv", "r")) !== FALSE) {
            while ((($data = fgetcsv($handle, 1000, ";")) !== FALSE)) {
              echo "<tr>";
              for ($i=0; $i < 3; $i++) {
                echo "<td>".$data[$i]."</td>";
              }
              echo "<tr>";
            }
            fclose($handle);
        }
        echo "</table>";
      ?>
      <input class="submit add" type="submit" onclick="location.href = 'ajouterUnMusicien.php'" value="Ajouter un autre artiste/groupe">
      <input class="disconnect" type="submit" onclick="location.href = 'deconnexion.php'" value="Deconnexion">
    </div>
  </body>
</html>
