<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/day-details.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sport Calendar</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#">Events</a>
                        <a class="nav-link" href="#">Tickets</a>
                        <a class="nav-link" href="#">About</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>



    <main>
        <div class="outer-container">
            <!-- Left Side: Event List for the Day -->
            <div class="event-list">
                <h3><?php echo htmlspecialchars($day); ?></h3> <!-- Display selected day -->

                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <div class="card my-card event" data-event-id="<?php echo htmlspecialchars($event['event_id']); ?>">
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

    <!-- <main>
        <div class="outer-container">
            <div class="event-list">
                <h3>Monday</h3>
                <div class="card my-card event">
                    <div class="card-body my-card-body">
                        <h5 class="sport-title">Football</h5>
                        <div class="teams">
                            <p class="my-card-text">Liverpool FC</p>
                            <p class="my-card-text px-2 vs">vs</p>
                            <p class="my-card-text">Barcelona FC</p>
                        </div>
                    </div>
                </div>
                <div class="card my-card event">
                    <div class="card-body my-card-body">
                        <h5 class="sport-title">Football</h5>
                        <div class="teams">
                            <p class="my-card-text">Liverpool FC</p>
                            <p id="vs" class="my-card-text px-2">vs</p>
                            <p class="my-card-text">Barcelona FC</p>
                        </div>
                    </div>
                </div>
                <div class="card my-card event">
                    <div class="card-body my-card-body">
                        <h5 class="sport-title">Football</h5>
                        <div class="teams">
                            <p class="my-card-text">Liverpool FC</p>
                            <p id="vs" class="my-card-text px-2">vs</p>
                            <p class="my-card-text">Paris Saint-Germain</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details-container">
                <h3>Details</h3>
                <div class="details event-description">
                    <p>Football match between Bayern Munich and Paris Saint-Germain</p>
                </div>
                <div class="details event-location">
                    <p>Location: Old Trafford Stadium</p>
                    <p>Address: Manchester, England</p>
                </div>
                <div class="details event-time">
                    <p>Time: 18:30</p>
                </div>
            </div>
        </div>
    </main> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>