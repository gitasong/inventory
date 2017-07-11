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

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO books (title, author) VALUES ('{$this->getTitle()}', '{$this->getAuthor()}')");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
    {
        $returned_books = $GLOBALS['DB']->query("SELECT * FROM books;");
        $books = array();
        foreach($returned_books as $book) {
            $title = $book['title'];
            $author = $book['author'];
            $id = $book['id'];
            $new_book = new Book($title, $author, $id);
            array_push($books, $new_book);
        }
        return $books;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM books;");
    }

}
?>
