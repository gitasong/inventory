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
        // protected function tearDown()
        // {
        //     Book::deleteAll();
        // }

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

    }






 ?>
