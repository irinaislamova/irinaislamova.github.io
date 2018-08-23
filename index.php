<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(0);
//error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
//ini_set('display_errors', 1);

require_once 'database.php';
if ($_POST['search'] == 'name') {
	$people = selectPeopleByName($_POST['name']);
} elseif ($_POST['search'] == 'phone') {
	$people = selectPeopleByPhone($_POST['phone']);
} elseif ($_POST['search'] == 'adress') {
	$people = selectPeopleByAdress($_POST['adress']);
} else {
	$people = selectPeople();
}

?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<title>Телефонный справочник</title>
	</head>
        <body>
            
<table>
			<tr>
				<form action="index.php" method="post">
					<input name="search" value="name" hidden>
					<td><label>Поиск по имени: </label></td>
					<td><input type="text" name="name"></td>
					<td><input type="submit" value="Поиск"></td>
				</form>
			</tr>
			<tr>
				<form action="index.php" method="post">
					<input name="search" value="adress" hidden>
					<td><label>Поиск по адресу: </label></td>
					<td><input type="text" name="adress"></td>
					<td><input type="submit" value="Поиск"></td>
				</form>
			</tr>
			<tr>
				<form action="index.php" method="post">
					<input name="search" value="phone" hidden>
					<td><label>Поиск по телефону: </label></td>
					<td><input type="text" name="phone"></td>
					<td><input type="submit" value="Поиск"></td>
				</form>
			</tr>
</table><br>
               

<?php if ($people != null) { ?>
<table border="2px">
<tr>
<td>Имя</td><td>Телефон</td><td>Адрес</td>
</tr>
<?php
for ($i = 0; $i < sizeof($people); $i++) { ?>
    <tr><td width="100px"><?=$people[$i][1]?>
    </td><td width="100px"><?=$people[$i][2]?>
    </td><td width="100px"><?=$people[$i][3]?>
    </td><td width="100px"><a href="/func/edit_contact.php?id=<?=$people[$i][0]?> ">Изменить запись</a>
    </td><td width="100px"><a href="/func/delete_contact.php?id=<?=$people[$i][0]?>">Удалить запись</a>
    </td></tr>  
<?php } ?>
			</table>
            <a href="/func/new_contact.php">Добавить новый контакт</a>
		<?php } else { echo "<br>Таблица пустая"; }?>
	</body>
</html>
