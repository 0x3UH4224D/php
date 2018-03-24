<?php
namespace CTG\Models;

class Database {
    private const dbName = 'ctittc';
    private const dbHost = 'localhost';
    private const dbUsername = 'root';
    private const dbPassword = '123456';

    // connection to the database
    private static $connection = null;
    // counter for ho many instencs use this connection
    private static $count = 0;

    // Error messages
    private const cannotConnectToDatabase = "Couldn't connect to database";
    private const cannotCreateDatabase = "Couldn't create database";
    private const cannotCreateTable = "Couldn't create database table: ";

    // establish db connection
    function __construct() {
        // if there is already an opened connection, increase our counter
        // and return.
        if (!is_null(self::$connection)) {
            self::$count++;
            return;
        }

        // otherwise make a new connection
        try {
            // before we make connection we carete the database if it's not created
            $this->initDatabase();
            $host = self::dbHost;
            $name = self::dbName;
            $dsn = "mysql:host=$host;dbname=$name;charset=utf8";
            $opt = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => true
            ];

            self::$connection = new \PDO(
                $dsn,
                self::dbUsername,
                self::dbPassword,
                $opt
            );

            // increase out counter
            self::$count++;
        } catch (\PDOException $e) {
            // return an exception when errors happend
            throw new \Exception(self::cannotConnectToDatabase);
        }
    }

    // discconect from db
    function __destruct() {
        // decrease our counter
        self::$count--;

        // check if there are anyother user for the connection, if not disconnect
        // form the database
        if (self::$count == 0) {
            self::$connection = null;
        }
    }

    private function createDatabaseIfNotExist() {
        // TODO
    }

    private function createTablesIfNotExist() {
        // TODO
    }

    private function initDatabase() {
        // TODO
        $this->createDatabaseIfNotExist();
        $this->createTablesIfNotExist();
    }

    function query(string $sql) {
        try {
            $stmt = self::$connection->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            $stmt->closeCursor();
            $stmt = null;
            return $rows;
        } catch (\PDOException $e){
            echo $e;
            throw new \Exception("Couldn't talk to database");
        }
    }

    function execute(string $sql) {
        try {
            $stmt = self::$connection->prepare($sql);
            $result = $stmt->execute();
            $stmt->closeCursor();
            $stmt = null;
            return $result;
        } catch (\PDOException $e){
            echo $e;
            throw new \Exception("Couldn't talk to database");
        }
    }

    function getColumnValueWhere($table, $column, $where, $where_value) {
        $sql = 'SELECT ' . $column
             . ' FROM ' . $table
             . ' WHERE ' . $where . ' = ' . $where_value;
        $row = $this->query($sql);
        if (empty($row)) {
            throw new \Exception("No $column found with this $where.");
        } else {
            return $row[0][$column];
        }
    }

    // Validation function
    function isVaildInt() {
        // TODO
    }
}
