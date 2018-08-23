<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(0);
require_once '../database.php';
$_POST['phone'] = (int)($_POST['phone']);

if ($_POST['phone'] == 0 && $_POST['name'] != null && $_POST['adress'] != null) {
	echo "Введите правильный номер телефона<br><br>";
} elseif ($_POST['name'] != null && $_POST['adress'] != null && $_POST['phone']) {
    
    updatePeople($_POST['id'], $_POST['name'], $_POST['phone'], $_POST['adress']);
    header("Location: /index.php");
}

if ($_GET['id'] != null) {
	$_GET['id'] = (int)($_GET['id']);
        if($_GET['id'] != 0){
            $res = selectPeopleById($_GET['id']);
	?>
<form method="post" action="edit_contact.php">
    <input name="id" value="<?= $_GET['id'] ?>" hidden>
    <label>Введите имя:</label><br>
    <input type="text" name="name" value="<?=$res[0][1]?>" required><br>
    <label>Введите номер телефона:</label><br>
    <input type="text" name="phone" value="<?=$res[0][2]?>" <?php if ($_POST['phone'] == 0 && $_POST['name'] != null && $_POST['adress'] != null) { ?> autofocus <?php } ?> minlength="6" maxlength="10" required><br>
    <label>Введите адрес:</label><br>
    <input type="text" name="adress" value="<?=$res[0][3]?>" required><br><br>
    <input type="submit" value="Изменить">
</form>
	<?php } else {
		header("Location: /index.php");
	}
} else {
    header("Location: /index.php");
}
?>

