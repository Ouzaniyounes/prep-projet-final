<?php 
    ini_set('display_errors', 1);
    include("connexionDatabase.php");
    // session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Create Account page</title>
    </head>
    <body>

        <?php 

                    if(isset($_SESSION["nom_user"])) {
                        header("location:index.php");
                    } else {
        
                        if(isset($_POST["submit"])) {
                            if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) &&  isset($_POST["username"]) && isset($_POST["Password"])) {
                                if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["Password"])) {
                                    echo "sucsses;";

                                    $Nom = htmlspecialchars($_POST["nom"]);
                                    $prenom = htmlspecialchars($_POST["prenom"]);
                                    $email = htmlspecialchars($_POST["email"]);
                                    $Username = htmlspecialchars($_POST["username"]);
                                    $Password = password_hash(htmlspecialchars($_POST["Password"]), PASSWORD_BCRYPT); // Hash the password
                                    $Etat = 0;
                                    $Role = 2;

                                    $ProfileImg_user = $_FILES['ProfilePicture'];
                                    $ProfileImg_user_FileName = $_FILES['ProfilePicture']['name'];
                                    $ProfileImg_user_FileTempName = $_FILES['ProfilePicture']['tmp_name'];
                                    $ProfileImg_user_FileSize = $_FILES['ProfilePicture']['size'];
                                    $ProfileImg_user_FileError = $_FILES['ProfilePicture']['error'];
                                    $ProfileImg_user_FileType = $_FILES['ProfilePicture']['type'];

                                    $ProfileImg_user_Destination = "../res/img/".$ProfileImg_user_FileName;
                                    move_uploaded_file($ProfileImg_user_FileTempName , $ProfileImg_user_Destination);
                                    $test = 1;
                                    

                                    $req = $db->prepare("INSERT INTO Utilisateur (nom_user, prenom_user, email_user, Username, Password, ProfileImg_user, Etat, Role) 
                                                        VALUES (:Nom, :prenom, :email, :username, :password, :ProfileImg_user, :Etat, :Role)");

                                    $result = $req->execute([
                                        ":Nom" => $Nom,
                                        ":prenom" => $prenom,
                                        ":email" => $email,
                                        ":username" => $Username,
                                        ":password" => $Password,
                                        ":ProfileImg_user" => $ProfileImg_user_Destination,
                                        ":Etat" => $Etat,
                                        ":Role" => $Role
                                    ]);
                                    
                                    if($result) {
                                        echo "Data inserted successfully!";
                                    } else {
                                        echo "Failed to insert data.";
                                        print_r($req->errorInfo()); // Debugging information
                                    }
                                } else {
                                    echo "Please fill in all fields.";
                                }
                            }
                        }
                }        

?>

        <form action="CreateAccount.php" method="POST" enctype="multipart/form-data">

            <label for="Nom">Nom</label>
            <input type="text" placeholder="Nom" name="nom">
            <br><br>
            <label for="Prenom">Prenom</label>
            <input type="text" placeholder="Prenom" name="prenom">
            <br><br>
            <label for="Username">Username</label>
            <input type="text" placeholder="Username" name="username">
            <br><br>
            <label for="Password">Password</label>
            <input type="password" placeholder="Password" name="Password">
            <br><br>
            <label for="Email">Email</label>
            <input type="email" placeholder="Email" name="email">
            <br><br>
            <label for="phtProfile">Upload the image</label>
            <input type="file" name="ProfilePicture" id="">
            <br><br>

            <input type="submit" name="submit">

        </form>

        <a href="login.php"> login account </a>

        
    </body>
</html>
