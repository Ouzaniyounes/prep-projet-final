<?php 
    ini_set('display_errors', 1);
    include("connexionDatabase.php");
    include("switchFunc.php");
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  Admin Dashboard </title>
    <link rel="stylesheet" href="../css/admin-dashboard.css">
    
</head>
<body>

    <form action="" method="POST">
        <input type="search" name="Search-data" id="" placeholder="Search by Username " >
        <input type="submit" value="Search" name="submit-search">
    </form>


    

    

    <?php 

        // Search For certain dataUser Using Username

        if(isset($_POST["submit-search"])) {
            if(isset($_POST["Search-data"])) {
                if(!empty($_POST["Search-data"])) {

                    
                    $username_Entred = htmlspecialchars($_POST["Search-data"]);
                    
                    $search_req = $db -> prepare("SELECT * FROM Utilisateur WHERE Username LIKE :username  ");
                    $search_req -> execute([
                        ":username" => '%' . $username_Entred . '%'
                    ]);
                  
                  echo 
                  "
                        <div class='header_container'>
                            <h1> The search of <span id='nothing'   > ". $username_Entred ."</span> username </h1>
                        </div>
                  ";
                  echo  "  <table>
   
                            <tr>
                                <th> id_user </th>
                                <th> nom_user  </th>
                                <th> prenom_user </th>
                                <th> email_user </th>
                                <th> Username </th>
                                <th> ProfileImg_user </th>
                                <th> Password </th>
                                <th> Role </th>
                                <th> Etat </th>
                                <th> Action  </th>
                                <th> Action </th>
                            </tr>

                 
                     ";
                    while ($search_result = $search_req -> fetch()) {
                        echo " <tr> ";
                        echo " <td> ".$search_result["id_user"]."</td>";
                        echo " <td> ". $search_result["nom_user"] ."</td>";
                        echo " <td> ". $search_result["prenom_user"] ."</td>";
                        echo " <td> ". $search_result["email_user"] ."</td>";
                        echo " <td> ". $search_result["Username"] ."</td>";
                        echo " <td> ". $search_result["ProfileImg_user"] ."</td>";
                        echo " <td> ". $search_result["Password"]."</td>";
                        echo " <td> ". showRole($search_result["Role"])."</td>";
                        echo " <td> <a href='changeEtatUser.php?id_user=".$search_result["id_user"]."'> ".showEtat($search_result["Etat"])." </a> </td>";
                        echo " <td> <a href='ModifyUser.php?id_user=".$search_result["id_user"]."'> Modify </a> </td>";
                        echo " <td> <a href='DeleteUser.php?id_user=".$search_result["id_user"]."'> Delete </a> </td>";
                        echo " </tr>" ;
                        
                    }

                    echo "<br> <br>";
                    echo "</table>";
                    
                    echo "<h1> <span id='nothing'   >".$_SESSION["nom_user"]."  </span> your role is <span id='nothing'> ".$_SESSION["Role"]." </span> </h1>";

                } else {
                    echo " You need to fill the search field ";
                }
            }
        } else {
            echo "<h1>".$_SESSION["nom_user"]." your role is ".$_SESSION["Role"]."</h1>";
        }



        // Show Data User
        if(isset($_SESSION["nom_user"])) {

                    $req = $db->query("SELECT * FROM Utilisateur");  
                    if($_SESSION["Role"] == 1 )  {
                        echo

                        "  <table>
   
                               <tr>
                                       <th> id_user </th>
                                       <th> nom_user  </th>
                                       <th> prenom_user </th>
                                       <th> email_user </th>
                                       <th> Username </th>
                                       <th> ProfileImg_user </th>
                                       <th> Password </th>
                                       <th> Role </th>
                                       <th> Etat </th>
                                       <th> Action  </th>
                                       <th> Action </th>
                                       </tr>
   
                            
                       ";

                        while($result = $req->fetch()){
                            echo " <tr> ";
                            echo " <td> ".$result["id_user"]."</td>";
                            echo " <td> ". $result["nom_user"] ."</td>";
                            echo " <td> ". $result["prenom_user"] ."</td>";
                            echo " <td> ". $result["email_user"] ."</td>";
                            echo " <td> ". $result["Username"] ."</td>";
                            echo " <td> <img src='". $result["ProfileImg_user"] ." ' alt=''> </td>";
                            echo " <td> ". $result["Password"]."</td>";
                            echo " <td> ". showRole($result["Role"])."</td>";
                            echo " <td> <a href='changeEtatUser.php?id_user=".$result["id_user"]."'> ".showEtat($result["Etat"])." </a> </td>";
                            echo " <td> <a href='ModifyUser.php?id_user=".$result["id_user"]."'> Modify </a> </td>";
                            echo " <td> <a href='DeleteUser.php?id_user=".$result["id_user"]."'> Delete </a> </td>";
                            echo " </tr>" ;
                        }
                        echo " </table> ";


                    } else {
                        echo " you cant see anything ";
                    }
                    echo"<a href='deconectUser.php'> Deconnect </a>";
                    echo"<a href='deleteFile.php'> delete the img  </a>";




            } else {
                header("location:login.php");
            }



    
    
    
    
    ?>
</body>
</html>