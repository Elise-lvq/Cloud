<?php
function edit($conn){
  try {
    //si =false -> update
    if ($_SESSION["edition"] == "false") {
      /*echo $_SESSION['nom'];
      echo $_SESSION['pays'];
      echo $_SESSION['index'];*/
      $int = $_SESSION['index'];
      $nom = $_SESSION['nom'];
      $pays = $_SESSION['pays'];
      $sql = "UPDATE ville SET Nom ='$nom',Pays='$pays' WHERE Id='$int' ;";
      echo $sql;
      /*$conn->query($sql);
      $_SESSION["edition"] = "true";*/

      header('Location: fusion.php');
    }else{
      //si =true -> afficher nom ville et pays dans les inpus type text
      echo $_SESSION["edition"];
      echo "***";
      echo $_SESSION['index'];
      $int = $_SESSION['index'];
      $sql = "SELECT Nom,Pays FROM ville WHERE Id=$int;";
      foreach ($conn->query($sql) as $row) {
        $_SESSION["nom"] = $row["Nom"];
        $_SESSION["pays"] = $row["Pays"];
      }
      $_SESSION["edition"] = "false";
      echo $_SESSION["edition"];
      //header('Location: fusion.php');
    }
    
  } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }

}
require 'sqlconnect.php';
edit($conn);
?>