<?php

try {
  function insert($conn){
    //filtre l'entrée de l'utilisateur
    $nomValue = filter_var($_POST["nom"], FILTER_SANITIZE_STRING);
    $paysValue = filter_var($_POST["pays"], FILTER_SANITIZE_STRING);
    //création de la requete sql
    $sql = "INSERT INTO ville (Nom,Pays)
    VALUES ('$nomValue', '$paysValue');";
    //Execution de la requete
    $conn->exec($sql);
    header('Location: fusion.php');
  }
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


?>