<?php include_once('partials/header.php'); 
include('src/ClassOrder.php');
$new = new Order();

if (isset($_GET['id'])) {
    //recuperer l'id de la category
    $id = $_GET["id"];

    $order = $new->getOrder($id);
} else {
        header("location:" . SITEURL . 'admin/manage-order.php');
        }
        if(!$order){
            header('location:' . SITEURL . '/admin/manage-order.php');
        }
        ?>

<div class="main-content">
    <div class="wraper">
        <h1>Update Order</h1>
 


        <form action="update-order-process.php" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?= $order->food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b><?= $order->price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty.</td>
                    <td>
                        <input type="number" name="qty" value="<?= $order->qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($order->status == "Ordered") {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($order->status == "On Delivery") {
                                        echo "selected";
                                    } ?> value="On Delivery">On Delivery</option>
                            <option <?php if ($order->status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered">Delivered</option>
                            <option <?php if ($order->status == "Cancelled") {
                                        echo "selected";
                                    } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?= $order->customer_name; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?= $order->customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?= $order->customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <input type="text" name="customer_address" value="<?= $order->customer_address; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?= $order->id; ?>">
                        <input type="hidden" name="price" value="<?= $order->price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>




    </div>
</div>

<?php include('partials/footer.php') ?>