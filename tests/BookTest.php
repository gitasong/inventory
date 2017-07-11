<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";


    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Book::deleteAll();
        }

    function testSave()
        {
            //Arrange
            $title = "The Unbearable Lightness of Being";
            $author = "Milan Kundera";
            $test_book = new Book($title, $author);
            $test_book->save();

            //Act
            $executed = $test_book->save();

            //Assert
            $this->assertTrue($executed, "Task not successfully saved to database");
        }

        function testGetAll()
        {
            //Arrange
            $title_1 = "The Unbearable Lightness of Being";
            $author_1 = "Milan Kundera";
            $test_book_1 = new Book($title_1, $author_1);
            $test_book_1->save();

            $title_2 = "The Riddle-Master of Hed";
            $author_2 = "Patricia A. McKillip";
            $test_book_2 = new Book($title_2, $author_2);
            $test_book_2->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book_1, $test_book_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $title_1 = "The Unbearable Lightness of Being";
            $author_1 = "Milan Kundera";
            $test_book_1 = new Book($title_1, $author_1);
            $test_book_1->save();

            $title_2 = "The Riddle-Master of Hed";
            $author_2 = "Patricia A. McKillip";
            $test_book_2 = new Book($title_2, $author_2);
            $test_book_2->save();

            //Act
            Book::deleteAll();
            $result = Book::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testGetId()
        {
            //Arrange
            $title = "The Unbearable Lightness of Being";
            $author = "Milan Kundera";
            $test_book = new Book($title, $author);
            $test_book->save();
            //Act
            $result = $test_book->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testFind()
        {
            //Arrange
            $title_1 = "The Unbearable Lightness of Being";
            $author_1 = "Milan Kundera";
            $test_book_1 = new Book($title_1, $author_1);
            $test_book_1->save();

            $title_2 = "The Riddle-Master of Hed";
            $author_2 = "Patricia A. McKillip";
            $test_book_2 = new Book($title_2, $author_2);
            $test_book_2->save();

            //Act
            $result = Book::find($test_book_1->getId());

            //Assert
            $this->assertEquals($test_book_1, $result);
        }

        function testDeleteSingle()
        {
            //Arrange
            $title_1 = "The Unbearable Lightness of Being";
            $author_1 = "Milan Kundera";
            $test_book_1 = new Book($title_1, $author_1);
            $test_book_1->save();

            $title_2 = "The Riddle-Master of Hed";
            $author_2 = "Patricia A. McKillip";
            $test_book_2 = new Book($title_2, $author_2);
            $test_book_2->save();

            //Act
            $test_book_1->deleteSingle();

            //Assert
            $this->assertEquals([$test_book_2], Book::getAll());
        }


    }






 ?>
