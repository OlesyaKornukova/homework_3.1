<?php


class News
{
    private $news;
    public function __construct($name)
    {
        $file = file_get_contents($name);
        $decode = json_decode($file, true);
        $this->news = $decode;
    }

    public function getNews()
    {
        $newsList ='';
        foreach ($this->news as $item)
        {
            $newsList .= '<h3>' . $item['title'] . '</h3>' . '<small>' . $item['data'] . '</small>' . '<p>' . $item['text'] . '</p>' . '<hr>';

        }
        return $newsList;
    }

    public function getComments()
    {

    }

}

$newsIt = new News('newsIt.json');
$newsWeb = new News('newsWeb.json');


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?=$newsIt->getNews();?>
<?=$newsWeb->getNews();?>

</body>
</html>

