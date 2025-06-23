function participate(eventId) {
    makeRequest(`/LocalGreetings/public/event/participate/${eventId}`, true)
}

function cancelParticipation(eventId) {
    makeRequest(`/LocalGreetings/public/event/cancel/${eventId}`, false)
}

function makeRequest(url, toggle) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = () => {
        window.location.reload()
    }
    xmlhttp.open("POST", url)
    xmlhttp.send()
}
