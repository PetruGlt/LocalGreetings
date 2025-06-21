<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo Config::get("APP_URL"); ?>/css/MainStyle.css">
    <title>App</title>
    
</head>
<body>
    
    <?php include_once __DIR__ . '/../partials/navBar.php'; ?>

    <div class="container">
      <?php foreach ($data as $source => $articles): ?>
        <div class="column">
          <h2><?= $source ?></h2>
          <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $item): ?>
              <div class="article">
                <a href="<?= $item['link'] ?>" target="_blank"><?= $item['title'] ?></a>
                <p><?= $item['description'] ?></p>
                <hr>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No articles available for <?= $source ?>.</p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
</body>
</html>
