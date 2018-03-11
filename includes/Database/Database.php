<?php
namespace CTG\Database;

class Database {
    protected static $name = '';
    protected static $host = '';
    protected static $username = '';
    protected static $passwo = '';

    function __construct() {
        // TODO
        // we should establish db connection here
    }

    function __destruct() {
        // TODO
        // we should discconect from db here
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
