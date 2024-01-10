<?php include_once('partials/header.php'); 
include('src/ClassCategory.php');
$new = new Category();

if (isset($_GET['id'])) {
    //recuperer l'id de la category
    $id = $_GET["id"];

    $category = $new->getCategory($id);
} else {
    header('location:' . SITEURL . '/admin/manage-category.php');
}
if(!$category){
    header('location:' . SITEURL . '/admin/manage-category.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>



        <form action="update-category-process.php"   method="POST" enctype="multipart/form-data">
            <table class="tbl30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?= $category->title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td><img src="<?= SITEURL; ?>images/category/<?= $category->image_name; ?> " alt="<?= $category->title; ?>" class="img-w-100"></td>
                </tr>
                <tr>
                    <td>New image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($category->featured == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="yes"> Yes
                        <input <?php if ($category->featured == "no") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($category->active == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if ($category->active == "no") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?= $category->image_name; ?>" >
                        <input type="hidden" name="id" value="<?= $id; ?>" >
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>

    </div>
</div>

<?php include_once('partials/footer.php'); ?>