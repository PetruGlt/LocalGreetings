<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenimente</title>
    <link rel="stylesheet" href="<?php echo Config::get('APP_URL'); ?>/css/MainStyle.css">
    <script src="<?= Config::get("APP_URL"); ?>/js/event.js" defer></script>
     <style>
        .button-success {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-error {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    </style>
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
                echo !empty($eventTags) ? implode(", ", $eventTags) : "";
            ?>
        </p>
        <?php if(!$isOwnEvent): ?>
            <?php if(!$hasStarted): ?>
                <button 
                    id="participate" 
                    class="button-success"
                    <?= $isParticipant ? "style=\"display: none\"" : "" ?>
                    onclick="participate(<?= $event['id'] ?>)">
                    Participa
                </button>
                <button 
                    id="cancel" 
                    class="button-error"
                    <?= !$isParticipant ? "style=\"display: none\"" : "" ?> 
                    onclick="cancelParticipation(<?= $event['id'] ?>)">
                    Anuleaza participarea
                </button>
            <?php endif; ?>
        <?php else: ?>
            <button class="button-success">
                <a href="<?= Config::get("APP_URL"); ?>/event/editEvent/<?= $event['id'] ?>">
                    Editeaza evenimentul
                </a>
            </button>
        <?php endif; ?>
        <h2>Participanti</h2>
        <ul class="user-list">
            <?php if (empty($participants)): ?>
                <p>Nu sunt participanti la acest eveniment.</p>
            <?php else: ?>
            <?php foreach($participants as $participant): ?>
                <li class="user-card">
                    <h3><a style="text-decoration: none; color: #1e1e2f;" href="<?= Config::get("APP_URL"); ?>/home/viewProfile/<?= $participant['id'] ?>"><?= $participant['username'] ?></a></h3>
                    <p>Data inregistrarii: <?= $participant['join_date'] ?></p>
                </li>
            <?php endforeach; ?>
            <?php endif; ?>
        </ul>
</div>
    
</body>
</html>