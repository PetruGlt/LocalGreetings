<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rețea Socială</title>
    <link rel="stylesheet" href="<?= Config::get('APP_URL'); ?>/css/MainStyle.css">
   
</head>

<body>

<?php include_once __DIR__ . '/../partials/navBar.php'; ?>

<div class="container">
    <h1>Toti utilizatorii</h1>
    <p>Username: </p>
    <form method="get" action="<?= Config::get('APP_URL'); ?>/admin/users">
        <input name="username" type="text" value="<?= $username ?>"/>
        <button type="submit">Filtreaza</button>
    </form>
    <ul class="user-list">
        <?php foreach ($allUsers as $user): ?>
            <li class="user-card">
                <a style="text-decoration: none; color: #1e1e2f;" href="<?= Config::get('APP_URL'); ?>/home/viewProfile/<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['username']) ?></a>
                <div>
                    <?php if($user['is_banned']): ?>
                        <form action="<?= Config::get('APP_URL'); ?>/admin/ban/<?= $user['id'] ?>" method="post">
                            <button class="button-error" type="submit">Ban</button>
                        </form>
                    <?php else: ?>
                        <form action="<?= Config::get('APP_URL'); ?>/admin/unban/<?= $user['id'] ?>" method="post">
                            <button class="button-success" type="submit">Unban</button>
                        </form>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
