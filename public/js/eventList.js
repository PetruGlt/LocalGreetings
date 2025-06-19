function listEvents(events) {
    const wrapper = document.getElementById('event-list')
    events.forEach(event => {
        const eventElement = createDOMItem(event)
        wrapper.appendChild(eventElement)
    });
}

function getEvents() {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = () => listEvents(JSON.parse(xmlhttp.responseText))
    xmlhttp.open("GET", "/LocalGreetings/public/event/getEvents")
    xmlhttp.send()
}

function createDOMItem(event) {
    const listItem = document.createElement('li')

    const name = document.createElement('span')
    name.innerText = event.name
    listItem.appendChild(name)

    const participants = document.createElement('span')
    participants.innerText = event.max_participants
    listItem.appendChild(participants)

    return listItem
}

document.addEventListener('DOMContentLoaded', getEvents)