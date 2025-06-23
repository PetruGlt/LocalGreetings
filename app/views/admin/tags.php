<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rețea Socială</title>
    <link rel="stylesheet" href="<?= Config::get('APP_URL'); ?>/css/MainStyle.css">
</head>

<body>

<?php include_once __DIR__ . '/../partials/adminNavBar.php'; ?>

<div class="container">
    <h1>Taguri</h1>
    <p>Find tag: </p>
    <form method="get" action="<?= Config::get('APP_URL'); ?>/admin/tags">
        <input name="tag" type="text" value="<?= $tagInput ?>"/>
        <button type="submit">Filtreaza</button>
    </form>
    <p>Add tag: </p>
    <form method="post" action="<?= Config::get('APP_URL'); ?>/admin/tags">
        <input name="tag" type="text" required/>
        <button type="submit">Adauga</button>
    </form>
    <ul class="user-list">
        <?php foreach ($tags as $tag): ?>
            <li class="user-card">
                <p style="text-decoration: none; color: #1e1e2f;"><?= htmlspecialchars($tag['name']) ?></p>
                <div>
                    <form action="<?= Config::get('APP_URL'); ?>/admin/tagDelete/<?= $tag['id'] ?>" method="post">
                        <button class="button-error" type="submit">Sterge</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
