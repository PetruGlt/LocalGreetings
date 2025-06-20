<h2>Cereri de prietenie</h2>
<ul>
    <?php foreach ($requests as $req): ?>
        <li>
            <?= htmlspecialchars($req['username']) ?>
            <a href="/LocalGreetings/public/social/acceptRequest/<?= $req['id'] ?>">Acceptă</a>
        </li>
    <?php endforeach; ?>
</ul>
