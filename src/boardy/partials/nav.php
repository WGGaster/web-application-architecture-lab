<?php
$is_logged = !empty($_SESSION['user_id']);
$user_name = $_SESSION['user_name'] ?? '';
?>
<header>
    <nav class="flex nav">
        <div class="flex nav-left">
            <a href="/" class="brand">Boardy</a>
            <div class="all-posts" ><a href="/messages.php">Все посты</a></div>
        </div>
        <?php if ($is_logged): ?>
            <div class="flex nav-right logged">
                <a href="/submit.php">Добавить пост</a>
                <span>Привет, <?= htmlspecialchars($user_name) ?>!</span>
                <a href="/logout.php">Выйти</a>
            </div>
        <?php else: ?>
            <div class="flex nav-right not-logged">
                <a href="/login.php">Вход</a>
                <a href="/register.php">Регистрация</a>
            </div>
        <?php endif ?>
    </nav> 
</header>
   
