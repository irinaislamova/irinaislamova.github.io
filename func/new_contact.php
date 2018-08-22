<?php
header("Content-Type: text/html; charset=utf-8");
if ($_POST['phone'] == 0 && $_POST['name'] != null && $_POST['adress'] != null) {
	echo "Введите правильный номер телефона<br><br>";
} elseif ($_POST['name'] != null && $_POST['adress'] != null && $_POST['phone']) {
    require_once '../database.php';
    insertPeople($_POST['name'], $_POST['phone'], $_POST['adress']);
    header("Location: /index.php");   	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
            <form method="post" action="new_contact.php">
			<label>Введите имя:</label><br>
			<input type="text" name="name" value="<?=$_POST['name']?>" required><br>
			<label>Введите номер телефона:</label><br>
                        <input type="text" name="phone" value="" <?php if ($_POST['phone'] == 0 && $_POST['name'] != null && $_POST['adress'] != null) { ?> autofocus <?php } ?> minlength="6" maxlength="10" required><br>
			<label>Введите адрес:</label><br>
			<input type="text" name="adress" value="<?=$_POST['adress']?>" required><br>
			<input type="submit" value="Добавить">
		</form>
	</body>
</html>
