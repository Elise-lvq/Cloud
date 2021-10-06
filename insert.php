<?php

try {

  function insert($conn){
    $nomValue = filter_var($_POST["nom"], FILTER_SANITIZE_STRING);
    $paysValue = filter_var($_POST["pays"], FILTER_SANITIZE_STRING);
    //création de la requete sql
    $sql = "INSERT INTO ville (Nom,Pays)
    VALUES ('$nomValue', '$paysValue');";
    //Execution de la requete
    $conn->exec($sql);
    $_POST["nom"] = "";
    $_POST["pays"] = "";
    header('Location: fusion.php');
    echo "insert";
  }

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


?>