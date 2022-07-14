<?php
class Category {

    public static function getAllCategories() {
        
        $query = Dbh_static::$connection->query('SELECT * FROM categories ORDER BY name ASC;');
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = null;
    
        return $result;  
    }

}