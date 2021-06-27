<?php
require_once('sitedef.php');
include_once('header/header.php');

?>
<?php
if(isset($_SESSION['email']))
{
    echo "<script type='text/javascript'>document.location.href='{$base_url}/ispring/student_details.php';</script>";
}
else
{   
    if(isset($_POST))
    {
        if(!empty($_POST['email']) && !empty($_POST['pass'])) 
        {
            $email=$_POST['email'];
            $pass=$_POST['pass'];
            if($email==$app_valid_email && $pass==$app_valid_pass)
            {
                $_SESSION['email']=$email;
                echo "<script type='text/javascript'>document.location.href='{$base_url}/ispring/';</script>";
            } else  {
                echo "<script type='text/javascript'>document.location.href='{$base_url}/ispring/?invalid_login=true';</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <body>
        <main>

            <!-- admin-login-section -->

            <section class="admin-login-section">
                <div class="container">
                    <div class="admin-login">
                        <form action="" method="POST" name="applyform" id="submit">
                            <div class="profile-img-holder">
                                <img src="images/account.png" alt="" />
                            </div>
                            <div class="form-head">
                                <h1>Admin Login</h1>
                            </div>
                            <div class="error-msg" id="error-msg">
<?php
    if (isset($_GET['invalid_login']) && $_GET['invalid_login'] == 'true') {
         echo "please enter a valid email id and password";
    }
?>
                            </div>
                            <div class="email-part">
                                <img src="images/email.png" alt="Email" class="icons-img" />
                                <input type="text" name="email" id="email" placeholder="Email" />
                            </div>
                            
                            <div class="password-part">
                                <img src="images/password.png" alt="Password" class="icons-img" />
                                <input type="password" name="pass" id="pass" placeholder="Password" />
                            </div>
                            <div class="forgot-part">
                                <p><a href="">Forgot your password..?</a></p>
                            </div>
                            <div class="btn-part">
                                <input type="submit" id="login" name="LogForm" value="Submit" class="btn-primary com-hover" />
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>