<?php
include('../config/init.php');
include('src/ClassOrder.php');
$order = new Order();
        //check submit btn
        if (isset($_POST['submit'])) {
            //echo "clique";
            //get data from form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;

            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            $process = $order->updateOrder($qty, $total,  $status, $customer_name, $customer_contact, $customer_email, $customer_address, $id);
          
            if ($process == true) {
                //succes
                header("location:" . SITEURL . 'admin/manage-order.php');
            } else {
                //failed

                header("location:" . SITEURL . 'admin/update-order.php');
            }
        }



        ?>