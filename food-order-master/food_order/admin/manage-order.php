<?php include_once('partials/header.php');
include('src/ClassOrder.php');
$order  = new Order();

// Récuperation des données des admin
$orders = $order->getOrders();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br /><br />


        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>

            </tr>

                <?php
                 $sn = 1;
                foreach ($orders as $order) : ?>
                    <tr>
                        <td><?= $sn++; ?></td>
                        <td><?= $order['food']; ?></td>
                        <td><?= $order['price']; ?></td>
                        <td><?= $order['qty']; ?></td>
                        <td><?= $order['total']; ?></td>
                        <td><?= $order['order_date']; ?></td>

                        <td>
                            <?php
                            $status = $order['status'];
                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "On Delivery") {
                                echo "<label style='color: orange;'>$status</label>";
                            } elseif ($status == "Delivered") {
                                echo "<label style='color: green;'>$status</label>";
                            } elseif ($status == "Cancelled") {
                                echo "<label style='color: red;'>$status</label>";
                            }


                            ?>
                        </td>


                        <td><?= $order['customer_name']; ?></td>
                        <td><?= $order['customer_contact']; ?></td>
                        <td><?= $order['customer_email']; ?></td>
                        <td><?= $order['customer_address']; ?></td>
                        <td>
                            <a href="<?= SITEURL; ?>admin/update-order.php?id=<?= $order['id']; ?>" class="btn-secondary">Update Order</a>

                        </td>

                    </tr>
                <?php endforeach; ?>



        </table>
    </div>
</div>

<?php include_once('partials/footer.php') ?>