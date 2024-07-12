<?php

    ini_set('display_errors', 1);
    include("connexionDatabase.php");

    if (!isset($_GET['id_user'])) {
        die("Error: : 'id' parameter is missing in the URL.");
    }
    $id_User = htmlspecialchars($_GET['id_user']);


    $req = $db -> prepare( "SELECT * FROM Utilisateur WHERE id_user = :id" );
    $req -> execute([
        ":id" => $id_User
    ]);

    $Result = $req -> fetch();

    switch ($Result["Etat"]) {
        case "0":
            $Result["Etat"] = 1 ;
          break;
        case "1":
            $Result["Etat"] = 0 ;
          break;
       
        default:
        $Result["Etat"] = 0;
      }

      $req2 = $db -> prepare("UPDATE Utilisateur SET Etat = :etat WHERE id_user = :id ");
      $result2 =  $req2 -> execute([
        ":id" => $Result["id_user"] , 
        ":etat" => $Result["Etat"]
      ]);
        
      

      if($result2) {
        header("location:index.php");
      } else {
        echo " Not Successfull";
      }
    
    



?>