<?php 
include_once('partials/header.php'); 
include('src/ClassFood.php');
$new = new Food();
$actives = $new->getActivesFood();

if (isset($_GET['id'])) {
    //recuperer l'id de la category
    $id = $_GET["id"];

    $food = $new->getFood($id);
    $current_category = $food->category_id;
} else {
        header("location:" . SITEURL . 'admin/manage-food.php');
        }
        if(!$food){
            header('location:' . SITEURL . '/admin/manage-food.php');
        }
        ?>


           
                
           
   
        
<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>



        <form action="update-food-process.php" method="POST" enctype="multipart/form-data">
            <table class="tbl30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?= $food->title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?= $food->description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?= $food->price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td><img src="<?= SITEURL; ?>images/food/<?= $food->image_name; ?>" alt="<?= $food->title; ?>" class="img-w-100"></td>
                </tr>
                <tr>
                    <td>New image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            if ($actives > 0) {
                            ?>
                                <?php foreach ($actives as $active) : ?>
                                    <option <?php if($current_category==$active['id']){echo 'selected';} ?> value="<?= $active['id'] ?>"><?= $active['title'] ?></option>
                                <?php endforeach; ?>
                            <?php
                            } else {
                                // no categories
                            ?>
                                <option value="0">No category found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($food->featured == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="yes"> Yes
                        <input <?php if ($food->featured == "no") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($food->active == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if ($food->active == "no") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?= $food->image_name; ?>" >
                        <input type="hidden" name="id" value="<?= $id; ?>" >
                        <input type="submit" name="submit" value="Update food" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>

        
    </div>
</div>

<?php include_once('partials/footer.php'); ?>