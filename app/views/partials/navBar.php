
<nav>
    <div class="logo">
        Sport<span>IS</span>
    </div>
    <div>
        <a href="<?= Config::get('APP_URL'); ?>/home/mainPage">Acasa</a>
        <a href="<?= Config::get('APP_URL'); ?>/home/mainPage#event-list">Evenimente</a>
        <a href="<?= Config::get('APP_URL'); ?>/social/index">Social</a>
        <a href="<?= Config::get('APP_URL'); ?>/home/viewProfile/<?= $_SESSION['user_id']?>">Profil</a>
        <a href="<?= Config::get('APP_URL'); ?>/home/news">Stiri</a>
        <form action="<?= Config::get('APP_URL'); ?>/home/logout" method="post" style="display: inline;">
            <button id="logout" type="submit" >Deconectare</button>
        </form>
    </div>
</nav>