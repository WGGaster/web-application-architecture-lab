<?php
    require_once 'db.php';
    require_once 'my-lib/session.php';

    startSession();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare(
            'select id, name, password_hash from users where email = ?'
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: /messages.php');
            exit;
        } else {
            $error = "Неверный пароль или логин";
        }
    }
?>

<?php include __DIR__ . '/partials/head.php' ?>
<?php include __DIR__ . '/partials/nav.php' ?>

<main>
    <body>
        
        <div class="solo-page">
            <h1>Вход</h1>
            <span class="error-message">
                <?= htmlspecialchars($error) ?>
            </span>
            <form method="POST" action="">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
                <label for="password">Пароль</label>
                <input type="text" id="password" name="password" required>
                <button type="register" class="btn-login">Войти</button>
            </form>
            <p>Нет аккаунта? <a href="/">Регистрация</a></p>
        </div>
    </body>
</main>


<?php include __DIR__ . '/partials/foot.php' ?>