<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8" />
    <title>Profil utilizator - <?= htmlspecialchars($user['username']); ?></title>
    <link rel="stylesheet" href="<?= Config::get("APP_URL"); ?>/css/MainStyle.css">
</head>
<body>

    
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="container">
    <h1>Profilul utilizatorului: <?= htmlspecialchars($user['username']); ?></h1>
    <p>Email: <?= htmlspecialchars($user['email']); ?></p>
    <p>Data înregistrării: <?= htmlspecialchars($user['registration_date']); ?></p>

    <h2>Evenimente la care participă:</h2>
    <?php if (count($events) > 0): ?>
        <ul>
            <?php foreach ($events as $event): ?>
                <li>
                    <?= htmlspecialchars($event['name']); ?> — <?= htmlspecialchars($event['date']); ?> (<?= htmlspecialchars($event['location']); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nu participă la niciun eveniment.</p>
    <?php endif; ?>
    </div>
</body>
</html>
