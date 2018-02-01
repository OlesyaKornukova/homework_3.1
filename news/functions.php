<?php
require 'newsclass.php';
require 'commentsclass.php';
session_start();
define('PATH', 'articles/news.json');
define('COMMENTS_PATH', 'articles/comments.json');


function saveImage($name, $folder)
{
	if ( isset($_FILES[$name]) && !empty($_FILES[$name]['name']) )
	{
		$fileName = $_FILES[$name]['name'];
		$tmpFile = $_FILES[$name]['tmp_name'];
		return move_uploaded_file($tmpFile, $folder . $fileName);
	}  

}


function getImagePath($name, $folder)
{
	if ( isset($_FILES[$name]) && !empty($_FILES[$name]['name']) )
	{
		return $folder . $_FILES[$name]['name'];
	}  
}

function checkContent($method, &$title, &$author, &$text = 1)
{
	if ( $_SERVER['REQUEST_METHOD'] === $method && isset($title, $author, $text) && !empty($title) && !empty($author) && !empty($text))
	{	
		$text = nl2br(htmlspecialchars($text));
		$title = htmlspecialchars($title);
		$author = htmlspecialchars($author);
		return true;
	}
	return false;
}

function checkArticle($title)
{
	if ( $_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET[$title]) && !empty($_GET[$title]) )
	{
		return true;
	}
	return false;
}


function extractArticles($path)
{
	if ( is_readable($path) )
	{
		return json_decode(file_get_contents($path), true);
	}
	return false;
}

function createArticleFromForm($title, $author, $text, $imagePath)
{
	return new NewsArticle($title, $author, $text, $imagePath);
}

function createArticleObjectFromArray($articlesArray, $shortTitle)
{
	extract($articlesArray[$shortTitle]);
	return new NewsArticle($title, $author, $text, $photoPath, $pubDate, $views, $likes, $shortTitle);
} 

function createComment($author, $text, $articleTitle)
{
	return new Comment($author, $text, $articleTitle);
}


date_default_timezone_set('Europe/Moscow');
