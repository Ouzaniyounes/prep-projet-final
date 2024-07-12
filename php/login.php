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
        <title>Login page</title>

        <!-- CSS Importations -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/all.css"> 
        <link rel="stylesheet" href="../css/style-login.css">

        <!-- React and Babel Importations -->
        <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script> 
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

    </head>

    <body>
        <?php

            if(isset($_SESSION["nom_user"])) {
                header("location:index.php");
            } else {
                if(isset($_POST["username"])) {
                    if(isset($_POST["username"]) && isset($_POST["password"])) {
                        if(!empty($_POST["username"]) && !empty($_POST["password"])) {
    
                            $username = htmlspecialchars($_POST["username"]);
                            $password = htmlspecialchars($_POST["password"]);
                            $req = $db->prepare("SELECT * FROM Utilisateur WHERE Username = :username");
    
                            $req->execute([
                                ":username" => $username   
                            ]);
    
                            $result = $req->fetch();
                            
                            if($result) {
                                if(password_verify($password, $result["Password"])) {
                                    $_SESSION["nom_user"] = $result["nom_user"];
                                    $_SESSION["Role"] = $result["Role"];
    
                                    $result["Etat"] = strtolower($result["Etat"]);
                                    if ($result["Etat"] == 1 ) {
                                        header("location:index.php");
                                        exit;
                                    } else {
                                        echo "Account not active.";
                                    }
                                } else {
                                    echo "Invalid username or password.";
                                }
                            } else {
                                echo "Invalid username or password.";
                            }
                        } else {
                            echo "Please fill in all fields.";
                        }
                    }
                }
            }

        ?>

        <div class="login-container">
            <img src="../res/img/277736639_2872316936246981_6722882252571223528_n (1).jpg" alt="" id="Zemzem-logo">
            <form action="" method="POST">
                <div class="input-container">
                    <input type="text" name="username" id="Username" placeholder="Username" class="input_class">
                    <input type="password" name="password" id="Password" placeholder="Password" class="input_class">
                    
                    <p id="password_incorrect">The password you’ve entered is incorrect. <a id="forget_password" href="">Forgot password?</a></p> 
                    <div class="Remember">
                        <input type="checkbox" id="Remember_password">
                        <label for="Remember_password">Remember password</label>
                        <br>
                    </div>
                </div>  

                <button type="submit">Se Connecter</button>
                <a id="forget_password" href="">Forgot password?</a>
            </form>
            <a href="CreateAccount.php">Create account</a>
        </div>
        
        <div id="root"></div>

        <!-- React Component Script -->
        <script type="text/babel" src="js/loginJs.js"> </script>

        <!-- JavaScript Importations -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script ></script>
    </body>
</html>
