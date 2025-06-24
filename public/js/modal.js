function openEventModal(fieldId) {
  document.getElementById("field_id").value = fieldId; 
  document.getElementById("eventModal").style.display = "block";
}

document.getElementById("closeModal").onclick = function () {
  document.getElementById("eventModal").style.display = "none";
};

window.onclick = function (event) {
  if (event.target == document.getElementById("eventModal")) {
    document.getElementById("eventModal").style.display = "none";
  }
};
