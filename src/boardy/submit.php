<?php
require_once 'db.php';
require_once 'my-lib/session.php';

startSession();
isEmptySession();

$post = $_POST['post'] ?? '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($post) {
        $stmt = $pdo->prepare(
            'INSERT INTO posts (title, body, author_id) VALUES (?, ?, ?)'
        );
        $stmt->execute(['Сообщение', $post, $_SESSION['user_id']]);
        header('Location: /messages.php');
        exit;
    } else {
        $error = 'Вы ничего не написали';
    }
}

?>

<?php include __DIR__ . '/partials/head.php' ?>
<?php include __DIR__ . '/partials/nav.php' ?>



<main>
    <body>
        <div class="solo-page page-new-post">
            <h1>Новый пост</h1>
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="post">Текст</label>
                <textarea id="post" name="post"
                      rows="5" required></textarea>
                <div class="flex page-new-post-btn">
                    <button type="submit" class="btn-submit">
                        Опубликовать
                    </button>
                    <a href="/messages.php">Отмена</a>
                </div>
            </form>
        </div>
    </body>
</main>


<?php include __DIR__ . '/partials/foot.php' ?>