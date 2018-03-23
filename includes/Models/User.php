<?php
namespace CTG\Models;

require_once "./includes/Models/Database.php";

class User {
    // User info goes here
    protected $id;
    protected $username;
    protected $phone;
    protected $email;
    protected $permission;
    protected $password;
    protected $slat;
    protected $registration_date;

    // disable __construct() for the caller forcing him to use helper functions
    protected function __construct() { }

    // helper function that return user object from Database
    static function findById(int $id) {
        $user = new self();
        $user->username = $user->getUsernameById($id);
        $user->phone = $user->getPhoneById($id);
        $user->email = $user->getEmailById($id);
        $user->permission = $user->getPermissionById($id);
        $user->password = $user->getPasswordById($id);
        $user->slat = $user->getSlatById($id);
        $user->registration_date = $user->getRegistrationDateById($id);
        $user->id = $id;
        
        return $user;
    }

    static function addNewUser($username, $phone, $email, $password) {
        // TODO: add a new user row to to the database using Database class
        //       and return an instance of User if it's added to the database
        //       successfully, otherwise throw an Exception.

        // TODO: use try {} block to catch errors

        /* $db->addUser($id, $name, $goals, $members, $managerID);

         * $user = new self();
         * $user->id = $id;
         * $user->name = $name;
         * $user->goals = $goals;
         * $user->members = $members;
         * $user->manager = $db->userGetManager($id); */

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
        return $this->registration_date;
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

    // validate username 
    function isValidUsername(string $username) {
        // TODO
        return true;
    }

    // validate password
    function isValidPassword(string $password) {
        // TODO
        return true;
    }

    // validate phone
    function isValidPhone(string $phone) {
        // TODO
        return true;
    }

    // validate email
    function isValidEmail(string $email) {
        // TODO
        return true;
    }

    // Add a new user to the database.
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

    // Add a new admin to the database with admin permission
    function addAdmin($username, $raw_password, $email, $phone) {
        // TODO
    }

    // general function that help get one value using one condation
    function getValueBy($column, $condation, $value) {
        $db = new Database();
        $sql = 'SELECT ' . $column
             . ' FROM users'
             . ' WHERE ' . $condation . ' = ' . $value;
        $row = $db->query($sql);
        if (empty($row)) {
            $column_v = $column->value;
            $condation_v = $condation->value;
            throw new \Exception("No $column_v found with this $condation_v.");
        } else {
            /* var_dump($row[0]);*/
            return $row[0][$column];
        }
    }

    // functions for id column in database
    function getIdByUsername(string $username) {
        return $this->getValueBy('id', 'username', $username);
    }

    function getIdByPhone(string $phone) {
        return $this->getValueBy('id', 'phone', $phone);
    }

    function getIdByEmail(string $email) {
        return $this->getValueBy('id', 'email', $email);
    }

    // functions for username column in database
    function getUsernameById(string $id) {
        return $this->getValueBy('username', 'id', $id);
    }

    function getUsernameByEmail(string $email) {
        return $this->getValueBy('username', 'email', $email);
    }

    function getUsernameByPhone(string $phone) {
        return $this->getValueBy('username', 'phone', $phone);
    }

    // functions for phone column in database
    function getPhoneById(string $id) {
        return $this->getValueBy('phone', 'id', $id);
    }

    function getPhoneByUsername(string $username) {
        return $this->getValueBy('phone', 'username', $username);
    }

    function getPhoneByEmail(string $email) {
        return $this->getValueBy('phone', 'email', $email);
    }

    // functions for Email column in database
    function getEmailById(string $id) {
        return $this->getValueBy('email', 'id', $id);
    }

    function getEmailByUsername(string $username) {
        return $this->getValueBy('email', 'username', $username);
    }

    function getEmailByPhone(string $phone) {
        return $this->getValueBy('email', 'phone', $phone);
    }

    // functions for permission column in database
    function getPermissionById(string $id) {
        return $this->getValueBy('permission', 'id', $id);
    }

    function getPermissionByUsername(string $username) {
        return $this->getValueBy('permission', 'username', $username);
    }

    function getPermissionByEmail(string $email) {
        return $this->getValueBy('permission', 'email', $email);
    }

    function getPermissionByPhone(string $phone) {
        return $this->getValueBy('permission', 'phone', $phone);
    }

    // functions for Password column in database
    function getPasswordById(string $id) {
        return $this->getValueBy('password', 'id', $id);
    }

    function getPasswordByUsername(string $username) {
        return $this->getValueBy('password', 'username', $username);
    }

    function getPasswordByEmail(string $email) {
        return $this->getValueBy('password', 'email', $email);
    }
    
    function getPasswordByPhone(string $phone) {
        return $this->getValueBy('password', 'phone', $phone);
    }

    // functions for Slat column in database
    function getSlatById(string $id) {
        return $this->getValueBy('slat', 'id', $id);
    }

    function getSlatByUsername(string $username) {
        return $this->getValueBy('slat', 'username', $username);
    }

    function getSlatByEmail(string $email) {
        return $this->getValueBy('slat', 'email', $email);
    }

    function getSlatByPhone(string $phone) {
        return $this->getValueBy('slat', 'phone', $phone);
    }

    // functions for registration_date column in database
    function getRegistrationDateById(string $id) {
        return $this->getValueBy('registration_date', 'id', $id);
    }

    function getRegistrationDateByUsername(string $username) {
        return $this->getValueBy('registration_date', 'username', $username);
    }

    function getRegistrationDateByEmail(string $email) {
        return $this->getValueBy('registration_date', 'email', $email);
    }

    function getRegistrationDateByPhone(string $phone) {
        return $this->getValueBy('registration_date', 'phone', $phone);
    }

    // TODO: not done yet
}


// old
/* public function addNewUser($username, $email, $confirm_email, $password, $confirm_password)
 * {
 *     $db = new Database();
 *     // clear from speicial characters
 *     $username = clearInput($username, 1);
 *     $email = clearInput($email, 1);
 *     $confirm_email = clearInput($username, 1);
 *     
 *     // check empty
 *     $username = emptyInput($username, "Username is required");
 *     $email = emptyInput($email, "Email is required");
 *     $confirm_email = emptyInput($email, "Confirm Email is required");
 *     $password = emptyInput($password, "Password is required");
 *     $confirm_password = emptyInput($password, "Confirm Password is required");
 * 
 *     // check length
 *     // $username = length($username, 6, "Username should has at least 7 characters or more");
 *     // $password = length($password, 6, "Password should has at least 7 characters or more");
 * 
 *     // check password and email
 *     $confirm_email = emailValid($email, $confirm_email);
 *     $confirm_password = password($password, $confirm_password, 1);
 * 
 *     $db->add_user($username, $confirm_email, $confirm_password);
 * }
 * 
 * public function userLogin($username, $password)
 * {
 *     $db = new Database();
 *     // check empty
 *     $username = clearInput($username, 1);
 *     $password = clearInput($password, 2);
 *     $username = emptyInput($username, "Username is required");
 *     $password = emptyInput($password, "Password is required");
 *     // check length
 *     // $username = length($username, 6, "Username should has at least 7 characters or more");
 *     // $password = length($password, 6, "Password should has at least 7 characters or more");
 *     
 *     $password = password($password, false, 2);
 *     
 *     $db->user_login($username, $password);
 * 
 * }
 * 
 * public function getUserInfoBySession()
 * {
 *     $this->id = $_SESSION['id'];
 *     $this->userename = $_SESSION['username'];
 *     $this->email = $_SESSION['email'];
 *     $this->createdAt = $_SESSION['createdAt'];
 *     $this->permissions = $_SESSION['permissions'];
 * 
 *     $userSession = array(
 *         "userId" => $this->id,
 *         "username" => $this->username,
 *         "email" => $this->email,
 *         "createdAt" => $this->createdAt,
 *         "permissions" => $this->permissions,
 *     );
 * 
 *     // return array with values
 *     return $userSession;
 * }
 * 
 * public function logout()
 * {
 *     unset($_SESSION['loggedin']);
 *     unset($_SESSION['id']);
 *     unset($_SESSION['username']);
 *     unset($_SESSION['email']);
 *     unset($_SESSION['createdAt']);
 *     unset($_SESSION['permissions']);
 *     session_destroy();
 *     header("Location: /php/index.php");
 * }
 * 
 * public function forgetPassword($email, $confirm_email, $username)
 * {
 *     $db = new Database();
 *     $email = emptyInput($email, "Email is Required");
 *     $username = clearInput($username, 1);
 *     $username = emptyInput($email, "Username is Required");
 *     
 *     $confirm_email = emailValid($email, $confirm_email);
 *     $db->user_forget_password($confirm_email, $username);
 *     // $username = length($username, 6, "Username should has at least 7 characters or more");
 * }
 * */
