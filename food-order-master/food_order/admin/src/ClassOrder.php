<?php
require('../config/init.php');

class Order {

    public function updateOrder($qty, $total,  $status, $customer_name, $customer_contact, $customer_email, $customer_address, $id) {

        global $db;

        $requete = $db->prepare("
        UPDATE tbl_order SET        
        qty = :qty,  
        total = :total,         
        status = :status, 
        customer_name = :customer_name, 
        customer_contact = :customer_contact, 
        customer_email = :customer_email,   
        customer_address = :customer_address 
        WHERE 
        id = :id
        ");
    
        try {
                $requete->execute([
                    
                    ':qty'=> $qty,
                    ':total'=> $total,
                    ':status'=> $status,
                    ':customer_name' => $customer_name,
                    ':customer_contact' => $customer_contact,
                    ':customer_email'=> $customer_email,
                    ':customer_address'=> $customer_address,
                    ':id'        => $id
            ]);
        return true;

        } catch (Exception $e) {
            echo 'Erreur : ',  $e->getMessage(), "\n";

            return false;
        }
    }


    public function getOrder($id){
        global $db;

        $requete = $db->prepare("SELECT * FROM tbl_order WHERE id = :id");

        try {
            $requete->bindValue(":id", $id);
            $requete->execute();
            return $requete->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            //code erreur

            return false;
        }
    }


}