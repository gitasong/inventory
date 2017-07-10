<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Inventory.php";


    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class InventoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Inventory::deleteAll();
        }


    }






 ?>
