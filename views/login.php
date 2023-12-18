<?php
use core\App;
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Авторизация</title>
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
    <a href="<?=App::uri()?>/login?action=login"></a>
    </section>
</body>

</html>
