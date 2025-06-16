
<div id="eventModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <h3>Adauga Eveniment</h3>
    <form method="post" action="<?php echo Config::get("APP_URL"); ?>/event/addEvent"> <!-- todo: add action -->
      <input type="hidden" id="field_id" name="field_id">
      
      <label>Nume eveniment:</label><br>
      <input type="text" name="name" required><br><br>

      <label>Tip eveniment:</label><br>
      <input type="text" name="tags" required><br><br>

       <label>De la: Dată și oră:</label><br>
        <input type="datetime-local" name="event_time_start" required><br><br>

        <label>Pana la: Dată și oră:</label><br>
        <input type="datetime-local" name="event_time_end" required><br><br>

        <label>Descriere:</label><br>
        <textarea name="description" rows="2" required style="width: 100%; border-radius: 10px;" maxlength="100"></textarea><br><br>

      <label>Numar maxim participanti:</label><br>
      <input type="number" name="max_participants" min="2" required><br><br>

      <label for="id">Participi la eveniment?
        <input type="checkbox" name="participate" id="check" value="1" checked>
      </label>
      
      
      <input type="submit" style="border-radius: 10px; opacity: 80%; background-color: #40ac43; color: white;" value="Creeaza Eveniment">
    </form>
  </div>
</div>
