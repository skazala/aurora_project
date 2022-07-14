<?php
class Item {

    private $name;
    private $description;
    private $status;
    private $category;

    public function __construct($name, $description, $status, $category) {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->category = $category;
    }

    public function setItem() {
    
        $query = Dbh_static::$connection->prepare('INSERT INTO items (name, description, status, category) VALUES (?, ?, ?, ?);');
        $query->execute(array($this->name, $this->description, $this->status, $this->category));
        $query = null;
    }

    public function updateItem($id) {

        $query = Dbh_static::$connection->prepare('UPDATE items SET name = ?, 
                                                                    description = ?,
                                                                    status = ?,
                                                                    category = ? WHERE id = ?');
        $query->execute(array($this->name, $this->description, $this->status, $this->category, $id));
        $query = null;
    }

    public static function getItemById($id) {
        
        $query = Dbh_static::$connection->prepare('SELECT * FROM items WHERE id = ?;');
        $query->execute(array($id));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $query = null;

        return $result;
    }

    public static function deleteItem($id) {
        
        $query = Dbh_static::$connection->prepare('DELETE FROM items WHERE id = ? LIMIT 1;');
        $query->execute(array($id));
        $query = null;
    }

    public static function getAllItems() {
        
        $query = Dbh_static::$connection->query('SELECT * FROM items ORDER BY name ASC;');
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = null;
    
        return $result;  
    }

}