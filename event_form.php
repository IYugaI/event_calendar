<?php
require_once "./components/db_connect.php";

$sql_teams = "SELECT * FROM `teams`";
$result_teams = mysqli_query($connect, $sql_teams);

$sql_sports = "SELECT * FROM `sports`";
$result_sports = mysqli_query($connect, $sql_sports);

$sql_location = "SELECT * FROM `location`";
$result_location = mysqli_query($connect, $sql_location);



if (mysqli_num_rows($result_teams) == 0) {
    $teams_content = '<p>No teams found!</p>';
} else {
    $team_rows = mysqli_fetch_all($result_teams, MYSQLI_ASSOC);
}

if (mysqli_num_rows($result_sports) == 0) {
    $sports_content = '<p>No sports found!</p>';
} else {
    $sport_rows = mysqli_fetch_all($result_sports, MYSQLI_ASSOC);
}

if (mysqli_num_rows($result_location) == 0) {
    $location_content = '<p>No location found!</p>';
} else {
    $location_rows = mysqli_fetch_all($result_location, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/event_form.css">
</head>

<body>
    <?php require_once "./templates/navbar.php" ?>

    <main>
        <div id="alert" class="success">
            Event created and teams assigned successfully!
        </div>
        <h3 class="form-header">Create new Event</h3>
        <form class="my-form" id="create-form" method='POST' enctype='multipart/form-data'>
            <div class="form-field">
                <label for="eventDate">Event Date: </label>
                <input type="date" id="eventDate" name="eventDate">
            </div>
            <div class="form-field">
                <label for="eventTime">Event Time: </label>
                <input type="time" id="eventTime" name="eventTime">
            </div>
            <div class="form-field">
                <label for="eventDescription">Event Description: </label>
                <input type="textarea" id="eventDescription" name="eventDescription">
            </div>
            <div class="form-field">
                <label for="sport-select">Select a sport: </label>
                <select name="sports" id="sport-select">
                    <?php foreach ($sport_rows as $sport): ?>
                        <option value="<?= $sport['sport_id'] ?>"><?= $sport['sport_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-field">
                <label for="location-select">Location: </label>
                <select name="location" id="location-select">
                    <?php foreach ($location_rows as $location): ?>
                        <option value="<?= $location['location_id'] ?>"><?= $location['location_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-field">
                <label for="team1-select">Select Team 1: </label>
                <select name="team1" id="team1-select">
                    <?php foreach ($team_rows as $team): ?>
                        <option value="<?= $team['team_id'] ?>"><?= $team['team_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="team2-select">Select Team 2: </label>
                <select name="team2" id="team2-select">
                    <?php foreach ($team_rows as $team): ?>
                        <option value="<?= $team['team_id'] ?>"><?= $team['team_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" id="submit">Add Event</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/create_form.js"></script>
</body>

</html>