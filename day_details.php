<?php

require_once "./components/db_connect.php";

$week = (int)$_GET['week']; // Make sure week is an integer
$day = mysqli_real_escape_string($connect, $_GET['day']); // Escape day for safety

$sql = "
    SELECT 
        Events.event_id,
        DAYNAME(Events.event_date) AS event_day_name,
        WEEK(Events.event_date, 1) AS event_week,
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
    WHERE 
        team1.team_id < team2.team_id
        AND WEEK(Events.event_date, 1) = $week
        AND DAYNAME(Events.event_date) = '$day'
    ORDER BY 
        Events.event_date, Events.event_time;
";

// Execute the query and fetch the results
$result = mysqli_query($connect, $sql);

// Check if the query ran successfully
if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

// Fetch the data into an associative array
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/day_details.css">
</head>

<body>
    <?php require_once "./templates/navbar.php" ?>

    <main>
        <div class="outer-container">
            <!-- Left Side: Event List for the Day -->
            <div class="event-list">
                <h3><?php echo htmlspecialchars($day); ?></h3> <!-- Display selected day -->

                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $index => $event): ?>
                        <div class="card my-card event <?php echo $index === 0 ? 'active' : ''; ?>" data-event-id="<?php echo htmlspecialchars($event['event_id']); ?>">
                            <div class="card-body my-card-body">
                                <h5 class="sport-title"><?php echo htmlspecialchars($event['sport_name']); ?></h5>
                                <div class="teams">
                                    <p class="my-card-text"><?php echo htmlspecialchars($event['team1_name']); ?></p>
                                    <p class="my-card-text px-2 vs">vs</p>
                                    <p class="my-card-text"><?php echo htmlspecialchars($event['team2_name']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No events available for this day.</p>
                <?php endif; ?>
            </div>

            <!-- Right Side: Event Details for the First Event Initially -->
            <div class="details-container">
                <h3>Details</h3>

                <?php if (!empty($events)): ?>
                    <?php $first_event = $events[0]; ?> <!-- Select the first event by default -->

                    <div class="details event-description">
                        <p><?php echo htmlspecialchars($first_event['event_description']); ?></p>
                    </div>
                    <div class="details event-location">
                        <p>Location: <?php echo htmlspecialchars($first_event['location_name']); ?></p>
                        <p>Address: <?php echo htmlspecialchars($first_event['address']); ?></p>
                    </div>
                    <div class="details event-time">
                        <p>Time: <?php echo htmlspecialchars($first_event['event_time']); ?></p>
                    </div>

                <?php else: ?>
                    <p>Select an event to view details.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/event_details.js"></script>
</body>

</html>