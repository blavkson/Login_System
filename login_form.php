<?php

  @include './api/db_config.php';
  include_once './index.php';

  if(isset($_POST['submit']))
  {

    $username = $_POST['username'];
    $pwd = md5($_POST['pwd']);

    $select = "SELECT * FROM users WHERE user_userName	= ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $select);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($results))
    {

        $db_user = $row['user_userName'];

        if(!empty($db_user))
        {
            header('location: ./home.php');
            session_start();
            $_SESSION['userEmail'] = $row['user_email'];
            $_SESSION['username'] = $row['user_userName'];
            

        }

    }else{
        $error[] = 'incorrect student number or password';
    }
    mysqli_stmt_close($stmt);
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
        <h3>login now</h3>
        <input type="text" name="username" placeholder="username">
        <input type="password" name="pwd" placeholder="password">
        <input type="submit" name="submit" value="login now" class="form-btn">
        <p>Don't have an account? <a href="./signup_form.php"> register now</a></p>
    </form>
</div>