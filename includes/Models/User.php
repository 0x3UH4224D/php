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
    static function findById($id) {
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

    static function addNewUser($username, $phone, $email, $password) {
        // TODO: add a new user row to to the database using Database class
        //       and return an instance of User if it's added to the database
        //       successfully, otherwise throw an Exception.

        // TODO: use try {} block to catch errors
        $db = new Database;
        /* $db->addClub($id, $name, $goals, $members, $managerID);

         * $club = new self();
         * $club->id = $id;
         * $club->name = $name;
         * $club->goals = $goals;
         * $club->members = $members;
         * $club->manager = $db->clubGetManager($id); */

        return $user;
    }

    function getID() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPermissions() {
        return $this->permission;
    }

    function getPhone() {
        return $this->phone;
    }

    function getEmail() {
        return $this->email;
    }

    private function getPassword() {
        return $this->password;
    }

    private function getSlat() {
        return $this->slat;
    }

    function getRegistrationDate() {
        return $this->registered_at;
    }

    // TODO: not done yet
}


public function addNewUser($username, $email, $confirm_email, $password, $confirm_password)
{
    $db = new Database();
    // clear from speicial characters
    $username = clearInput($username, 1);
    $email = clearInput($email, 1);
    $confirm_email = clearInput($username, 1);
    
    // check empty
    $username = emptyInput($username, "Username is required");
    $email = emptyInput($email, "Email is required");
    $confirm_email = emptyInput($email, "Confirm Email is required");
    $password = emptyInput($password, "Password is required");
    $confirm_password = emptyInput($password, "Confirm Password is required");

    // check length
    // $username = length($username, 6, "Username should has at least 7 characters or more");
    // $password = length($password, 6, "Password should has at least 7 characters or more");

    // check password and email
    $confirm_email = emailValid($email, $confirm_email);
    $confirm_password = password($password, $confirm_password, 1);

    $db->add_user($username, $confirm_email, $confirm_password);
}

public function userLogin($username, $password)
{
    $db = new Database();
    // check empty
    $username = clearInput($username, 1);
    $password = clearInput($password, 2);
    $username = emptyInput($username, "Username is required");
    $password = emptyInput($password, "Password is required");
    // check length
    // $username = length($username, 6, "Username should has at least 7 characters or more");
    // $password = length($password, 6, "Password should has at least 7 characters or more");
    
    $password = password($password, false, 2);
    
    $db->user_login($username, $password);

}

public function getUserInfoBySession()
{
    $this->id = $_SESSION['id'];
    $this->userename = $_SESSION['username'];
    $this->email = $_SESSION['email'];
    $this->createdAt = $_SESSION['createdAt'];
    $this->permissions = $_SESSION['permissions'];

    $userSession = array(
        "userId" => $this->id,
        "username" => $this->username,
        "email" => $this->email,
        "createdAt" => $this->createdAt,
        "permissions" => $this->permissions,
    );

    // return array with values
    return $userSession;
}

public function logout()
{
    unset($_SESSION['loggedin']);
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['createdAt']);
    unset($_SESSION['permissions']);
    session_destroy();
    header("Location: /php/index.php");
}

public function forgetPassword($email, $confirm_email, $username)
{
    $db = new Database();
    $email = emptyInput($email, "Email is Required");
    $username = clearInput($username, 1);
    $username = emptyInput($email, "Username is Required");
    
    $confirm_email = emailValid($email, $confirm_email);
    $db->user_forget_password($confirm_email, $username);
    // $username = length($username, 6, "Username should has at least 7 characters or more");
}
}

?>
>>>>>>> origin/master
