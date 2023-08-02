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
    <title>NEUVER - enregistrerTitre</title>
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
        $titre=$_POST["artiste"];
        $_POST["artiste"]=strtolower($_POST["artiste"]);
        $_POST["artiste"]=preg_replace("/[^a-zA-Z0-9]/", "", $_POST["artiste"]);
        $file = fopen("../artistes/".$_POST["artiste"].".csv", "a+");
        fwrite($file,$_POST["titre"]);
        fwrite($file,";");
        fwrite($file,$_POST["duree"]);
        fwrite($file, "\n");
        fclose($file);

        //affichage
        echo "<h1 class='title'>".$titre."</h1>";
        echo "<table>";
        echo "<tr>";
        echo "<th> TITRE </th><th> DUREE (s)</th>";
        echo "</tr>";
        if (($handle = fopen("../artistes/".$_POST["artiste"].".csv", "r")) !== FALSE) {
            while ((($data = fgetcsv($handle, 1000, ";")) !== FALSE)) {
              echo "<tr>";
              for ($i=0; $i < 2; $i++) {
                echo "<td>".$data[$i]."</td>";
              }
              echo "<tr>";
            }
            fclose($handle);
        }
        echo "</table>";

      ?>
      <input class="submit add" type="submit" onclick="location.href = 'ajouterTitre.php'" value="Ajouter un autre titre">
      <input class="disconnect" type="submit" onclick="location.href = 'deconnexion.php'" value="Deconnexion">
    </div>
  </body>
</html>
