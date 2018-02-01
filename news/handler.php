<?php
require 'functions.php';
if ( $imagePath = getImagePath('articleimage', 'images/') )
{
	saveImage('articleimage', 'images/');
	
} else
{
	$imagePath = 'images/default.jpg';
}


extract($_POST);

if ( checkContent('POST', $title, $author, $text) )
{
	$_SESSION['author'] = $author;
	$article = createArticleFromForm($title, $author, $text, $imagePath);
	$article->saveToJson();
	$_SESSION['title'] = $article->getShortTitle();
	unset($article);
	header('Location: newsfeed.php');
} 


if ( checkArticle('title') )
{	
	extract($_GET);

	if ( !isset($_SESSION[$title.'Like']))
	{
		$newsArray = extractArticles(PATH);
		$article = createArticleObjectFromArray($newsArray, $title);
		$article->addLike();
		$article->saveToJson();
		unset($article);
		$_SESSION[$title.'Like'] = true;
		header('Location: newsfeed.php?title='.$title);
	} else
	{
		header('Location: newsfeed.php?title='.$title);
	}

}


if ( checkContent('POST', $commentauthor, $commenttext, $articletitle) )
{
	$comment = createComment($commentauthor, $commenttext, $articletitle);
	$comment->saveToJson();
	unset($comment);
	header('Location: newsfeed.php?title='.$articletitle.'#com');
}
