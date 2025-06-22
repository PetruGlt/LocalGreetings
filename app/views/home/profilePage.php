<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil utilizator - <?= htmlspecialchars($user['username']); ?></title>
    <link rel="stylesheet" href="<?= Config::get("APP_URL"); ?>/css/MainStyle.css">
   
</head>
<body>

    
<?php include_once __DIR__ . '/../partials/navBar.php'; ?>

    <div class="container">
    <h1>Profilul utilizatorului: <?= htmlspecialchars($user['username']); ?></h1>
    <p><strong>Email: </strong><a style="text-decoration: none; color:rgb(48, 48, 203);" href="mailto:someone@example.com"><?= htmlspecialchars($user['email']); ?></a></p>
    <p><strong>Data inregistrarii:</strong> <?= htmlspecialchars($user['registration_date']); ?></p>
        <h2>Participant la:</h2>
        <ul class="event-list">
            <?php if(!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <li class="event-card">
                        <a style="text-decoration: none; color: #1e1e2f;" href="../../event/viewEvent/<?= $event['id'] ?>"><?= htmlspecialchars($event['name']); ?></a>
                        <p><?= htmlspecialchars($event['event_time_start']); ?> : <?= htmlspecialchars($event['event_time_end']); ?> 
                        <p><a style="text-decoration: none; color: #1e1e2f;" href="../../event/viewField/<?= $event['field_id']?>"><?= htmlspecialchars($event['field_id']); ?></a></p>
                </li>
                <?php endforeach; ?>   
            <?php else: ?>
                <p>Nu participă la niciun eveniment.</p>
            <?php endif; ?>
        </ul>

        <h2>Evenimente create:</h2>
        <ul class="event-list">
            <?php if(!empty($createdEvents)): ?>
                <?php foreach ($createdEvents as $event): ?>
                    <li class="event-card">
                        <a style="text-decoration: none; color: #1e1e2f;" href="../../event/viewEvent/<?= $event['id'] ?>"><?= htmlspecialchars($event['name']); ?></a>
                        <p><?= htmlspecialchars($event['event_time_start']); ?> : <?= htmlspecialchars($event['event_time_end']); ?> 
                        <p><a style="text-decoration: none; color: #1e1e2f;" href="../../event/viewField/<?= $event['field_id']?>"><?= htmlspecialchars($event['field_id']); ?></a></p>
                        <?php if ($user['id'] == $_SESSION['user_id']): ?>
                            <form action="<?= Config::get('APP_URL'); ?>/event/deleteEvent/<?= $event['id'] ?>" method="post">
                                <button type="submit" style="background-color: red;">Șterge eveniment</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nu a creat niciun eveniment.</p>
            <?php endif; ?>
        </ul>    
    
        <h2>Prieteni:</h2>
        
        <ul class="user-list">
            <?php if(!empty($friends)): ?>
                <?php foreach ($friends as $friend): ?>
                    <?php
                        $createdDate = new DateTime($friend['created_at']);
                        $today = new DateTime();
                        $interval = $today->diff($createdDate);
                        $days = $interval->days;
                    ?>
                    <li class="user-card">
                        <a style="text-decoration: none; color: #1e1e2f;" href="../../home/viewProfile/<?= $friend['id'] ?>"><?= $friend['username']; ?></a>
                        <p>Prieteni de: <?= $days ?> zile ( din <?= $createdDate->format('Y-m-d') ?>)</p>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nu are prieteni.</p>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
