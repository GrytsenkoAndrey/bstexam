<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $data['title'] ?></title>
    <link rel="stylesheet" href="<?= URLROOT ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= URLROOT ?>css/bootstrap-grid.css">
    <link rel="stylesheet" href="<?= URLROOT ?>css/bootstrap-reboot.css">
    <link rel="stylesheet" href="<?= URLROOT ?>css/table.css">
    <link rel="stylesheet" href="<?= URLROOT ?>css/custom.css">
</head>
<body>

<nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="nav-link" href="<?= URLROOT ?>user/contacts">Контакты</a>
        <a class="nav-link" href="<?= URLROOT ?>user/favorite">Избранные</a>
        <a class="nav-link" href="<?= URLROOT ?>user/register">Регистрация</a>
        <a class="nav-link" href="<?= URLROOT ?>user/login">Вход</a>
        <a class="nav-link" href="<?= URLROOT ?>user/logout">Выход</a>
    </div>
</nav>


<main class="container">