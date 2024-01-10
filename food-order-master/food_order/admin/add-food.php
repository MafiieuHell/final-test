<?php
include_once('partials/header.php');
include('src/ClassFood.php');

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <!-- form -->

        <form action="add-food-process.php"  method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category tilte">
                    </td>

                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="food description"></textarea>
                    </td>

                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" step=".01" name="price" placeholder="food price">
                    </td>

                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>

                
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            
                            //display active categories from db
                            $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                            $q = $db->prepare($sql);
                            $q->execute();

                            $count = $q->rowCount();
                            if ($count > 0) {
                                //We have categories
                                $actives = $q->fetchAll();
                            ?>
                                <?php foreach ($actives as $active) : ?>
                                    <option value="<?= $active['id'] ?>"><?= $active['title'] ?></option>
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
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>





<?php

include_once('partials/footer.php');
?>