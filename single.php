<?php

require('config.php');
require('database.php');
$link = db_connect();
require('models/movies.php');

// Удаление фильма
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
include('views/movie-single.tpl');
include('views/footer.tpl');

?>
