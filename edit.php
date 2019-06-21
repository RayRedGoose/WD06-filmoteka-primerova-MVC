<?php

require('config.php');
require('database.php');
$link = db_connect();

require('models/movies.php');

// UPDATE film data in DB
if ( array_key_exists('update-movie', $_POST) ) {

	// Обработка ошибок
	if ( $_POST['title'] == '') {
		$errors[] = "<p>Необходимо ввести название фильма!</p>";
	}
	if ( $_POST['genre'] == '') {
		$errors[] = "<p>Необходимо ввести жанр фильма!</p>";
	}
	if ( $_POST['year'] == '') {
		$errors[] = "<p>Необходимо ввести год фильма!</p>";
	}

	if ( empty($errors) ) {

		$result = movie_update(	$link,
														$_POST['title'],
														$_POST['genre'],
														$_POST['year'],
														$_POST['description'],
														$_GET['id']);

		if ( $result ) {
			$resultSuccess = "<p>Фильм был успешно обновлен!</p>";
		} else {
			$resultError = "<p>Что то пошло не так. Добавьте фильм еще раз!</p>";
		}
	}
}

if ( @$_GET['action'] == 'delete') {

	$reslut = movie_delete($link, $_GET['id']);

	if ( $reslut ) {
		$resultInfo = "<p>Фильм был удален!</p>";
	} else {
		$resultError = "<p>Что то пошло не так.</p>";
	}
}

$movie = get_movie($link, $_GET['id']);

include('views/head.tpl');
include('views/notifications.tpl');
include('views/edit-movie.tpl');
include('views/footer.tpl');

?>
