<?php

class Comment
{
	const PATH_COMMENTS = 'articles/comments.json';

	private $author;
	private $text;
	private $articleTitle;

	function __construct($author, $text, $articleTitle = '')
	{
		$this->author = $author;
		$this->text = $text;
		$this->articleTitle = $articleTitle;
	}

	public function saveToJson()
	{
		$comments = 
		[
			'text' => $this->text,
			'author' => $this->author,
		];

		if ( is_readable(self::PATH_COMMENTS) )
		{
			$commentsJson = file_get_contents(self::PATH_COMMENTS);
			$commentsArray = json_decode($commentsJson, true);

			$commentsArray[$this->articleTitle][] = $comments;

			$commentsJson = json_encode($commentsArray);

			if ( file_put_contents(self::PATH_COMMENTS, $commentsJson) )
			{
				return true;
			}

		} else
		{
			$commentsArray[$this->articleTitle][] = $comments;
			$commentsJson = json_encode($commentsArray);
			if ( file_put_contents(self::PATH_COMMENTS, $commentsJson) )
			{
				return true;
			}
		}

		return false;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getText()
	{
		return $this->text;
	}


		
}