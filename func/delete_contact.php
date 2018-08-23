<?php
header("Content-Type: text/html; charset=utf-8");


require_once '../database.php';
if ($_GET['id'] != null) {
	deletePeople($_GET['id']);
}
header("Location: /index.php");

?>
