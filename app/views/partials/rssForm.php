<h2>Generează și trimite fluxul RSS filtrat</h2>


<form method="post" action="/LocalGreetings/public/rss/feed" target="_blank">
    <div class="filter-header">
        <div class="filter-element">
            <label for="fieldIdMail">ID Teren:</label>
            <input type="number" name="fieldId" id="fieldIdMail"><br><br> 
        </div>

        <div class="filter-element">
            <label for="tagNameMail">Tag:</label>
            <input type="text" name="tagName" id="tagNameMail"><br><br>
        </div>
        <div class="user-card" style="none">
            <button type="submit">Vizualizare RSS</button>
        </div>
    </div>
</form>

<br>


<form method="post" action="/LocalGreetings/public/rss/sendFiltered">
    <div class="filter-header">
        <div class="filter-element">
            <label for="fieldIdMail">ID Teren:</label>
            <input type="number" name="fieldId" id="fieldIdMail"><br><br> 
        </div>

        <div class="filter-element">
            <label for="tagNameMail">Tag:</label>
            <input type="text" name="tagName" id="tagNameMail"><br><br>
        </div>
        <div class="user-card" style="none">
            <button type="submit">Trimite pe email</button>
        </div>
    </div>
</form>
