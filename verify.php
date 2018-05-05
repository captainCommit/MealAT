<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>NETTUTS > Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="header">
    </div>      
    <div id="wrap">
        <?php
            $host="localhost";
            $dbname = "data";
            $dbusername = "root";
            $dbpassword = "";
            $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                // Verify data
                $email = mysqli_escape_string($_GET['email']); // Set email variable
                $hash = mysqli_escape_string($_GET['hash']); // Set hash variable
                             
                $search = mysqli_query("SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysqli_error()); 
                $match  = mysqli_num_rows($search);
                             
                if($match > 0){
                    // We have a match, activate the account
                    mysqli_query("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysqli_error());
                    echo 'Your account has been activated, you can now login';
                }else{
                    // No match -> invalid url or account has already been activated.
                    echo 'The url is either invalid or you already have activated your account.';
                }
                             
            }else{
                // Invalid approach
                echo 'Invalid approach, please use the link that has been send to your email.';
            }     
        ?>
    </div> 
</body>
</html>