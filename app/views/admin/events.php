<?php

$sql = "SELECT id, name FROM tags";
$tags = DatabaseService::runSelect($sql);

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="<?= Config::get("APP_URL"); ?>/css/MainStyle.css">
</head>
 
<body>


<?php include_once __DIR__ . '/../partials/adminNavBar.php'; ?>

<div class="container">
    <div class="upcoming-events">
        <h1>Evenimente: </h1>
            <div class="filter-header">
                <form method="get" action="<?= Config::get('APP_URL'); ?>/admin/events">
                    <div class="filter-element">
                        <label>Nume:</label>
                        <input type="text" name="name" <?= !empty($filters['name']) ? "value=\"" . $filters['name'] . "\"" : "" ?>>
                    </div>

                    <div class="filter-element">
                        <label>Tag-uri</label>
                        <select name="tags[]" multiple>
                            <option value="0">Toate</option>
                            <?php foreach($tags as $tag): ?>
                                <option 
                                    value="<?= $tag["id"] ?>"
                                    <?php 
                                        if(!empty($filters['tags']))
                                            echo (array_search($tag["id"], $filters['tags']) !== false ? "selected" : "");
                                    ?>>
                                    <?= $tag["name"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-element">
                        <label>De la:</label>
                        <input type="datetime-local" name="event_time_start" <?= !empty($filters['event_time_start']) ? "value=\"" . $filters['event_time_start'] . "\"" : "" ?>>
                    </div>
                    
                    <div class="filter-element">
                        <label>Pana la:</label>
                        <input type="datetime-local" name="event_time_end" <?= !empty($filters['event_time_end']) ? "value=\"" . $filters['event_time_end'] . "\"" : "" ?>>
                    </div>
                    
                    <div class="filter-element">    
                        <label>Max. part.:</label>
                        <input type="number" name="max_participants" min="2" <?= !empty($filters['max_participants']) ? "value=\"" . $filters['max_participants'] . "\"" : "" ?>>
                    </div>
                    <input type="submit" value="Filtreaza">  
                </form>
            </div>
            <div class="event-header">
                <h2>Name</h2>
                <h2>|</h2>
                <h2>Max</h2>
                <h2>|</h2>
                <h2>Time</h2>
                <h2>|</h2>
                <h2>Tags</h2>
                <h2>|</h2>
                <h2>Actions</h2>
            </div>
            <ul id="event-list">
                <?php foreach ($events as $event): ?>
                    <li class="event-card">
                        <a style="text-decoration: none; color: #1e1e2f;"><?= $event['name'] ?></a>
                        <span><?= $event['max_participants'] ?></span>
                        <span><?= $event['event_time_start'] ?> - <?= $event['event_time_end'] ?></span>
                        <span class="tags-section"><?= $event['tags'] ?></span>
                        <div>
                            <form action="<?= Config::get('APP_URL'); ?>/admin/eventDelete/<?= $event['id'] ?>" method="post">
                                <button class="button-error" type="submit">Sterge</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>