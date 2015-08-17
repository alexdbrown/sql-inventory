<?php

    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */


    require_once "src/Inventory.php";

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class InventoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Inventory::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $item = "Antique Toothpick Holders";
            $test_Inventory = new Inventory ($item);

            //Act
            $test_Inventory->save();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals($test_Inventory, $result[0]);
        }


    }
 ?>
