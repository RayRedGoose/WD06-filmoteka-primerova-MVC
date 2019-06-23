<?php

require_once 'resize.php';
function photoCreate()  {
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
}
?>
