function participate(eventId) {
    const baseUrl = window.APP_URL || '';
    makeRequest(`${baseUrl}/event/participate/${eventId}`, true)
}

function cancelParticipation(eventId) {
    const baseUrl = window.APP_URL || '';
    makeRequest(`${baseUrl}/event/cancel/${eventId}`, false)
}

function makeRequest(url, toggle) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = () => {
        window.location.reload()
    }
    xmlhttp.open("POST", url)
    xmlhttp.send()
}
