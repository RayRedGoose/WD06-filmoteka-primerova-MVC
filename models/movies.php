<?php

function movies_all($link){
	$query = "SELECT * FROM movies";
	$films = array();
	$result = mysqli_query($link, $query);

	if ( $result = mysqli_query($link, $query) ) {
		while ( $row = mysqli_fetch_array($result)  ) {
			$movies[] = $row;
		}
	}

	return $movies;

}

function movie_new($link, $title, $genre, $year, $description){

		// Запись данных в БД
		$query = "INSERT INTO movies (title, genre, year, description)
							VALUES (
									'". mysqli_real_escape_string($link, $title) ."',
									'". mysqli_real_escape_string($link, $genre) ."',
									'". mysqli_real_escape_string($link, $year) ."',
									'". mysqli_real_escape_string($link, $description) ."'
							)";

		if ( mysqli_query($link, $query) ) {
			$result = true;
		} else {
			$result = false;
		}

		return $result;
}

function get_movie($link, $id){
	$query = "SELECT * FROM movies
						WHERE id = ' " . mysqli_real_escape_string($link, $id ) . "'
						LIMIT 1";

	$result = mysqli_query($link, $query);

	if ( $result = mysqli_query($link, $query) ) {
		$movie = mysqli_fetch_array($result);
	}

	return $movie;

}

function movie_update($link, $title, $genre, $year, $description, $photo, $id){
	$query = "	UPDATE movies
							SET title = '". mysqli_real_escape_string($link, $title) ."',
									genre = '". mysqli_real_escape_string($link, $genre) ."',
									year = '". mysqli_real_escape_string($link, $year) ."',
									description = '". mysqli_real_escape_string($link, $description) ."'
							WHERE id = ".mysqli_real_escape_string($link, $id)." LIMIT 1";

	if ( mysqli_query($link, $query) ) {
		$result = true;
	} else {
			$result = false;
	}

	return $result;

}

function movie_delete($link, $id) {
	$query = "DELETE FROM movies
						WHERE id = ' " . mysqli_real_escape_string($link, $id ) . "'
						LIMIT 1";

	mysqli_query($link, $query);

	if ( mysqli_affected_rows($link) > 0 ) {
		$result = true;
	} else {
		$result = false;
	}

	return $result;

}


?>
