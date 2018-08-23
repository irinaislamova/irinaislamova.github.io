<?php
function db_connect() {
	$link = mysqli_connect("localhost", "root", "", "phonebook");
	if (!$link) {
		echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
		echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	if (!mysqli_set_charset($link, "utf8")) {
		printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($link));
		exit;
	}
	return $link;
}
function db_close($link) {
	mysqli_close($link);
}
function cleanString($db, $name) {
	$name = trim($name);
	$name = htmlspecialchars($name, ENT_NOQUOTES, "UTF-8");
	$name = mysqli_real_escape_string($db, $name);
	return $name;
}
function insertPeople($name, $phone, $adress) {
	$db = db_connect();
	$name = cleanString($db, $name);
	$adress = cleanString($db, $adress);
	$phone = (int)($phone);
	mysqli_query($db, "INSERT INTO `phone` (`name`, `phone`, `adress`) VALUES ('{$name}', '{$phone}', '{$adress}');");
	db_close($db);
}
function updatePeople($id, $name, $phone, $adress) {
	$db = db_connect();
	$name = cleanString($db, $name);
	$adress = cleanString($db, $adress);
	$id = (int)($id);
	$phone = (int)($phone);
	mysqli_query($db, "UPDATE `phone` SET `name`='{$name}', `phone`='{$phone}', `adress`='{$adress}' WHERE `id`='{$id}'");
	db_close($db);
}
function deletePeople($id) {
	$db = db_connect();
	$id = (int)($id);
	mysqli_query($db, "DELETE FROM `phone` WHERE `id`='{$id}'");
	db_close($db);
}
function selectPeople() {
	$db = db_connect();
	$result = mysqli_query($db, "SELECT `id`, `name`, `phone`, `adress` FROM `phone` ORDER BY `name` ASC, `adress` ASC");
	while ($row = mysqli_fetch_row($result)) {
		$response[] = $row;
	}
	db_close($db);
	return $response;
}
function selectPeopleById($id) {
	$id = (int)($id);
	$db = db_connect();
	$result = mysqli_query($db, "SELECT `id`, `name`, `phone`, `adress` FROM `phone` WHERE `id`='{$id}' ORDER BY `name` ASC, `adress` ASC");
	while ($row = mysqli_fetch_row($result)) {
		$response[] = $row;
	}
	db_close($db);
	return $response;
}
function selectPeopleByName($name) {
	$db = db_connect();
	$name = cleanString($db, $name);
	$result = mysqli_query($db, "SELECT `id`, `name`, `phone`, `adress` FROM `phone` WHERE `name` LIKE '%{$name}%' ORDER BY `name` ASC, `adress` ASC");
	while ($row = mysqli_fetch_row($result)) {
		$response[] = $row;
	}
	db_close($db);
	return $response;
}
function selectPeopleByPhone($phone) {
	$phone = (int)($phone);
	$db = db_connect();
	$result = mysqli_query($db, "SELECT `id`, `name`, `phone`, `adress` FROM `phone` WHERE `phone` LIKE '%{$phone}%' ORDER BY `name` ASC, `adress` ASC");
	while ($row = mysqli_fetch_row($result)) {
		$response[] = $row;
	}
	db_close($db);
	return $response;
}
function selectPeopleByAdress($adress) {
	$db = db_connect();
	$adress = cleanString($db, $adress);
	$result = mysqli_query($db, "SELECT `id`, `name`, `phone`, `adress` FROM `phone` WHERE `adress` LIKE '%{$adress}%' ORDER BY `name` ASC, `adress` ASC");
	while ($row = mysqli_fetch_row($result)) {
		$response[] = $row;
	}
	db_close($db);
	return $response;
}

