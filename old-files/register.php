<?php
include('header.php');
require_once 'config.php';

$username = '';
$username_err = '';
$email = '';
$email_err = '';
$password = '';
$password_err = '';
$confirm_password = '';
$confirm_password_err = '';

// regex email checker 
$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

// start class
class addMember {
    # public var
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $sql;

    # start insert function
    public function insert($username, $email, $confirm_password, $sql)
    {
        global $link;
        if($stmt = mysqli_prepare($link, $sql)) {

            // Set parameters
            $param_username = $username;
			$param_email	= $email;
            $param_password = password_hash($confirm_password, PASSWORD_DEFAULT); // Creates a password hash

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_email);
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // wait 5 second and redirect to login page
                echo '
                <div class="alert alert-success" role="alert">
                    تم التسجيل بنجاح سوف يتم تحويلك خلال <span countFrom="5" id="countDown">5</span> ثواني لتفعيل الحساب
                </div>
                <script>
                    countDown("countDown", "login.php");
                </script>
                ';
            } else {
                echo "حدثة مشكلة . جرب في وقت ثاني";
            }
        }

         // Close statement
         mysqli_stmt_close($stmt);
    }
    # end insert function
    
    # start vaildate function
    public function vaildate($input, $error, $sql)
    {
        global $link;
        // global errors
        global $username_err;
        global $email_err;
        global $password_err;
        global $confirm_password_err;

        if(empty(trim($input))){
            switch($error) {
                case 1: // username empty
                    $username_err = '<p class="text-danger"> ادخل اسم المستخدم . </p>';
                break;

                case 2: // email empty
                    $email_err = '<p class="text-danger"> ادخل البريد الالكتروني. </p>';
                break;
            }
        } else {
            // email && username check 
            if($stmt = mysqli_prepare($link, $sql)) {
                // Set parameters
                $params = trim($input);

                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $params);
                
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "اسم المستخدم موجود .";
                        switch($error) {
                            case 1: // username exsist
                                $username_err = '<p class="text-danger"> اسم المستخدم مستخدم . </p>';
                            break;
            
                            case 2: // email exsist
                                $email_err = '<p class="text-danger"> البريد الالكتروني مستخدم . </p>';
                            break;
                        }
                    } else {
                        $username = trim($input);
                    }
                } else {
                    echo '
                    <div class="alert alert-danger" role="alert">
                        حدثة مشكلة . حاول مرة ثانية !
                    </div>
                    ';
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    # end vaildate function
} // end class

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $member = new addMember;

    $member->vaildate($member->username = $_POST['username'], 1, $member->sql = "SELECT id FROM users WHERE username = ?");
    // email check
    if (preg_match($pattern, $_POST['email']) === 1) { // vaild email !
        $member->vaildate($member->email = $_POST['email'], 2, $member->sql = "SELECT id FROM users WHERE email = ?");
    } else {
        $email_err = '<p class="text-danger"> البريد الالكتروني غير صالح. </p>';
    }

    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = '<p class="text-danger">ادخل كلمة المرور .</p>';     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = '<p class="text-danger">كلمة المرور يجب ان تكون اكثر من ستة خانات</p>';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = '<p class="text-danger"><p class="text-danger">اكد كلمة المرور</p></p>';     
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = '<p class="text-danger"><p class="text-danger">كلمة المرور غير متطابقة.</p></p>';
        }
    }

    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($email_err) && empty($confirm_password_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $member->insert($member->username = $_POST['username'], $member->email = $_POST['email'] ,$member->confirm_password = $_POST['confirm_password'], $member->sql = $sql);
    }
    
    // Close connection
    mysqli_close($link);
    // */
}

?>
 
<div class="form-group">
    <div class="wrapper">
        <h2>سجل معنا</h2>
        <p>يجب ان تكون جميع بياناتك صحيحة !</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">		
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>اسم المستخدم</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>البريد الاكتروني</label>
                <input type="text" name="email"class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>  

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>كلمة المرور</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>تأكيد كلمة المرور </label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="تسجيل" id="validator">
                <input type="reset" class="btn btn-default" value="اعادة">
            </div>
            <p>اذا كان لديك حساب <a href="login.php">سجل الدخول من هنا</a>.</p>
        </form>
    </div>    
 </div>    
<?php include('footer.php'); ?>