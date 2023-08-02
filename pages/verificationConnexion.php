<?php
session_start();
if (!isset($_SESSION["id"])){
      header('Location: ../connexion.php');
}
?>
<?php
$verif=false;
if (($handle = fopen("../files/identifiant.csv", "r")) !== FALSE) {
    while ((($data = fgetcsv($handle, 1000, ";")) !== FALSE) && !$verif) {
        if ($_POST['id']==$data[0] && $_POST['mdp']==$data[1]){
             $verif=true;
             $_SESSION["type"]=$data[2];
             $_SESSION["id"]=$data[1];
        }
    }
    fclose($handle);
}

if (!$verif){
      header('Location: ../connexion.php');
      exit ();
}
if ($verif && $_SESSION["type"]=="utilisateur"){
      header('Location: rechercherDesMusiques.php');
      exit ();
}
if ($verif && $_SESSION["type"]=="administrateur"){
      header('Location: admin.php');
      exit ();
}

?>
