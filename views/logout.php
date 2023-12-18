<?php
use core\App;
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Выход</title>
    <style>
            body {  background: #111111 }
            section {
                background: #111111;
                border-radius: 1em;
                color: white;
                padding: 1em;
                position: absolute;
                top: 50%;
                left: 50%;
                margin-right: -50%;
                transform: translate(-50%, -50%) 
            }
    </style>
</head>
<body>
    <section>
        <h3>Deautorized</h3>
        <p><a href="<?=App::uri()?>?action=login">Log In</a></p>
    </section>
</body>
</html>
