<?php 

require_once 'includes/template.php';
require_once 'includes/regex.php';
require_once 'db/conn.php';

$notice = ['empty' => '', 'username' => '', 'email' => '', 'contact' => '', 'pass' => '', 'cpass' => ''];

if(isset($_POST['register'])){
    $iuser = htmlspecialchars($_POST['username']);
    $iemail = htmlspecialchars($_POST['email']);
    $icontact = htmlspecialchars($_POST['contact']);
    $ipass = htmlspecialchars($_POST['pass']);
    $icpass = htmlspecialchars($_POST['cpass']);

    if(empty($iuser) || empty($iemail) || empty($icontact) || empty($ipass) || empty($icpass)){
        $notice['empty'] = 'All fields are required to continue.';
    }else{
        // validate(pattern, value)
        if(validate("$patterns[username]", $iuser)){
            $username = $iuser;
        }else{
            $notice['username'] = 'Invalid username!';
        }
        if(filter_var($iemail, FILTER_VALIDATE_EMAIL)){
            $email = $iemail;
        }else{
            $notice['email'] = 'Invalid email!';
        }
        if(validate("$patterns[contact]", $icontact)){
            $contact = $icontact;
        }else{
            $notice['contact'] = 'Invalid contact number';
        }
        if(validate("$patterns[pass]", $ipass)){
            $pass = password_hash($ipass, PASSWORD_DEFAULT);
        }else{
            $notice['pass'] = 'Invalid password!';
        }
        if($icpass != $ipass){
            $notice['cpass'] = 'Password mismatch!';
        }

        if(empty($notice['username']) && empty($notice['email']) && empty($notice['contact']) && empty($notice['pass']) && empty($notice['cpass'])){
            if($user->register($username, $email, $contact, $pass)){
                echo 'Your data has been successfully registered to the database.';
            }else{
                echo 'There was an error while saving your data to the database.';
            }
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    
    <main>
        <section>
            <form action="register.php" method="POST" id="reg-form">
                <!-- field(id, label, type) -->
                <!-- button(form, name, value) -->
                <?php field('username', 'Username', 'text'); ?>
                <?php notice("$notice[username]"); ?>
                <?php field('email', 'Email', 'text'); ?>
                <?php notice("$notice[email]"); ?>
                <?php field('contact', 'Contact Number', 'text'); ?>
                <?php notice("$notice[contact]"); ?>
                <?php field('pass', 'Password', 'password'); ?>
                <?php notice("$notice[pass]"); ?>
                <?php field('cpass', 'Confirm Password', 'password'); ?>
                <?php notice("$notice[cpass]"); ?>
                <?php button('reg-form', 'register', 'Create an Account'); ?>
                <?php notice("$notice[empty]"); ?>
            </form>
        </section>
    <main/>

</body>
</html>