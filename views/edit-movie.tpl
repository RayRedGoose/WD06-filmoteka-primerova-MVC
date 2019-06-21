<div class="panel-holder mt-80 mb-100">
	<div class="card__header">
		<h1 class="title-1">Редактировать фильм "<?=$movie['title']?>"</h1>
		<div class="buttons">
			<a href="?action=delete&id=<?=$movie['id']?>" class="button mr-20">Удалить</a>
			<a href="index.php" class="button">К списку</a>
		</div>
	</div>
	<form enctype="multipart/form-data" action="edit.php?id=<?=$movie['id']?>" method="POST">
		<?php
			if ( !empty($errors)) {
				foreach ($errors as $key => $value) {
					echo "<div class='error'>$value</div>";
				}
			}
		?>

		<label class="label-title">Название фильма</label>
		<input 	class="input"
						type="text"
						placeholder="<?=$movie['title']?>"
						name="title"
						value="<?=$movie['title']?>"/>
		<div class="row">
			<div class="col">
				<label class="label-title">Жанр</label>
				<input 	class="input"
								type="text"
								placeholder="<?=$movie['genre']?>"
								name="genre"
								value="<?=$movie['genre']?>"/>
			</div>
			<div class="col">
				<label class="label-title">Год</label>
				<input 	class="input"
								type="text"
								placeholder="<?=$movie['year']?>"
								name="year"
								value="<?=$movie['year']?>"/>
			</div>
		</div>
		<textarea name="description"
							class="textarea mb-20"
							placeholder="<?=$movie['description']?>"
							style="height: 100px;"><?=$movie['description']?></textarea>
		<div class="mb-20">
			<input type="file" name="photo" />
		</div>

		<input 	type="submit"
						class="button mr-20"
						value="Обновить"
						name="update-movie">
		<a href="single.php?id=<?=$movie['id']?>" class="button">Страница фильма</a>
	</form>

</div>
