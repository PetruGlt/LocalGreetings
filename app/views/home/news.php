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
        <a href="../home/mainPage">Home</a>
        <a href="#about">Events</a>
        <a href="#contact">Social</a>
        <a href="#login">Profile</a>
        <a href="../home/news">News</a>
        <form action="../home/logout" method="post" style="display: inline;">
            <button id="logout" type="submit" >Logout</button>
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
