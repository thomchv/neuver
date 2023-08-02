<?php
session_start();
if (!isset($_SESSION["id"])){
      header('Location: ../connexion.php');
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>NEUVER - afficherMusique</title>
    <link rel="shortcut icon" href="../assets/icon.png">
    <link rel="stylesheet" href="../assets/css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
      <a href="rechercherDesMusiques.php"><img class="home" src="../assets/home.png"></a>
      <?php
        $res=0;
        $nontrouve=$_POST['recherche'];
        $_POST['recherche']=strtolower($_POST['recherche']);
        $_POST["recherche"]=preg_replace("/[^a-zA-Z0-9]/", "", $_POST["recherche"]);
        if (($handle = fopen("../files/infoMusiciens.csv", "r")) !== FALSE) {
            while ((($data = fgetcsv($handle, 1000, ";")) !== FALSE)) {
              if(strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $data[0]))==$_POST['recherche']) {
                $titre = $data[0];
                $res=1;
              }
            }
            fclose($handle);
        }
        switch ($res) {
          case 0:
            echo "<p class='erreur'>Oups, il semblerait que ".$nontrouve." soit finito.</p>";
            break;
          case 1:
            /*
            //afficher le contenu du fichier correspondant à l'artiste
            echo "<h1 id='title' class='title'>".$titre."</h1>";
            echo "<table>";
            echo "<tr>";
            echo "<th> TITRE </th><th> DUREE (s)</th>";
            echo "</tr>";
            if (($handle = fopen("../artistes/".$_POST['recherche'].".csv", "r")) !== FALSE) {
                while ((($data = fgetcsv($handle, 1000, ";")) !== FALSE)) {
                  echo "<tr>";
                  for ($i=0; $i < 2; $i++) {
                    if (!$i) {
                      echo "<td onclick='rechercheytb(this)'>".$data[$i]."</td>";
                    }
                    else {
                      echo "<td>".$data[$i]."</td>";
                    }
                  }
                  echo "<tr>";
                }
                fclose($handle);
            }
            echo "</table>";
            */
            echo "<h1 id='title' class='title'>".$titre."</h1>";
            echo "
                  <table id='table'>
                    <tr>
                      <th>TITRE</th>
                      <th>DUREE (s)</th>
                    </tr>
                  </table>";
            break;
        }
      ?>

      <?php if ($res): ?>
        <script type="text/javascript">
          fetch(<?php echo "'../artistes/".$_POST['recherche'].".csv'"; ?>)
          .then(response => response.text())
          .then(csvData => {
              const lignes=csvData.split('\n');
              lignes.forEach(ligne => {
                  const donneeligne = document.createElement('tr');
                  var i=0;
                  ligne.split(';').forEach(colonne => {
                      const valeur = document.createElement('td');
                      if (!i) {
                        valeur.setAttribute('onclick', 'rechercheytb(this)');
                        i=1;
                      }
                      valeur.textContent = colonne;
                      donneeligne.appendChild(valeur);
                  });
                  document.getElementById('table').appendChild(donneeligne);
              });
          })
          .catch(error => {
              console.error(error);
          });
        </script>
      <?php endif; ?>

      <script type="text/javascript">
        function rechercheytb(e) {
          window.open ("https://www.youtube.com/results?search_query="+" "+document.getElementById('title').innerHTML+" "+e.innerHTML, "width=730,height=500");
        }
      </script>
      <input class="disconnect" type="submit" onclick="location.href = 'deconnexion.php'" value="Deconnexion">
    </div>
  </body>
</html>
