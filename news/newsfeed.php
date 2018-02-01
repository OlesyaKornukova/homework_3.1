<?php

require 'functions.php';
$newsArray = extractArticles(PATH);
$shorTitlesArray =  array_keys($newsArray);

if ( checkArticle('title') )
{
	extract($_GET);

	if ( !in_array($title, $shorTitlesArray) )
	{
		unset($title);
	} 
}




if ( !isset($title) )
{
	if ( isset($_SESSION['title']) )
	{
		$title = $_SESSION['title'];
	} else
	{
		$title = $shorTitlesArray[array_rand($shorTitlesArray)];
	}
}


$article = createArticleObjectFromArray($newsArray, $title);

$commentsArray = extractArticles(COMMENTS_PATH);

?>

<!DOCTYPE html>
<html>
<header>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</header>

<body>
	<div class="row">
		<div class="col-md-2"></div>


			<div class="col-md-6">
				<div class="article">
					<div class="upperline">
						<div class="pubdate"><?=date('j F Y, G:i', $article->getPubDate())?></div><div><?=$article->getAuthor()?></div> <div class="viewslikes"> &#128065; <?=$article->getViews()?> &#9829; <?=$article->getLikes()?></div>
					</div>
					<h3><?=$article->getTitle()?></h3>
					<p><?=$article->getText();?></p>
					<img class="articlepic" src="<?=$article->getPhotoPath()?>"> 
					<div class="like"><a href="handler.php?title=<?=$title?>">&#128077;</a></div>

			</div>
			</div>


		<div class="col-md-2">
			<div class="links">
				<ul>
					<?php foreach ($shorTitlesArray as $title2): ?>
					<li><a href="newsfeed.php?title=<?=$title2?>"><?=$title2?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="col-md-2"></div>
	</div>

	<div class="row">
		<div class="col-md-2"></div>
			<div class="col-md-6">
				<div class="commentsection">

					<form id="com" class="addcomment" method="POST" action="handler.php">
						<input class="author" required name="commentauthor"  placeholder="Автор" value="<?php if (isset($_SESSION['author'])) echo $_SESSION['author'];?>"></input>
						<textarea class="article" name="commenttext" required   placeholder="Комментарий" rows="5" cols="85" ></textarea>
						<input type="hidden" name="articletitle" value="<?=$title?>">
						<button  type="submit">Добавить комментарий</button>
					</form>

					<?php if ( isset($commentsArray[$title]) && !empty($commentsArray[$title]) ) { foreach ($commentsArray[$title] as $commentArray): 
						extract($commentArray); $comment = createComment($author, $text, $title); ?>
						<div class="comment">
							<div class="pic"><img class="userpic" src="images/userpic.png"></div> 
							<div>
								<div class="author"><?=$comment->getAuthor()?></div>
								<div><?=$comment->getText()?></div>
							</div>
					</div>
				<?php endforeach; }?>
				</div>
			</div>

		<div class="col-md-4"></div>
	</div>

</body>
</html>

<?php

$article->saveToJson();
unset($article); 




