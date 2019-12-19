<?php

define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'WD06-filmoteka-primerova');

define('HOST', 'http://'. $_SERVER['HTTP_HOST'] . '/');
define('ROOT', dirname(__FILE__) . '/');
define('IMG_PATH', HOST. "/data/movies");
define('IMG_MIN_PATH', HOST. "/data/movies/min");
define('IMG_COVER_PATH', HOST . "/data/movies/cover");


?>
