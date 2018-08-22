<?php
header("Content-Type: text/html; charset=utf-8");

if ($_GET['id'] != 0) {
    require_once '../database.php';
    $id = $_GET['id'];
    deletePeople($id);
    header("Location: /index.php");
}
require_once '../database.php';
    insertPeople($_POST['name'], $_POST['phone'], $_POST['adress']);
    header("Location: /index.php");  
?>
