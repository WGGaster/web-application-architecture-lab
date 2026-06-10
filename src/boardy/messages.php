<?php
require_once 'db.php';
require_once 'my-lib/session.php';

startSession();
isEmptySession();


$stmt = $pdo->query(
    'SELECT posts.body, users.name, posts.created_at
     FROM posts
     JOIN users ON posts.author_id = users.id
     ORDER BY posts.created_at DESC'
);
$messages = $stmt->fetchAll();
?>

<?php 
function getRelativeTime($dateInput) {
    date_default_timezone_set('Asia/Yekaterinburg');
    $time = is_numeric($dateInput) ? $dateInput : strtotime($dateInput);
    $diff = time() - $time;

    if ($diff < 1) {
        return 'только что';
    }

    $condition = array(
        12 * 30 * 24 * 60 * 60 => array('год', 'года', 'лет'),
        30 * 24 * 60 * 60      => array('месяц', 'месяца', 'месяцев'),
        24 * 60 * 60           => array('день', 'дня', 'дней'),
        60 * 60                => array('час', 'часа', 'часов'),
        60                     => array('мин', 'мин', 'мин'),
        1                      => array('сек', 'сек', 'сек')
    );

    foreach ($condition as $secs => $str) {
        $d = $diff / $secs;
        if ($d >= 1) {
            $t = round($d);
            return $t . ' ' . getPluralForm($t, $str[0], $str[1], $str[2]) . ' назад';
        }
    }
}

function getPluralForm($number, $form1, $form2, $form5) {
    $n = abs($number) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
}
?>

<?php include __DIR__ . '/partials/head.php' ?>
<?php include __DIR__ . '/partials/nav.php' ?>

<main>
  <div class="posts-container">
  <h1>Все посты</h1>
  <?php if (empty($messages)): ?>
    <p>Постов пока нет.</p>
  <?php else: ?>
    <ul class="flex list-posts">
    <?php foreach ($messages as $msg): ?>
      <li class="flex post">
        <div class="post-left">
          <h2 class="post-author-name">
            <?= htmlspecialchars($msg['name']) ?>
          </h2>
          <p class="post-content">
            <?= htmlspecialchars($msg['body']) ?>
          </p>
        </div>
        <div class="post-right">
          <span class="post-date">
            <?=  htmlspecialchars(getRelativeTime($msg['created_at'])) ?>
          </span>
        </div>
      </li>
    <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</main>


<?php include __DIR__ . '/partials/foot.php' ?>
