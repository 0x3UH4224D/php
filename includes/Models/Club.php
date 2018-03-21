<?php
namespace CTG\Database;

use Database;

class Club {
    // Club info goes here
    protected $id;
    protected $name;
    protected $goals;
    // array of Users IDs
    protected $members;
    // manager, User object
    protected $manager;

    // disable __construct() for the caller forcing him to use helper functions
    protected function __construct() { }

    function findById($id) {
        // TODO: search for the clubs in the database to retrieve its data
        //       then assign the data you got to the class members

        // TODO: use try {} block to catch errors
        $db = new Database();

        $club = new self();
        $club->name = $db->clubGetName($id);
        $club->goals = $db->clubGetGoals($id);
        $club->members = $db->clubGetMembers($id);
        $club->manager = $db->clubGetManager($id);

        return $club;
    }

    function addNewClub($id, $name, $goals, $members, $managerID) {
        // TODO: add a new club row to to the database using Database class
        //       and return an instance of Club if it's added to the database
        //       successfully

        // TODO: use try {} block to catch errors
        $db = new Database;
        $db->addClub($id, $name, $goals, $members, $managerID);

        $club = new self();
        $club->id = $id;
        $club->name = $name;
        $club->goals = $goals;
        $club->members = $members;
        $club->manager = $db->clubGetManager($id);

        return $club;
    }

    function getID() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getGoals() {
        return $this->goals;
    }

    function getMembers() {
        return $this->members;
    }

    function getManager() {
        return $this->manager;
    }
}
