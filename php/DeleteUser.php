
        <?php 
                        ini_set('display_errors', 1);
                        include("connexionDatabase.php");

                        if (!isset($_GET['id_user'])) {
                            die("Error: : 'id' parameter is missing in the URL.");
                        }
            
                        $id_User = htmlspecialchars($_GET['id_user']);

                        $req = $db -> prepare("DELETE FROM `Utilisateur` WHERE `id_user` = :id");

                        $req -> execute([
                            ":id" => $id_User
                        ]);

                        $Result = $req ;
                        if($Result) {
                            header("location:index.php");
                        } else {
                            echo " Data entred not successfully 2 ";
                        }



        ?>
