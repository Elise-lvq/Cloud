<?php
function edit($conn){
  try {
    if ($_SESSION["edition"] == false) {
      echo $_SESSION['nom'];
      echo $_SESSION['pays'];
      echo $_SESSION['index'];
      /*$sql = "UPDATE 'ville' ,SET Nom ='$_SESSION['nom'],'Pays'='$_SESSION['pays']' WHERE 'Id'='$_SESSION['edit']'";
      echo $sql;
      $conn->query($sql);
      $_SESSION["edition"] = true;

      header('Location: fusion.php');
      echo "edit";*/
    }else{
      $_SESSION['index'] = (int)($_POST['edit']);
      echo $_SESSION['index'];
      $int = $_SESSION['index'];
      echo $int;
      $sql = "SELECT Nom,Pays FROM ville WHERE Id=$int;";
      foreach ($conn->query($sql) as $row) {
        $_SESSION["nom"] = $row["Nom"];
        $_SESSION["pays"] = $row["Pays"];
      }
      $_SESSION["edition"] = false;
      header('Location: fusion.php');
      echo "show";
      echo $_SESSION['nom'];
      echo $_SESSION['pays'];
    }
    
  } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
}

?>