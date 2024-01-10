<?php
include('../config/init.php');
include('src/ClassFood.php');
$food = new Food();


//Form Gestion 

//Vérification du submit
if (isset($_POST['submit'])) {
    //boutton cliqué
    //echo "bouton cliqué";

    //Récupperé les donnés du form 

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $category = $_POST['category'];
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        //set default value
        $featured = "no";
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        //set default value
        $active = "no";
    }

    if (isset($_FILES['image']['name'])) {
        //upload the image
        $allowed = [
            "jpg" => "image/jpeg",
            "jpeg" => "image/jpeg",
            "png" => "image/png",
        ];

        $image_name = $_FILES['image']['name'];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];

        $extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        //on verifie l'absence de l'extension dans les clés de $allowed ou du type mime
        if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
            // extension ou type incorect
            die("Erreur : format du fichier incorecte");
        }
        //le tpe est correct


        //unique nameming
        $newname = md5(uniqid());
        $newfilename = "$newname.$extension";
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/" . $newfilename;

        $upload = move_uploaded_file($source_path, $destination_path);
        //cheak if the image is upload
        if ($upload == false) {
            $_SESSION['upload'] = "<div> Failed to Upload the image; </div>";
            header("location:" . SITEURL . 'admin/add-food.php');
            //Stop the procces
            die();
        }

        //we stop files execution
        chmod($newfilename, 0644);
    } else {
        // don't upload the image + set the image_name value as blank
        $image_name = "";
    }


  $process = $food->addFood($title, $description, $price, $newfilename, $category, $featured, $active);

    if ($process == true) {
        //succes
        header("location:" . SITEURL . 'admin/manage-food.php');
    } else {
        //failed

        header("location:" . SITEURL . 'admin/add-food.php');
    }
}

