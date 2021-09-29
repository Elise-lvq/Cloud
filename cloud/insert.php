<?php
require 'sqlconnect.php';

try {
  
  //Récupération des $_POST
  $nomValue = filter_var($_POST["nom"], FILTER_SANITIZE_STRING);
  $paysValue = filter_var($_POST["pays"], FILTER_SANITIZE_STRING);
  //création de la requete sql
  $sql = "INSERT INTO ville (Nom,Pays)
  VALUES ('$nomValue', '$paysValue');";
  //Execution de la requete
  $conn->exec($sql);
  echo "New record created successfully";
  header('Location: fusion.php');
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

?>