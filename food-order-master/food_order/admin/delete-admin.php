<?php
include('../config/init.php');
include('src/ClassAdmin.php');

$admin = new Admin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $process = $admin->deleteAdmin($id);
    
}

header("location:" . SITEURL . 'admin/manage-admin.php');
