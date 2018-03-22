<?php
namespace CTG\Database;

use Database;

class User {
    // User info goes here
    protected $id;
    protected $username;
    protected $permission;
    protected $phone;
    protected $email;
    protected $password;
    protected $slat;
    protected $registered_at;

    // disable __construct() for the caller forcing him to use helper functions
    protected function __construct() { }

    // helper function that return user object from Database
    function findById($id) {
        // TODO: search for the user in the database to retrieve its data
        //       then assign the data you got to the class members

        // TODO: use try {} block to catch errors
        $db = new Database();

        /* $club = new self();
         * $club->name = $db->clubGetName($id);
         * $club->goals = $db->clubGetGoals($id);
         * $club->members = $db->clubGetMembers($id);
         * $club->manager = $db->clubGetManager($id);
         */
        /* return $club; */
    }

    function addNewClub($id, $name, $goals, $members, $managerID) {
        // TODO: add a new club row to to the database using Database class
        //       and return an instance of Club if it's added to the database
        //       successfully

        // TODO: use try {} block to catch errors
        /* $db = new Database;
         * $db->addClub($id, $name, $goals, $members, $managerID);

         * $club = new self();
         * $club->id = $id;
         * $club->name = $name;
         * $club->goals = $goals;
         * $club->members = $members;
         * $club->manager = $db->clubGetManager($id);

         * return $club; */
    }

    function getID() {
        return $this->id;
    }

    // TODO: not done yet
}
