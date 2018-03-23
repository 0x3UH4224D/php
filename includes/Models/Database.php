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

    function query(string $sql, $values) {
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($values);
        $rows = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;
        return $rows;
    }

    function execute(string $sql, $values) {
        $stmt = self::$connection->prepare($sql);
        $result = $stmt->execute($values);
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    // Methods for users table
    function addClub($id, $name, $goals, $members, $managerID) {
        // TODO
    }

    function clubGetName($id) {
        // TODO
    }

    function clubGetGoals($id) {
        // TODO
    }

    function clubGetMembers($id) {
        // TODO
    }

    function clubGetManager($id) {
        // TODO
    }

    function clubGetIdByName($name) {
        // TODO
    }

    // TODO: Add other functions
    // TODO: make functions return wither they executed successfully or not.
}
