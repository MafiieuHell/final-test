<?php
include('../config/init.php');
include('src/ClassFood.php');
$food = new Food();

        if (isset($_POST['submit'])) {
            //boutton cliqué
            //echo "bouton cliqué";

            //Récupperé les donnés du form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //upload new image if selected
            if (isset($_FILES['image']['name'])) {
                //get the details

                $image_name = $_FILES['image']['name'];

                //Check if the images is available or not
                if ($image_name != "") {
                    //image is availible
                    //upload the new image

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
                        header("location:" . SITEURL . 'admin/manage-food.php');
                        //Stop the procces
                        die();
                    }

                    //we stop files execution
                    chmod($newfilename, 0644);
                    $image_name = $newfilename;
                    //remove the current image if availible
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $removed = unlink($remove_path);
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $process = $food->updateFood($title, $description, $price, $image_name, $category, $featured, $active, $id);


            if ($process == true) {
                //succes
                header("location:" . SITEURL . 'admin/manage-food.php');
            } else {
                //failed

                header("location:" . SITEURL . 'admin/update-food.php');
            }
        }
        ?>