<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Evenimente</title>
    <link rel="stylesheet" href="<?php echo Config::get('APP_URL'); ?>/css/MainStyle.css">
</head>
<?php include_once __DIR__ . '/../partials/navBar.php'; ?>
<h2>Prieteni</h2>
<ul>
    <?php foreach ($friends as $friend): ?>
        <li><?= htmlspecialchars($friend['username']) ?></li>
    <?php endforeach; ?>
</ul>

<a href="/LocalGreetings/public/social/pendingRequests">Vezi cereri de prietenie</a>
