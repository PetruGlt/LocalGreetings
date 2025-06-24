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
     <div class="filter-header">
        <form method="post" action="<?= Config::get("APP_URL"); ?>/event/update/<?= $event['id'] ?>">
            <div class="filter-element">
                <p><strong>Descriere:</strong></p>
                <input name="description" type="text" value="<?= htmlspecialchars($event['description']) ?>" required />
            </div>
            <div class="filter-element">
                <p><strong>Incepe:</strong></p>
                <input name="event_time_start" type="datetime-local" value="<?= $event['event_time_start'] ?>" required />
            </div>
            <div class="filter-element">
                <p><strong>Se termina:</strong></p>
                <input name="event_time_end" type="datetime-local" value="<?= $event['event_time_end'] ?>" required />
            </div>
            <div class="filter-element">
                <p><strong>Nr maxim participanti:</strong></p>
                <input name="max_participants" type="number" value="<?= $event["max_participants"] ?>" required />
            </div>
            <div class="filter-element">
                <p><strong>Tags:</strong>
                    <?php
                        echo !empty($eventTags) ? implode(", ", $eventTags) : "";
                    ?>
                </p>
            </div>
            <div class="filter-element">
            <button type="submit" class="button-success">Update</button>
        </form>
        <form action="<?= Config::get('APP_URL'); ?>/event/deleteEvent/<?= $event['id'] ?>" method="post">
            <button type="submit" class="button-error">Șterge eveniment</button>
        </form>
        <div class="filter-element">
</div>
    
</body>
</html>