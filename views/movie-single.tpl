<div class="card__header">
	<h1 class="title-1">Информация о фильме <?=$movie['title']?></h1>
	<a href="index.php" class="button">К списку</a>
</div>


<div class="card mb-20">

	<div class="row">
		<div class="col">
			<img src="<?=HOST?>/data/movies/14349.jpg" alt="">
		</div>

		<div class="col">
			<div class="card__header">
				<h4 class="title-4"><?=$movie['title']?></h4>
				<div class="buttons">
				<a href="edit.php?id=<?=$movie['id']?>" class="button button--edit">Редактировать</a>
				<a href="index.php?action=delete&id=<?=$movie['id']?>" class="button button--delete">Удалить</a>
				</div>
			</div>
			<div class="badge"><?=$movie['genre']?></div>
			<div class="badge"><?=$movie['year']?></div>
			<div class="user-content">
				<p><?=$movie['description']?></p>
			</div>
		</div>
	</div>

</div>
