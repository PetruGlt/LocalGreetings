<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo Config::get("APP_URL"); ?>/css/MainPage.css">
    <title>App</title>
    
</head>
<body>
    
<nav>
    <div class="logo">
            Sport<span>IS</span>
        </div>
        <div>
            <a href="/LocalGreetings/public/home/mainPage">Acasa</a>
            <a href="#events">Evenimente</a>
            <a href="#social">Social</a>
            <a href="#profile">Profil</a>
            <a href="../home/news">Stiri</a>
            <form action="../home/logout" method="post" style="display: inline;">
                <button id="logout" type="submit" >Deconectare</button>
            </form>
        </div>
    </nav>

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
