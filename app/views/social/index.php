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
    <h1>Prietenii tai</h1>
    <ul class="user-list">
        <?php if (!empty($friends)): ?>
            <?php foreach ($friends as $friend): ?>
                <li class="user-card">
                    <a style="text-decoration: none; color: #1e1e2f;" href="../home/viewProfile/<?= htmlspecialchars($friend['id']) ?>"><?= htmlspecialchars($friend['username']) ?></a>
                    <form action="<?= Config::get('APP_URL'); ?>/social/deleteFriend/<?= $friend['id'] ?>" method="post">
                        <button type="submit" style="background-color: red;">Sterge prieten</button>
                    </form>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="user-card">
                <p>Nu ai prieteni inca.</p>
            </li>
        <?php endif; ?>
    </ul>

    <hr>

    <h1>Recomandari</h1>
    <ul class="user-list">
        <?php foreach ($randomUsers as $user): ?>
            <li class="user-card">
                <a style="text-decoration: none; color: #1e1e2f;" href="../home/viewProfile/<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['username']) ?></a>
                <form action="<?= Config::get('APP_URL'); ?>/social/sendRequest/<?= $user['id'] ?>" method="post">
                    <button type="submit">Adauga prieten</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>

    <h1>Toti utilizatorii</h1>
    <form method="get" action="<?= Config::get('APP_URL'); ?>/social/index">
        <div class="filter-header">
        <div class="filter-element">
            <input name="username" type="text" value="<?= $username ?>"/>
            <button type="submit" style="background-color:rgb(11, 120, 223); color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 4px;cursor: pointer;">Filtreaza</button>
        </div>
        </div>
    </form>
    <ul class="user-list">
        <?php foreach ($allUsers as $user): ?>
            <li class="user-card">
                <a style="text-decoration: none; color: #1e1e2f;" href="../home/viewProfile/<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['username']) ?></a>
                <form action="<?= Config::get('APP_URL'); ?>/social/sendRequest/<?= $user['id'] ?>" method="post">
                    <button type="submit">Adauga prieten</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="<?= Config::get('APP_URL'); ?>/social/pendingRequests" sytle="text-decoration: none;">→ Vezi cereri de prietenie</a>

</div>

</body>
</html>
