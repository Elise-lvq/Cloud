<?php
require 'sqlconnect.php';

try {
  /*
    $button = $_POST['delete']
    //Récupération des $_POST
    $idValue = filter_var($button, FILTER_SANITIZE_STRING);
    //création de la requete sql
    $sql = "DELETE FROM ville WHERE Id='$idValue'";
    //Execution de la requete
    $conn->exec($sql);*/
    echo $_POST['delete'];
    echo "Edited successfully";
    //header('Location: fusion.php');
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
  $conn = null;
?>