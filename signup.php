<!DOCTYPE html>
<?php
    $name = $_POST['signup-username'];
    $email = $_POST['signup-email'];
    $pass1 = $_POST['signup-password'];
    $pass2 = $_POST['signup-password-conf'];
    $acc = $_POST['accept-terms'];
    $host="localhost";
    $dbname = "data";
    $dbusername = "root";
    $dbpassword = "";
    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
    if (preg_match('/[\'^£$%&*()}{@#~?><>,;.|=_+¬-]/', $name)==true)
    {
        $msg = 'Username cannot have special charecters<br>';
    }
    else
    {
        if(strcmp($pass1,$pass2)!= 0 )
            echo("<script>alert('Passwords Should Be Same');</script>");
        else
        {
            $password = $pass1;
            $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
            $hash = md5( rand(0,1000) );
            mysqli_query($conn,"INSERT INTO accounts (username, password, email, hash) VALUES(
                '". mysqli_real_escape_string($conn,$name) ."', 
                '". mysqli_real_escape_string($conn,md5($password)) ."', 
                '". mysqli_real_escape_string($conn,$email) ."', 
                '". mysqli_real_escape_string($conn,$hash) ."') ") or die(mysqli_error($conn));
                echo("<script>alert('Your account has been made, <br> Please verify it by clicking the activation link that has been send to your email.')</script>");
                $to      = $email;
                $subject = 'Signup | Verification'; 
                $message = '
                 
                Thanks for signing up!
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                 
                ------------------------
                Username: '.$name.'
                Password: '.$password.'
                ------------------------
                 
                Please click this link to activate your account:
                http://localhost/verify.php?email='.$email.'&hash='.$hash.'
                 
                ';                   
                $headers = 'From:root@localhost.com' . "\r\n"; // Set from headers
                mail($to, $subject, $message, $headers); // Send our email
        }
    }           
?>    
</body>
</html>
