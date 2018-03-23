<?php
namespace CTG\Models;

require_once "./includes/Models/Database.php";

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

    // Check if username is already in use
    function isUsernameUsed(string $username) {
        $db = new Database();
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
