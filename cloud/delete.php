<?php
require 'sqlconnect.php';

try {
    if (isset($_POST['delete']))   {
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
    
    }   
    else{
        echo "EDIT ";
        echo $_POST['edit'];
        $id=$_POST['edit'];
        $sql = "SELECT Nom,Pays FROM ville WHERE Id='$id';";
        foreach ($conn->query($sql) as $row) {
          $_POST["nom"] = $row["Nom"];
          $_POST["pays"] = $row["Pays"];
        }
        header('Location: fusion.php');
    }

  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
  $conn = null;
?>