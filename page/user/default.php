<?php
include_once "database/config.php";
include_once "database/class/user.php";



$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'tambah':
        include 'tambah.php';
        break;
    case 'edit':
        include 'edit.php';
        break;
    case 'hapus':
        include 'hapus.php';
        break;
    case 'confirm-password':
        include 'confirmPassword.php';
        break;
    case 'change-password':
        include 'changePassword.php';
        break;
    default:
        include 'index.php';
        break;
}
