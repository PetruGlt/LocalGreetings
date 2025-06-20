
<nav>
    <div class="logo">
        Sport<span>IS</span>
    </div>
    <div>
        <a href="/LocalGreetings/public/home/mainPage">Acasa</a>
        <a href="/LocalGreetings/public/home/mainPage#event-list">Evenimente</a>
        <a href="/LocalGreetings/public/social/index">Social</a>
        <a href="/LocalGreetings/public/home/viewProfile/<?= $_SESSION['user_id']?>">Profil</a>
        <a href="/LocalGreetings/public/home/news">Stiri</a>
        <form action="/LocalGreetings/public/home/logout" method="post" style="display: inline;">
            <button id="logout" type="submit" >Deconectare</button>
        </form>
    </div>
</nav>