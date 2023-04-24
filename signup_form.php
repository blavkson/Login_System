<?php

  @include './api/db_config.php';
  include_once './index.php';

  if(isset($_POST['submit']))
  {

    $fname = $_POST["fname"];
    $surname = $_POST["lname"];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = md5($_POST['pwd']);
    $pwdRepeat = md5($_POST['pwdRepeat']);

    $select = "SELECT * FROM users WHERE user_userName	= ? OR user_email = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $select);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);

    if(mysqli_fetch_row($results) > 0)
    {
        $error[] = 'user already exists';
        mysqli_stmt_close($stmt);
    }else{
        if(empty($fname) || empty($surname) || empty($username) || empty($email) || empty($pwd) || empty($pwdRepeat))
        {
            $error[] = 'empty fields';
        }else{
            if($pwd != $pwdRepeat)
            {
                $error[] = 'password not matched';
            }else{
                $insert = "INSERT INTO users(user_firstName, user_lastName,	user_userName,	user_email,	user_pwd) VALUES(?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $insert);
                mysqli_stmt_bind_param($stmt, "sssss", $fname, $surname, $username, $email, $pwd);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                header('location: ./login_form.php?signup=sucess');
            }
        }

    }

  };

?>

<link rel="stylesheet" href="./Styles/styles.css">

<div class="form-container">
    <form action="" method="post">
    <?php
        if(isset($error))
        {
            foreach($error as $error)
            {
                echo '<span class="error-msg">'.$error.'</span';
            };
        };
        ?>
        <h3>register now</h3>
        <input type="text" name="fname" placeholder="first name">
        <input type="text" name="lname" placeholder="last name">
        <input type="text" name="username" placeholder="username">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="pwd" placeholder="password">
        <input type="password" name="pwdRepeat" placeholder="confirm password">
        <input type="submit" name="submit" value="register now" class="form-btn">
        <p>Already have an account? <a href="./login_form.php"> login now</a></p>
    </form>
</div>