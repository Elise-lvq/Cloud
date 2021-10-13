<?php
function edit($conn){
  try {
    //si edition = false -> update
    if ($_SESSION["edition"] == "true") {
      $int = $_SESSION['index'];
      $nom = filter_var($_SESSION['nom'], FILTER_SANITIZE_STRING);
      $pays =  filter_var($_SESSION['pays'], FILTER_SANITIZE_STRING);
      $sql = "UPDATE ville SET Nom ='$nom',Pays='$pays' WHERE Id='$int' ;";
      //efface les donnéesdes variables de session puisque la requete est écrite est terminé
      session_unset();
      $conn->query($sql);
      $_SESSION["edition"] = "false";
      header('Location: fusion.php');
    }else{
      //si edition = true -> afficher nom ville et pays dans les inpus type text formulaire
      $int = $_SESSION['index'];
      $sql = "SELECT Nom,Pays FROM ville WHERE Id=$int;";
      foreach ($conn->query($sql) as $row) {
        $_SESSION["nom"] = $row["Nom"];
        $_SESSION["pays"] = $row["Pays"];
      }
      $_SESSION["edition"] = "true";
    }
    
  } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }

}
?>