<?php

include('header.php');
require_once 'config.php';
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = '<p class="text-danger"> ادخل اسم المستخدم . </p>';
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "اسم المستخدم موجود .";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "حدثة مشكلة . حاول مرة ثانية";
            }
        }
		 
        // Close statement
        mysqli_stmt_close($stmt);
		
    }
	// Validate email
		if(empty(trim($_POST["email"]))){
			$email_err = '<p class="text-danger"> ادخل البريد الاكتروني </p>';
		} else{
			// Prepare a select statement
			$sql = "SELECT id FROM users WHERE email = ?";
			
			if($EnailStmt = mysqli_prepare($link, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($EnailStmt, "s", $param_email);
				
				// Set parameters
				$param_email = trim($_POST["email"]);
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($EnailStmt)){
					/* store result */
					mysqli_stmt_store_result($EnailStmt);
					
					if(mysqli_stmt_num_rows($EnailStmt) == 1){
						$email_err = "البريد الاكتروني موجود .";
					} else{
						$email = trim($_POST["email"]);
					}
				} else{
					echo "حدثة مشكلة . حاول مرة ثانية";
				}
			}
			 
			// Close statement
			mysqli_stmt_close($EnailStmt);
			
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
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = '<p class="text-danger"><p class="text-danger">كلمات المرور غير متشابهة .</p></p>';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($email_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_email);
            
            // Set parameters
            $param_username = $username;
			$param_email	= $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "حدثة مشكلة . جرب في وقت ثاني";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>اذا كان لديك حساب <a href="login.php">سجل الدخول من هنا</a>.</p>
        </form>
    </div>    
 </div>    
<?php

include('footer.php');

?>