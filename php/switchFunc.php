<?php



function showRole ($Role) {
    switch ($Role) {
      case "1":
        return "Admin";
        break;
      case "2":
        return "Utilisateur";
        break;
     
      default:
      return "Utilisateur";
    }
}


function showEtat ($Etat) {
    switch ($Etat) {
      case "0":
        return "Not Active";
        break;
      case "1":
        return "Active";
        break;
     
      default:
      return "Not Active";
    }
}





?>