<?php
namespace CTG\Database;

class Database {
    private static $dbName = 'ctittc';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbPassword = '1233456';

    // connection to the database
    private static $connection = null;
    // counter for ho many instencs use this connection
    private static $count = 0;

    // Error messages
    private const cannotConnectToDatabase = "Couldn't connect to database";
    private const cannotCreateDatabase = "Couldn't create database";
    private const cannotCreateTable = "Couldn't create database table: ";

    // establish db connection
    private function __construct() {
        // if there is already an opened connection, increase our counter
        // and return.
        if (!is_null(self::connection)) {
            self::count++;
            return;
        }

        // otherwise make a new connection
        try {
            // before we make connection we carete the database if it's not created
            $this->createDatabaseIfNotExist();
            self::connection = new \PDO(
                "mysql:host=self::dbHost;dbname=self::dbName;",
                self::dbUsername,
                self::dbPassword
            );
            // increase out counter
            $this->count++;
        } catch (\PDOException $e) {
            // return an exception when errors happend
            throw new \Exception($self::cannotConnectToDatabase);
        }
    }

    // discconect from db
    function __destruct() {
        // decrease our counter
        $this->count--;

        // check if there are anyother user for the connection, if not disconnect
        // form the database
        if ($this->count == 0) {
            self::connection = null;
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
        $this->createTablesIfNotExist();
    }

    protected function query($sql_statment) {
        // TODO
    }

    function addUser($username, $hash_password, $email, $permission) {
        // TODO
    }

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
