<?php

// require 'photo.php';
require_once 'resize.php';

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

function movie_new($link, $title, $genre, $year, $description, $photo) {
	if (isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] !="")   {
		$fileName = $_FILES['photo']['name'];
		$fileTmpLoc = $_FILES['photo']['tmp_name'];
		$fileType = $_FILES['photo']['type'];
		$fileSize = $_FILES['photo']['size'];
		$fileErrorMsg = $_FILES['photo']['error'];
		$kaboom = explode('.', $fileName);
		$fileExt = end($kaboom);

		list($width, $height) = getimagesize($fileTmpLoc);

		if ($width < 10 || $height < 10) {
			$errors[] = 'Неправильный размер изображения';
		}

		$db_file_name = rand(100000000000, 999999999999) . '.' . $fileExt;

		if ($fileSize > 10485760) {
			$errors[] = "Изображение не может быть более 10мб";
		} else if (!preg_match("/\.(gif|jpg|jpeg|png)$/i", $fileName)) {
			$errors[] = "Расширение изображения может быть только gif, jpg, jpeg или png";
			} else if ($fileErrorMsg == 1) {
				$errors[] = "Неизыестная ошибка";
			}

		$photoFolderLocation = ROOT . "data/movies/";
		$photoFolderLocationMin = ROOT . "data/movies/min/";
		$photoFolderLocationCover = ROOT . "data/movies/cover/";
		$uploadFile = $photoFolderLocation . $db_file_name;

		move_uploaded_file($fileTmpLoc, $uploadFile);

		$moveResult = move_uploaded_file($fileTmpLoc, $uploadFile);

		if ($moveResult !=true) {
			$errors[] = 'Изображение не загружено';
		}

		$resizedFileMin = $photoFolderLocationMin . $db_file_name;
		$resizedFileCover = $photoFolderLocationCover . $db_file_name;

		$miniPhoto = make_thumb($uploadFile, $resizedFileMin, '140', '200');
		$coverPhoto = make_thumb($uploadFile, $resizedFileCover, '400', '600');

		$photo = $db_file_name;

	}

		// Запись данных в БД
		$query = "INSERT INTO movies (title, genre, year, description, photo)
							VALUES (
									'". mysqli_real_escape_string($link, $title) ."',
									'". mysqli_real_escape_string($link, $genre) ."',
									'". mysqli_real_escape_string($link, $year) ."',
									'". mysqli_real_escape_string($link, $description) ."'
									'". mysqli_real_escape_string($link, $photo) ."'
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

function movie_update($link, $title, $genre, $year, $description, $photo, $id) {

	if (isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] !="")   {
    $fileName = $_FILES['photo']['name'];
    $fileTmpLoc = $_FILES['photo']['tmp_name'];
    $fileType = $_FILES['photo']['type'];
    $fileSize = $_FILES['photo']['size'];
    $fileErrorMsg = $_FILES['photo']['error'];
    $kaboom = explode('.', $fileName);
    $fileExt = end($kaboom);

    list($width, $height) = getimagesize($fileTmpLoc);

    if ($width < 10 || $height < 10) {
      $errors[] = 'Неправильный размер изображения';
    }

    $db_file_name = rand(100000000000, 999999999999) . '.' . $fileExt;

    if ($fileSize > 10485760) {
      $errors[] = "Изображение не может быть более 10мб";
    } else if (!preg_match("/\.(gif|jpg|jpeg|png)$/i", $fileName)) {
      $errors[] = "Расширение изображения может быть только gif, jpg, jpeg или png";
      } else if ($fileErrorMsg == 1) {
        $errors[] = "Неизыестная ошибка";
      }

    $photoFolderLocation = ROOT . "data/movies/";
    $photoFolderLocationMin = ROOT . "data/movies/min/";
    $photoFolderLocationCover = ROOT . "data/movies/cover/";
    $uploadFile = $photoFolderLocation . $db_file_name;

    move_uploaded_file($fileTmpLoc, $uploadFile);

    $moveResult = move_uploaded_file($fileTmpLoc, $uploadFile);

    if ($moveResult !=true) {
      $errors[] = 'Изображение не загружено';
    }

    $resizedFileMin = $photoFolderLocationMin . $db_file_name;
    $resizedFileCover = $photoFolderLocationCover . $db_file_name;

    $miniPhoto = make_thumb($uploadFile, $resizedFileMin, '140', '200');
    $coverPhoto = make_thumb($uploadFile, $resizedFileCover, '400', '600');

    $photo = $db_file_name;
    return $photo;
  }

	$query = "	UPDATE movies
							SET title = '". mysqli_real_escape_string($link, $title) ."',
									genre = '". mysqli_real_escape_string($link, $genre) ."',
									year = '". mysqli_real_escape_string($link, $year) ."',
									description = '". mysqli_real_escape_string($link, $description) ."',
									photo = '". mysqli_real_escape_string($link, $photo) ."'
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
