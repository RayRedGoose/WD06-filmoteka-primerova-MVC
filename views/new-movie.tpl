<div class="panel-holder mt-80 mb-100">
	<div class="card__header">
		<h1 class="title-1">Добавить новый фильм</h1>
		<a href="index.php" class="button">К списку</a>
	</div>

		<form action="new.php" method="POST">

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
								placeholder="Такси 2"
								name="title"/>
				<div class="row">
					<div class="col">
						<label class="label-title">Жанр</label>
						<input 	class="input"
										type="text"
										placeholder="комедия"
										name="genre"/>
					</div>
					<div class="col">
						<label class="label-title">Год</label>
						<input 	class="input"
										type="text"
										placeholder="2000"
										name="year"/>
					</div>
				</div>
				<textarea name="description" class="textarea mb-20" placeholder="Введите описание фильма"  style="height: 100px;"></textarea>
				<input 	type="submit"
								class="button"
								value="Добавить"
								name="add-movie">
		</form>

	</div>
