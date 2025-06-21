<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Evenimente</title>
    <link rel="stylesheet" href="<?php echo Config::get('APP_URL'); ?>/css/MainStyle.css">
    <script src="<?= Config::get("APP_URL"); ?>/js/event.js" defer></script>
</head>
<body>
    
    <?php include_once __DIR__ . '/../partials/navBar.php'; ?>

    <?php include_once __DIR__ . '/../partials/errorDiv.php'; ?>
    <div class="container">
     <h1><?= $event["name"] ?></h1>
        <p><strong>Descriere:</strong> <?= htmlspecialchars($event['description']) ?></p>
        <p><strong>Incepe:</strong> <?= $event['event_time_start'] ?></p>
        <p><strong>Se termina:</strong> <?= $event['event_time_end'] ?></p>
        <p><strong>Teren:</strong> <?= $fieldId ?></p>
        <p><strong>Nr maxim participanti:</strong> <?= $event["max_participants"] ?></p>
        <p><strong>Creator:</strong> <?= $event['creator_username'] ?></p>
        <p><strong>Tags:</strong>
            <?php
                echo implode(", ", $eventTags);
            ?>
        </p>
        <button 
            id="participate" 
            <?= $isParticipant ? "style=\"display: none\"" : "" ?>
            onclick="participate(<?= $event['id'] ?>)">
            Participa
        </button>
        <button 
            id="cancel" 
            <?= !$isParticipant ? "style=\"display: none\"" : "" ?> 
            onclick="cancelParticipation(<?= $event['id'] ?>)">
            Anuleaza participarea
        </button>
        <h2>Participanti</h2>
        <ul id="participant-list">
            <?php foreach($participants as $participant): ?>
                <li class="participant-card">
                    <h3><?= $participant['username'] ?></h3>
                    <button>
                        <a href="<?= Config::get("APP_URL"); ?>/home/viewProfile/<?= $participant['id'] ?>">
                            Vezi profil
                        </a>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
</div>
    
</body>
</html>