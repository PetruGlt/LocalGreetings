function listEvents(events) {
    const wrapper = document.getElementById('event-list')
    wrapper.innerHTML = ""
    events.forEach(event => {
        const eventElement = createDOMItem(event)
        wrapper.appendChild(eventElement)
    });
}

function getEvents(form) {
    let filters = ""
    if(form) {
        const formData = new FormData(form)
        for(let [key, value] of formData.entries()) {
            if(!!value) {
                filters = filters + key + '=' + value + '&'
                console.log([key, value])
            }
        }
        if(filters.endsWith('&'))
            filters = filters.slice(0, -1);
    }
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = () => listEvents(JSON.parse(xmlhttp.responseText))
    xmlhttp.open("GET", `/LocalGreetings/public/event/getEvents?${filters}`)
    xmlhttp.send()
}

function createDOMItem(event) {
    const listItem = document.createElement('li')
    listItem.classList.add('event-card')

    listItem.addEventListener('click', () => showInMap(event))

    const name = document.createElement('h3')
    name.innerText = event.name
    listItem.appendChild(name)

    const participants = document.createElement('span')
    participants.innerText = event.max_participants
    listItem.appendChild(participants)

    const time = document.createElement('span')
    time.innerText = `${event.event_time_start} - ${event.event_time_end}`
    listItem.appendChild(time)

    const tags = document.createElement('span')
    tags.innerText = event.tags.split(',').join(' ')
    listItem.appendChild(tags)

    const viewEventButton = document.createElement('button')
    viewEventButton.innerText = 'View Event'
    viewEventButton.addEventListener('click', () => {
        window.location.href = `/LocalGreetings/public/event/viewEvent/${event.id}`
    })
    listItem.appendChild(viewEventButton)

    return listItem
}

function showInMap(event) {
    const latlng = [event.lat, event.lon]
    const marker = markerMap.get(Number(event.field_id))
    map.flyTo(latlng, 17, {
        animate: true,
        duration: 1
    })
    marker.openPopup()
}

document.addEventListener('DOMContentLoaded', () => {
    getEvents(null)
})