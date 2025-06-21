function participate(eventId) {
    makeRequest(`/LocalGreetings/public/event/participate/${eventId}`, true)
}

function cancelParticipation(eventId) {
    makeRequest(`/LocalGreetings/public/event/cancel/${eventId}`, false)
}

function makeRequest(url, toggle) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = () => {
        if(xmlhttp.responseText == "Success")
            toggleButtons(toggle)
    }
    xmlhttp.open("POST", url)
    xmlhttp.send()
}

function toggleButtons(toggleValue) {
    const participateButton = document.getElementById('participate')
    const cancelButton = document.getElementById('cancel')
    if(toggleValue) {
        participateButton.style.display = 'none'
        cancelButton.style.display = 'block'
    } else {
        participateButton.style.display = 'block'
        cancelButton.style.display = 'none'
    }
}