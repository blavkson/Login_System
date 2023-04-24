<?php

@include './api/db_config.php';
@include 'index.php';
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/styles.css">
</head>
<body>
<div class="container-co">
        <div class="content">
            <h3>Hi, <span><?php echo $_SESSION['username']?></span></h3>
            <h4>Welcome my Website.</h4>
        </div>
    </div>
</body>
</html>