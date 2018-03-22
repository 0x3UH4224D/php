<?php
<<<<<<< HEAD
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
=======
namespace CTG\Core;
namespace CTG\Pages;

require "./includes/Core/Page.php";
require "./includes/Widgets/Navbar.php";
require "./includes/Core/Validation.php";
require "./includes/Core/Database.php";


use \CTG\Core\Page;
use \CTG\Core\Database;
use \CTG\Widgets\Navbar;


class User extends Page {
  protected $id;
  protected $username;
  protected $email;
  protected $createdAt;
  protected $permissions;
  protected $confirm_email;
  protected $password;
  protected $confirm_password;

  function __construct() {
    if ($_SERVER['REQUEST_URI'] == '/php/register.php') {
      Page::__construct('تسجيل حساب', 'ar');
    } elseif ($_SERVER['REQUEST_URI'] == '/php/login.php') {
      Page::__construct('تسجيل دخول', 'ar');
    }
  }

  protected function header() {
      $header = Page::header();
      $navbar = new Navbar();
      $links = array(
        "الرئيسية" => "/php/index.php"
      );

      if ($_SERVER['REQUEST_URI'] == '/php/register.php') {
        $links["تسجيل الدخول"] = "/php/login.php";
      } elseif ($_SERVER['REQUEST_URI'] == '/php/login.php') {
        $links["تسجيل"] = "/php/register.php";
      }
      
      $html = $navbar->createLinks($links);
      return $header . "\n" . $navbar->render($html);
  }

  protected function body() {
    if ($_SERVER['REQUEST_URI'] == '/php/register.php') {
      return "<br><br>
      <div>
        <form method='POST' action='/php/register.php'>
          <input type='text' name='username' placeholder='Username'><br><br>
          <input type='text' name='email' placeholder='Email'><br><br>
          <input type='text' name='confirm_email' placeholder='Confirm Email'><br><br>
          <input type='password' name='password' placeholder='Password'><br><br>
          <input type='password' name='confirm_password' placeholder='Password Confirm'><br><br>
          <input type='submit' value='Send'>
        </form>
      </div>";
    } elseif ($_SERVER['REQUEST_URI'] == '/php/login.php') {
      return "<br><br>
      <div>
        <form method='POST' action='/php/login.php'>
          <input type='text' name='username' placeholder='Username'><br><br>
          <input type='password' name='password' placeholder='Password'><br><br>
          <input type='submit' value='Send'>
        </form>
      </div>";
    }
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
