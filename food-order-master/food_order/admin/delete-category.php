<?php
include('../config/init.php');
include('src/ClassCategory.php');

$category = new Category();

if (isset($_GET['id']) && $_GET['image_name']) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the image file physicaly
    $path = "../images/category/" . $image_name;
    $remove = unlink($path);



    $process = $category->deleteCategory($id);
}
header("location:" . SITEURL . 'admin/manage-category.php');
