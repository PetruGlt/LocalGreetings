<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Rețea Socială</title>
    <link rel="stylesheet" href="<?= Config::get('APP_URL'); ?>/css/MainStyle.css">
    <style>
        .user-list {
            list-style: none;
            padding: 0;
        }

        .user-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 1rem;
            margin-bottom: 0.6rem;
            background-color: #f9f9f9;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .user-card a {
            font-weight: bold;
            color: #1e1e2f;
            text-decoration: none;
        }

        .user-card a:hover {
            text-decoration: underline;
        }

        .user-card form {
            margin: 0;
        }

        .user-card button {
            background-color:rgb(3, 165, 9);
            color: white;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-card button:hover {
            background-color:rgb(24, 235, 31);
        }
    </style>
</head>

<body>

<?php include_once __DIR__ . '/../partials/navBar.php'; ?>

<div class="container">
    <h1>Prietenii tai</h1>
    <ul class="user-list">
        <?php if (!empty($friends)): ?>
            <?php foreach ($friends as $friend): ?>
                <li class="user-card">
                    <a href="../home/viewProfile/<?= htmlspecialchars($friend['id']) ?>"><?= htmlspecialchars($friend['username']) ?></a>
                    <form action="<?= Config::get('APP_URL'); ?>/social/deleteFriend/<?= $friend['id'] ?>" method="post">
                        <button type="submit" style="background-color: red;">Sterge prieten</button>
                    </form>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="user-card">
                <p>Nu ai prieteni inca.</p>
            </li>
        <?php endif; ?>
    </ul>

    <hr>

    <h1>Recomandari</h1>
    <ul class="user-list">
        <?php foreach ($randomUsers as $user): ?>
            <li class="user-card">
                <a href="../home/viewProfile/<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['username']) ?></a>
                <form action="<?= Config::get('APP_URL'); ?>/social/sendRequest/<?= $user['id'] ?>" method="post">
                    <button type="submit">Adauga prieten</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>

    <h1>Toti utilizatorii</h1>
    <ul class="user-list">
        <?php foreach ($allUsers as $user): ?>
            <li class="user-card">
                <a href="../home/viewProfile/<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['username']) ?></a>
                <form action="<?= Config::get('APP_URL'); ?>/social/sendRequest/<?= $user['id'] ?>" method="post">
                    <button type="submit">Adauga prieten</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="<?= Config::get('APP_URL'); ?>/social/pendingRequests" sytle="text-decoration: none;">→ Vezi cereri de prietenie</a>
</div>
</body>
</html>
