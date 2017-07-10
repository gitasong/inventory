<?php
class Book
{

    private $title;
    private $author;
    private $id;

    function __construct($title, $author, $id = null)
    {
        $this->title = $title;
        $this->author = $author;
        $this->id = $id;
    }

    function setTitle($new_title)
        {
            $this->title = (string) $new_title;
        }

    function getTitle()
    {
        return $this->title;
    }

    function setAuthor($new_author)
        {
            $this->author = (string) $new_author;
        }

    function getAuthor()
    {
        return $this->author;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO books (title, author) VALUES ('{$this->getTitle()}', '{$this->getAuthor()}')");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

}
?>
