
<nav>
    <div class="logo">
        Sport<span>IS</span>
    </div>
    <div>
        <a href="<?= Config::get('APP_URL'); ?>/home/mainPage">Acasa</a>
        <a href="<?= Config::get('APP_URL'); ?>/admin/users">Useri</a>
        <a href="<?= Config::get('APP_URL'); ?>/admin/events">Evenimente</a>
        <a href="<?= Config::get('APP_URL'); ?>/admin/tags">Tags</a>
        <form action="<?= Config::get('APP_URL'); ?>/home/logout" method="post" style="display: inline;">
            <button id="logout" type="submit" >Deconectare</button>
        </form>
    </div>
</nav>