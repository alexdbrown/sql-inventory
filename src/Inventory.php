<?php
    class Inventory
    {
        private $item_name;
        private $id;

        function __construct($item_name, $id = null)
        {
            $this->item_name = $item_name;
            $this->id = $id;
        }

        function getItemName()
        {
            return $this->item_name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO items (name) VALUES ('{$this->getItemName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_items = $GLOBALS['DB']->query("SELECT * FROM items;");
            $items = array();
            foreach ($returned_items as $item) {
                $item_name = $item['name'];
                $id = $item['id'];
                $new_item = new Inventory($item_name, $id);
                array_push($items, $new_item);
            }
            return $items;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM items;");
        }
    }
 ?>
