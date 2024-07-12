<?php 
    ini_set('display_errors', 1);
    include("connexionDatabase.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Modify account</title>
    </head>
    <body>

        <?php

            if (!isset($_GET['id_user'])) {
                die("Error: : 'id' parameter is missing in the URL.");
            }

            $id_User = htmlspecialchars($_GET['id_user']);

            $req = $db -> prepare(" SELECT * FROM Utilisateur WHERE  id_user = :id");

            $req -> execute([
                ":id" => $id_User
            ]);

            $oldData = $req -> fetch();
                







            echo 
                    "  <form action='' method='POST' enctype='multipart/form-data'>

                                        <label for='Nom'>Nom</label>
                                        <input type='text' placeholder='Nom' name='nom' value='".$oldData["nom_user"]."'>
                                        <br><br>
                                        <label for='Prenom'>Prenom</label>
                                        <input type='text' placeholder='Prenom' name='prenom' value='".$oldData["prenom_user"]."'>
                                        <br><br>
                                        <label for='Username'>Username</label>
                                        <input type='text' placeholder='Username' name='username' value='".$oldData["Username"]."'>
                                        <br><br>
                                        <label for='Username'>Etat</label>
                                        <input type='text' placeholder='etat' name='Etat' value='".$oldData["Etat"]."'>
                                        <br><br>
                                        <label for='Username'>Role</label>
                                        <input type='text' placeholder='Role' name='Role' value='".$oldData["Role"]."'>
                                        <br><br>
                                        <label for='Password'> Password </label>
                                        <input type='password' placeholder='Password' name='Password' value='".$oldData["email_user"]."'>
                                        <br><br>
                                        <label for='Email'>Email</label>
                                        <input type='email' placeholder='Email' name='email' value='".$oldData["email_user"]."'>
                                        <br><br>
                                        <label for='phtProfile'>Upload the image</label>
                                        <input type='file' name='ProfilePicture' id=''>
                                        <br><br>

                                        <input type='submit' name='submit'>

                    </form>";


                    if(isset($_POST["submit"])) {
                        if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) &&  isset($_POST["username"]) &&  isset($_POST["Etat"]) &&  isset($_POST["Role"]) && isset($_POST["Password"])) {
                            if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["Etat"]) && !empty($_POST["Role"]) && !empty($_POST["Password"])) {

                                $Nom = htmlspecialchars($_POST["nom"]);
                                $prenom = htmlspecialchars($_POST["prenom"]);
                                $email = htmlspecialchars($_POST["email"]);
                                $Username = htmlspecialchars($_POST["username"]);
                                $Etat = htmlspecialchars($_POST["Etat"]);
                                $Role = htmlspecialchars($_POST["Role"]);
                                $Password = password_hash(htmlspecialchars($_POST["Password"]), PASSWORD_BCRYPT); // Hash the password
                                $ProfileImg_user = 1; // Assuming this is a placeholder value
                                $req2 = $db->prepare("UPDATE Utilisateur SET  nom_user = :nom_user , prenom_user = :prenom , email_user = :email , Username = :username , Etat = :Etat , Password = :Password , Role = :role  WHERE id_user =:id ");
                                $req2 -> execute([
                                    ":id" => $id_User ,
                                    ":nom_user" => $Nom ,
                                    ":prenom" => $prenom ,
                                    ":email" => $email ,
                                    ":username" => $Username ,
                                    ":Etat" => $Etat ,
                                    ":Password" => $Password ,
                                    ":role" => $Role
                                ]);

                                $Newdata = $req2 ;

                                if($Newdata) {
                                    header("location:index.php");
                                } else {
                                    echo " Data entred not successfully 2";
                                }

                            }
                        }
                    }

        

 
        
        ?> 

    </body>
</html>

<?php







?>