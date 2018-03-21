<?php
namespace CTG\Database;

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

    protected function query(string $sql, $values) {
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($values);
        $rows = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;
        return $rows;
    }

    protected function execute(string $sql, $values) {
        $stmt = self::$connection->prepare($sql);
        $result = $stmt->execute($values);
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    // Methods for users table


    // Check if username is already in use
    function isUsernameUsed(string $username) {
        $sql = 'SELECT username FROM users WHERE lower(username) = lower(?)';
        $row = $this->query($sql, [$username]);

        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    // Check if email is already in use
    function isEmailUsed(string $email) {
        $sql = 'SELECT email FROM users WHERE lower(email) = lower(?)';
        $row = $this->query($sql, [$email]);

        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    // Check if phone number is already in use
    function isPhoneUsed(string $phone) {
        $sql = 'SELECT phone FROM users WHERE phone = ?';
        $row = $this->query($sql, [$phone]);

        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    function isValidUsername(string $username) {
        // TODO
        return true;
    }

    function isValidPassword(string $password) {
        // TODO
        return true;
    }

    function isValidPhone(string $phone) {
        // TODO
        return true;
    }

    function isValidEmail(string $email) {
        // TODO
        return true;
    }

    function addUser(
        string $username,
        string $raw_password,
        string $email,
        string $phone = null
    ) {
        // check for input if they are in used or they are not valid
        if ($this->isUsernameUsed($username)) {
            throw new \Exception('This username is not available, please pick another one');
        }
        if (!$this->isValidUsername($username)) {
            throw new \Exception('Username is not valid');
        }

        if ($this->isEmailUsed($email)) {
            throw new \Exception('This email is not available, please pick another one');
        }
        if (!$this->isValidEmail($email)) {
            throw new \Exception('Email is not valid');
        }

        if (!is_null($phone)) {
            if ($this->isPhoneUsed((string)$phone)) {
                throw new \Exception('This phone is not available, please pick another one');
            }
            if (!$this->isValidPhone((string)$phone)) {
                throw new \Exception('phone is not valid');
            }
        }

        if (!$this->isValidPassword($raw_password)) {
            throw new \Exception('Password is not valid');
        }


        // TODO: generate a new slat to hash password, and save it in the database
        $slat = 'SLAT_EMPTY';
        $password = $raw_password;

        // insert data to database
        $sql = '';
        $values = [];
        if (is_null($phone)) {
            $sql = 'INSERT INTO users (username, email, password, slat)'
                 . 'VALUES (?, ?, ?, ?)';
            $values = [$username, $email, $password, $slat];
        } else {
            $sql = 'INSERT INTO users (username, phone, email, password, slat)'
                 . 'VALUES (?, ?, ?, ?, ?)';
            $values = [$username, $phone, $email, $password, $slat];
        }

        return $this->execute($sql, $values);
    }

    function addAdmin($username, $raw_password, $email, $phone) {
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
