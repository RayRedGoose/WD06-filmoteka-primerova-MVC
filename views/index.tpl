<div class="card__header">
<h1 class="title-1">Фильмотека (Раиса Примерова)</h1>
<a href="new.php" class="button">Добавить фильм</a>
</div>
<?php foreach ($movies as $key => $movie) { ?>
	<div class="card mb-20">
		<div class="row">
			<div class="col-auto">
				<img src="<?=IMG_MIN_PATH?>/<?=$movie['photo']?>" alt="<?=movie['title']?>">
			</div>
			<div class="col">
				<div class="card__header">
					<h4 class="title-4"><?=$movie['title']?></h4>
					<div class="buttons">
						<a href="single.php?id=<?=$movie['id']?>" class="button button--more">Подробнее</a>
						<a href="edit.php?id=<?=$movie['id']?>" class="button button--edit">Редактировать</a>
						<a href="?action=delete&id=<?=$movie['id']?>" class="button button--delete">Удалить</a>
					</div>
				</div>
				<div class="badge"><?=$movie['genre']?></div>
				<div class="badge"><?=$movie['year']?></div>
			</div>
		</div>

	</div>
<?php } ?>
