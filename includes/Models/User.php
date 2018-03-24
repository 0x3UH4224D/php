<?php
namespace CTG\Models;

require_once "./includes/Models/Database.php";

class User {
    // User Info goes here
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

    static function findByUsername(string $username) {
        $user = new self();
        $user->id = $user->getIdByUsername($username);
        $user->phone = $user->getPhoneByUsername($username);
        $user->email = $user->getEmailByUsername($username);
        $user->permission = $user->getPermissionByUsername($username);
        $user->password = $user->getPasswordByUsername($username);
        $user->slat = $user->getSlatByUsername($username);
        $user->registration_date = $user->getRegistrationDateByUsername($username);
        $user->username = $username;
        
        return $user;
    }

    static function addNewUser($username, $email, $password, $phone = null) {
        // TODO: add a new user row to to the database using Database class
        //       and return an instance of User if it's added to the database
        //       successfully, otherwise throw an Exception.

        $db = new Database();
        // check for input if they are in used or they are not valid
        if (self::isUsernameUsed($username)) {
            throw new \Exception('This username is not available, please pick another one');
        }
        if (!self::isValidUsername($username)) {
            throw new \Exception('Username is not valid');
        }

        if (self::isEmailUsed($email)) {
            throw new \Exception('This email is not available, please pick another one');
        }
        if (!self::isValidEmail($email)) {
            throw new \Exception('Email is not valid');
        }

        if (!is_null($phone)) {
            if (self::isPhoneUsed((string)$phone)) {
                throw new \Exception('This phone is not available, please pick another one');
            }
            if (!self::isValidPhone((string)$phone)) {
                throw new \Exception('phone is not valid');
            }
        }

        if (!self::isValidPassword($password)) {
            throw new \Exception('Password is not valid');
        }

        // TODO: generate a new slat to hash password, and save it in the database
        $slat = 'SLAT_EMPTY';

        // insert data to database
        $sql = '';
        $values = [];
        if (is_null($phone)) {
            $sql = 'INSERT INTO users (username, email, password, slat)'
                 . "VALUES (\"$username\", \"$email\", \"$password\", \"$slat\")";
            $db = new Database();
            $db->execute($sql);
        } else {
            $sql = 'INSERT INTO users (username, phone, email, password, slat)'
                 . "VALUES (\"$username\", \"$phone\", \"$email\", \"$password\", \"$slat\")";
            $db = new Database();
            $db->execute($sql);
        }

        return self::findByUsername($username);
    }

    // Add a new admin to the database with admin permission
    function addAdmin($username, $raw_password, $email, $phone) {
        // TODO
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
    static function isUsernameUsed(string $username) {
        $sql = 'SELECT * FROM users WHERE lower(username) = lower("'.$username.'")';
        $db = new Database();
        $row = $db->query($sql);

        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    // Check if email is already in use
    static function isEmailUsed(string $email) {
        $sql = 'SELECT email FROM users WHERE lower(email) = lower("'.$email.'")';
        $db = new Database();
        $row = $db->query($sql);

        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    // Check if phone number is already in use
    static function isPhoneUsed(string $phone) {
        $sql = 'SELECT phone FROM users WHERE phone = '.$phone;
        $row = $db->query($sql);

        if (empty($row)) {
            return false;
        } else {
            return true;
        }
    }

    // validate username 
    static function isValidUsername(string $username) {
        // TODO
        return true;
    }

    // validate password
    static function isValidPassword(string $password) {
        // TODO
        return true;
    }

    // validate phone
    static function isValidPhone(string $phone) {
        // TODO
        return true;
    }

    // validate email
    static function isValidEmail(string $email) {
        // TODO
        return true;
    }

    // functions for id column in database
    static function getIdByUsername(string $username) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'id', 'username', '"' . $username . '"');
    }

    static function getIdByPhone(string $phone) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'id', 'username', $username);
    }

    static function getIdByEmail(string $email) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'id', 'email', $email);
    }

    // functions for username column in database
    static function getUsernameById(string $id) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'username', 'id', $id);
    }

    static function getUsernameByEmail(string $email) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'username', 'email', $email);
    }

    static function getUsernameByPhone(string $phone) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'username', 'phone', $phone);
    }

    // functions for phone column in database
    static function getPhoneById(string $id) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'phone', 'id', $id);
    }

    static function getPhoneByUsername(string $username) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'phone', 'username', $username);
    }

    static function getPhoneByEmail(string $email) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'phone', 'email', $email);
    }

    // functions for Email column in database
    static function getEmailById(string $id) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'email', 'id', $id);
    }

    static function getEmailByUsername(string $username) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'email', 'username', $username);
    }

    static function getEmailByPhone(string $phone) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'email', 'phone', $phone);
    }

    // functions for permission column in database
    static function getPermissionById(string $id) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'permission', 'id', $id);
    }

    static function getPermissionByUsername(string $username) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'permission', 'username', $username);
    }

    static function getPermissionByEmail(string $email) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'permission', 'email', $email);
    }

    static function getPermissionByPhone(string $phone) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'permission', 'phone', $phone);
    }

    // functions for Password column in database
    static function getPasswordById(string $id) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'password', 'id', $id);
    }

    static function getPasswordByUsername(string $username) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'password', 'username', $username);
    }

    static function getPasswordByEmail(string $email) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'password', 'email', $email);
    }

    static function getPasswordByPhone(string $phone) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'password', 'phone', $phone);
    }

    // functions for Slat column in database
    static function getSlatById(string $id) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'slat', 'id', $id);
    }

    static function getSlatByUsername(string $username) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'slat', 'username', $username);
    }

    static function getSlatByEmail(string $email) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'slat', 'email', $email);
    }

    static function getSlatByPhone(string $phone) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'slat', 'phone', $phone);
    }

    // functions for registration_date column in database
    static function getRegistrationDateById(string $id) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'registration_date', 'id', $id);
    }

    static function getRegistrationDateByUsername(string $username) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'registration_date', 'username', $username);
    }

    static function getRegistrationDateByEmail(string $email) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'registration_date', 'email', $email);
    }

    static function getRegistrationDateByPhone(string $phone) {
        $db = new Database();
        return $db->getColumnValueWhere('users', 'registration_date', 'phone', $phone);
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
