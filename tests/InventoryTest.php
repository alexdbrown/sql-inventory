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

        function test_getAll()
        {
            //Arrange
            $item = "Antique Toothpick Holders";
            $item2 = "Ornamental Mouse Traps";
            $test_Inventory = new Inventory($item);
            $test_Inventory->save();
            $test_Inventory2 = new Inventory($item2);
            $test_Inventory2->save();

            //Act
            $result = Inventory::getAll();

            //Assert
            $this->assertEquals([$test_Inventory, $test_Inventory2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $item = "Antique Toothpick Holders";
            $item2 = "Ornamental Mouse Traps";
            $test_Inventory = new Inventory($item);
            $test_Inventory->save();
            $test_Inventory2 = new Inventory($item2);
            $test_Inventory2->save();

            //Act
            Inventory::deleteAll();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals([], $result);
        }

    }
 ?>
