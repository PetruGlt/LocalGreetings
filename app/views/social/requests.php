<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cereri de prietenie</title>
    <link rel="stylesheet" href="<?= Config::get('APP_URL'); ?>/css/MainStyle.css">
    <style>
        .request-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
        }

        .request-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            margin: 0.5rem 0;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .request-card span {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .request-card a {
            padding: 0.5rem 1rem;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .request-card a:hover {
            background-color: #218838;
        }

        h2 {
            text-align: center;
            margin-top: 2rem;
        }
    </style>
</head>

<body>

<?php include_once __DIR__ . '/../partials/navBar.php'; ?>

<h2>Cereri de prietenie</h2>

<div class="request-container">
    <?php if (!empty($requests)): ?>
        <?php foreach ($requests as $req): ?>
            <div class="request-card">
                <span><?= htmlspecialchars($req['username']) ?></span>
                <a href="/LocalGreetings/public/social/acceptRequest/<?= $req['id'] ?>">Accepta</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center;">Nu ai cereri de prietenie momentan.</p>
    <?php endif; ?>
</div>

</body>
</html>
