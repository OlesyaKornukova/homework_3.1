<?php

class NewsArticle
{
	const PATH_NEWS = 'articles/news.json';

	private $pubDate;
	private $title;
	private $author;
	private $text;
	private $photoPath;
	private $likes = 0;
	private $views = 0;
	private $shortTitle;


	function __construct($title, $author, $text, $photoPath = 'images/default.jpg', $pubDate = 0, $views = 0, $likes = 0, $shortTitle = '')
	{
		$this->title = $title;
		$this->text = $text;
		$this->author = $author;
		$this->photoPath = $photoPath;
		$this->views = $views;
		$this->likes = $likes;

		if ( $pubDate === 0)
		{
			$this->pubDate = time();
		} else
		{
			$this->pubDate = $pubDate;
		}

		if ( $shortTitle === '')
		{
			$titleArray = explode(' ', $title);
			$this->shortTitle = $titleArray[0].ucfirst($titleArray[1]);
		} else
		{
			$this->shortTitle = $shortTitle;
		}
	}

	function saveToJson()
	{
		$article = 
		[
			'title' => $this->title,
			'text' => $this->text,
			'author' => $this->author,
			'photoPath' => $this->photoPath,
			'pubDate' => $this->pubDate,
			'views' => $this->views,
			'likes' => $this->likes,
			'shortTitle' => $this->shortTitle
		];

		if ( is_readable(self::PATH_NEWS) )
		{
			$articlesJson = file_get_contents(self::PATH_NEWS);
			$articlesArray = json_decode($articlesJson, true);

			$articlesArray[$this->shortTitle] = $article;

			$articlesJson = json_encode($articlesArray);
			if ( file_put_contents(self::PATH_NEWS, $articlesJson) )
			{
				return true;
			}

		} else
		{
			$articlesArray[$this->shortTitle] = $article;
			$articlesJson = json_encode($articlesArray);
			if ( file_put_contents(self::PATH_NEWS, $articlesJson) )
			{
				return true;
			}
		}

		return false;

		
	}

	public function addLike()
	{
		$this->likes++;
	}


	public function getTitle()
	{
		return $this->title;
	}
	public function getAuthor()
	{
		return $this->author;
	}
	public function getText()
	{
		return $this->text;
	}
	public function getPubDate()
	{
		return $this->pubDate;
	}
	public function getPhotoPath()
	{
		return $this->photoPath;
	}
	public function getLikes()
	{
		return $this->likes;
	}
	public function getViews()
	{
		$this->views++;
		return $this->views;
	}
	public function getShortTitle()
	{
		return $this->shortTitle;
	}

}


