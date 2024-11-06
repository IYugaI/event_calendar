<?php

require_once "./components/db_connect.php";

$sql = "SELECT 
    Events.event_id,
    Events.event_date,
    Events.event_time,
    Events.event_description,
    Sports.sport_name,
    Location.location_name,
    Location.address,
    team1.team_name AS team1_name,
    team2.team_name AS team2_name
    FROM 
        Events
    INNER JOIN Sports ON Events.sport_fk = Sports.sport_id
    INNER JOIN Location ON Events.location_fk = Location.location_id
    INNER JOIN event_teams AS et1 ON Events.event_id = et1.event_id
    INNER JOIN event_teams AS et2 ON Events.event_id = et2.event_id
    INNER JOIN Teams AS team1 ON et1.team_id = team1.team_id
    INNER JOIN Teams AS team2 ON et2.team_id = team2.team_id
    WHERE team1.team_id < team2.team_id
    ORDER BY Events.event_date, Events.event_time;
";

$result = mysqli_query($connect, $sql);

$content = "";

if (mysqli_num_rows($result) == 0) {
    $content .= "<p>No data found!</p>";
} else {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($rows as $key => $row) {

        $content .= "<div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5 class='card-title'>{$row['event_description']}</h5>
                <p class='card-text'>{$row['team1_name']} VS {$row['team2_name']}</p>
            </div>
        </div>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <main>
        <?= $content ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>