document.getElementById('create-form').addEventListener('submit', createEvent);

function createEvent(e) {
    e.preventDefault();
    let event_date = document.getElementById('eventDate').value;
    let event_time = document.getElementById('eventTime').value;
    let event_description = document.getElementById('eventDescription').value;
    let sport = document.getElementById('sport-select').value;
    let location = document.getElementById('location-select').value;
    let team1 = document.getElementById('team1-select').value;
    let team2 = document.getElementById('team2-select').value;

    let params = `event_date=${event_date}&event_time=${event_time}&event_description=${event_description}&sport=${sport}&location=${location}`;

    let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        let response = JSON.parse(this.responseText);
        if (response.status === 'success') {
            let event_id = response.event_id;

            assignTeams(event_id, team1, team2);
        } else {
            alert('Error:' + response.message);
        }
    };
    xhttp.open('POST', '../components/create_event.php');
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(params);
}

function assignTeams(event_id, team1, team2) {
    let params = `event_id=${event_id}&team1=${team1}&team2=${team2}`;

    let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        let response = JSON.parse(this.responseText);

        if (response.status === 'success') {
            alert('Event created and teams assigned successfully!');
            document.getElementById('redirect-message').style.display = 'block';
            setTimeout(function () {
                window.location.href = 'home.php';
            }, 2500);
        } else {
            alert('Error:' + response.message);
        }
    };
    xhttp.open('POST', '../components/assign_teams.php');
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(params);
}
