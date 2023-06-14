<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/assets/dist/style.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
    <title><?= $title ?? 'Custom Framework' ?></title>
</head>
<body class="loginBody">
<main><?= $main ?? null ?></main>
<footer>&copy;<?= date('Y') ?> Custom Framework</footer>
</body>
</html>
