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
        <title> Article </title>
    </head>
    <body>
        <form action="" method="Post" enctype="multipart/form-data">
            <label for=""> Article Image </label>
            <input type="file" name="Article_Image" id="">
            <br><br>
            <label for=""> Article label </label>
            <input type="text" name="Article_label" id="">
            <br><br>
            <label for=""> Article price </label>
            <input type="text" name="Article_price" id="">
            <br><br>
            <label for=""> Article type </label>
            <select name="Article_Type" id="">
                <option value="type1"> type1 </option>
                <option value="type2"> type2 </option>
                <option value="type3"> type3 </option>
            </select>
            <br><br>
            <input type="submit" name="Submit">
        </form>



        <?php

if(isset($_POST["Submit"])) {
    if( isset($_POST["Article_label"]) && isset($_POST["Article_price"])  ) { 
        if( $_FILES["Article_Image"]['error'] === 0 ){
            if( !empty($_POST["Article_label"]) && !empty($_POST["Article_price"])  ) {

                

                $Article_label = $_POST["Article_label"] ; 
                $Article_price = $_POST["Article_price"] ; 
                $Article_Type = $_POST["Article_Type"] ;
                $ArticleImage = $_FILES['Article_Image']['tmp_name'];
                $ArticleImage_Content = file_get_contents($ArticleImage);

                // echo  $ArticleImage_Content ;

                $req = $db->prepare("INSERT INTO Article (lable_article, prix,  Article_img) 
                VALUES (:label, :prix, :Article_img)");

                $result = $req->execute([
                ":label" => $Article_label,
                ":prix" => $Article_price,
                ":Article_img" => $ArticleImage_Content
                ]);

                if($result) {
                echo "Data inserted successfully!";
                } else {
                echo "Failed to insert data.";
                print_r($req->errorInfo()); // Debugging information
                } 





            } else {
                echo "empty";
            }
        } else {
            echo "file error 1";
        }
    } else {
        echo "No isset ";
    }
} else {
    echo "No submit ";
}



        ?>
    </body>
</html>