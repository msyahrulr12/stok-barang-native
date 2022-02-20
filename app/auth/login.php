<?php

require_once dirname(dirname(__DIR__)).'/system.php';

// cek apakah ada submit form atau tidak
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // cek login
    $login = login($username, $password);

    if ($login) {
        // redirect to dashboard
        redirect('../dashboard.php');
    } else {
        echo 'Username / Password wrong!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        #login-page {
            padding: 50px;
            display: flex;
            justify-content: center;
        }
        
        #login-page form {
            border: 1px solid black;
            width: 30em;
            padding: 15px 20px;
        }

        #login-page form input[type="submit"] {
            padding: 10px 30px;
            border: 0;
            display: block;
            text-align: center;
            margin: auto;
        }
    </style>
</head>
<body>
    <div id="login-page">
        <form action="" method="POST">
            <h3>Halaman Login</h3>
            <hr>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username">
            </div>
            <div style="margin-top: 20px;">
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>
            <input type="submit" style="margin-top: 20px;" value="Login" name="submit">
        </form>
    </div>
</body>
</html>