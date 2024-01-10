<?php
require('../config/init.php');

class Category {

    public function addCategory($title, $image_name, $featured, $active) {

        global $db;
        $message = '';

        $requete = $db->prepare("
        INSERT INTO tbl_category SET
        title = :title,
        image_name = :image_name,
        featured = :featured,
        active = :active
        ");
    
        try {
                $requete->execute([
                ':title' => $title,
                ':image_name' => $image_name,
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
    public function getCategories() {

        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_category");

        try {

            $requete->execute();
            return $requete->fetchAll(); 

        } catch (Exception $e) {
            // Log l'erreur au lieu de l'afficher
            error_log('Erreur dans getAdmins : ' . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    public function getCategory($id){
        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_category WHERE id = :id");

        try {
            $requete->bindValue(":id", $id);
            $requete->execute();
            return $requete->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            //code erreur

            return false;
        }
    }

        /**
     * Modifie un admin
     * 
     * @param mixed 
     */
    public function updateCategory($title, $image_name, $featured, $active, $id) {

        global $db;

        $requete = $db->prepare("
        UPDATE tbl_category SET
        title = :title,
        image_name = :image_name,
        featured = :featured,
        active = :active
        WHERE
        id = :id
        ");
    
        try {
                $requete->execute([
                ':title' => $title,
                ':image_name' => $image_name,
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


    public function deleteCategory($id) {

        global $db;

        $requete = $db->prepare("
            DELETE FROM tbl_category
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




}
