<?php
require('../config/init.php');

class Food {

    public function addFood($title, $description, $price, $image_name, $category_id, $featured, $active) {

        global $db;
        $message = '';

        $requete = $db->prepare("
        INSERT INTO tbl_food SET
        title = :title,
        description = :description,
        price = :price,
        image_name = :image_name,
        category_id = :category_id,
        featured = :featured,
        active = :active
        ");
    
        try {
                $requete->execute([
                ':title' => $title,
                ':description' => $description,
                ':price' => $price,
                ':image_name' => $image_name,
                ':category_id' => $category_id,
                ':featured' => $featured,
                ':active' => $active
            ]);
        return true;

        } catch (Exception $e) {
            echo 'Erreur : ',  $e->getMessage(), "\n";

            return false;
        } 
        
    }

     /**
     * Retourne les admins
     * @return array
     */
    public function getFoods() {

        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_food");

        try {

            $requete->execute();
            return $requete->fetchAll(); 

        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getAdmins : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    public function getFood($id){
        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_food WHERE id = :id");

        try {
            $requete->bindValue(":id", $id);
            $requete->execute();
            return $requete->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            //code erreur

            return false;
        }
    }


    public function updateFood($title, $description, $price, $image_name, $category_id, $featured, $active, $id) {

        global $db;

        $requete = $db->prepare("
        UPDATE tbl_food SET
        title = :title,
        description = :description,
        price = :price,
        image_name = :image_name,
        category_id = :category_id,
        featured = :featured,
        active = :active
        WHERE
        id = :id
        ");
    
        try {
                $requete->execute([
                ':title' => $title,
                ':description' => $description,
                ':price' => $price,
                ':image_name' => $image_name,
                ':category_id' => $category_id,
                ':featured' => $featured,
                ':active' => $active,
                ':id'        => $id
            ]);
        return true;

        } catch (Exception $e) {
            echo 'Erreur : ',  $e->getMessage(), "\n";

            return false;
        }
    }





    public function deleteFood($id) {

        global $db;

        $requete = $db->prepare("
            DELETE FROM tbl_food
            WHERE
            id       = :id
        ");

        try {
            $requete->execute([
                ':id'       => $id
        ]);

            return true;

        } catch (Exception $e) {
            echo 'Erreur : ',  $e->getMessage(), "\n";

            return false;
        }  
    }
    public function getActivesFood() {
        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_category WHERE active='yes'");

        try {
            
            $requete->execute();
            return $requete->fetchAll();
        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getFoodsActive : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }




}
