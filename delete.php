<?php

try {
  function delete($conn){
    echo "DELETE ";
    echo $_POST['delete'];
    $button = $_POST['delete'];
    //Récupération des $_POST
    $idValue = filter_var($button, FILTER_SANITIZE_STRING);
    //création de la requete sql
    $sql = "DELETE FROM ville WHERE Id='$idValue'";
    //Execution de la requete
    $conn->exec($sql);
    header('Location: fusion.php');
    echo "delete";
  }

  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
?>