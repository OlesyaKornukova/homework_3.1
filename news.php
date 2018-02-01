<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form  class="addnews" method="POST" enctype="multipart/form-data" action="handler.php">
				<input class="title" required name="title" type="text" placeholder="Название статьи"></input>
				<input class="author" required name="author" type="text" placeholder="Автор" value="<?php if (isset($_SESSION['author'])) echo $_SESSION['author'];?>"></input>
				<textarea class="article" name="text" required  type="textarea" placeholder="Текст статьи" rows="20" cols="85" ></textarea>
				
					<input class="file" required type="file" name="articleimage" accept="image/*"></input>
				
				<button type="submit">Добавить статью</button>
			</form>
		</div>
		<div class="col-md-3"></div>
	</div>

</body>
</html>