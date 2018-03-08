<?php
namespace CTG\Core

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

    function add_user($username, $hash_password, $email, $permission) {
        // TODO
    }

    function add_club($clubname, $manager_id) {
        // TODO
    }

    // TODO: Add other functions
    // TODO: make functions return wither they executed successfully or not.
}
