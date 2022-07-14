<?php
  require_once('config.php');

  class Dbh_static {

      public static $connection;
      
      public static function connect() {
          if (!isset(self::$connection))
            try {
              self::$connection = new PDO('mysql:host=' . MYSQL['DB_HOST'] . ';dbname=' . MYSQL['DB_NAME'], MYSQL['DB_USER'], MYSQL['DB_PASS']);
            } 
            catch (PDOException $e) {
              print ("Error!: " . $e->getMessage() . "<br />");
              die();
            }
      }
  }