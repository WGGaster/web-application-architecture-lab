<?php
file_put_contents(__DIR__ . '/debug.log', "Метод: " . ($_SERVER['REQUEST_METHOD'] ?? 'нет') . "\n", FILE_APPEND);
?>


<?php 
    require_once 'db.php';
    require_once 'my-lib/session.php';

    startSession();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $pdo->prepare('select id from users where email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Запись существует уже";
        } else {
            $stmt = $pdo->prepare(
                'insert into users (name, email, password_hash) values (?, ?, ?)'
            );
            $stmt->execute([$user_name, $email, $password]);
            $new_id = $pdo->lastInsertId();
            $_SESSION['user_id'] = $new_id;
            $_SESSION['user_name'] = $user_name;
            header('Location: /messages.php');
            exit;
        }
    }
?>


<?php include __DIR__ . '/partials/head.php' ?>
<?php include __DIR__ . '/partials/nav.php' ?>

<main>
    <body>
        <div class="solo-page">
            <h1>Регистрация</h1>
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="btn-register">Зарегистрироваться</button>
            </form>
            <p>Уже есть аккаунт? <a href="/">Войти</a></p>
        </div>
    </body>
</main>

<?php include __DIR__ . '/partials/foot.php' ?>

