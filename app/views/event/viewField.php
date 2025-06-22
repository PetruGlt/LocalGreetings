<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenimente</title>
    <link rel="stylesheet" href="<?php echo Config::get('APP_URL'); ?>/css/MainStyle.css">
</head>
<body>
    
    <?php include_once __DIR__ . '/../partials/navBar.php'; ?>

    <?php include_once __DIR__ . '/../partials/errorDiv.php'; ?>
    <div class="container">
     <h1><?= $title; ?></h1>
    <?php foreach ($events as $event): ?>
        <h1><a style="text-decoration: none; color: #1e1e2f;" href="../viewEvent/<?= $event['id'] ?>"><?= htmlspecialchars($event['name']) ?></a></h1>
        <p><strong>Descriere:</strong> <?= htmlspecialchars($event['description']) ?></p>
        <p><strong>Incepe:</strong> <?= $event['event_time_start'] ?></p>
        <p><strong>Se termina:</strong> <?= $event['event_time_end'] ?></p>
        <p><strong>Teren:</strong> <?= $fieldId ?></p>
        <p><strong>Nr maxim participanti:</strong> <?= $event["max_participants"] ?></p>
        <p><strong>Creator:</strong> <?= $event['creator_username'] ?></p>
        <p><strong>Tags:</strong>
            <?php
            $tags = $eventTags[$event['id']] ?? [];
            echo implode(", ", array_map('htmlspecialchars', $tags));
            ?>
        </p>
        <hr>
    <?php endforeach; ?>
</div>
    
</body>
</html>