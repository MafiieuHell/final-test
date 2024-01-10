<?php
include('../config/init.php');
include('src/ClassFood.php');

$food = new Food();

if (isset($_GET['id']) && $_GET['image_name']) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the image file physicaly
    $path = "../images/food/" . $image_name;
    $remove = unlink($path);



    $process = $food->deleteFood($id);
    header("location:" . SITEURL . 'admin/manage-food.php');
}
header("location:" . SITEURL . 'admin/manage-food.php');
