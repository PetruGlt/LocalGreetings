
<div id="eventModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeModal" style="cursor: pointer;">&times;</span>
    <h2>Adauga Eveniment</h2>
    <form method="post" action="<?php echo Config::get("APP_URL"); ?>/event/addEvent"> <!-- todo: add action -->
      <input type="hidden" id="field_id" name="field_id">
      
      <label>Nume eveniment:</label><br>
      <input type="text" name="name" required><br><br>

      <label>Tag-uri eveniment:</label><br>
      <select name="tags[]" multiple style="width: 100%; height: 100px;">
                        <?php foreach($tags as $tag): ?>
                            <option value="<?= $tag["id"] ?>"><?= $tag["name"] ?></option>
                        <?php endforeach; ?>
      </select><br><br>
      
       <label>De la: Data si ora:</label><br>
        <input type="datetime-local" name="event_time_start" required><br><br>

        <label>Pana la: Data si ora:</label><br>
        <input type="datetime-local" name="event_time_end" required><br><br>

        <label>Descriere:</label><br>
        <textarea name="description" rows="2" required maxlength="300"></textarea><br><br>

      <label>Numar maxim participanti:</label><br>
      <input type="number" name="max_participants" min="2" required><br><br>
            
      <input type="submit" style="border-radius: 10px; opacity: 80%; background-color: #40ac43; color: white;" value="Creeaza Eveniment">
    </form>
  </div>
</div>
