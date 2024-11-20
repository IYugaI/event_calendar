<?php

require_once "./components/db_connect.php";
require 'vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonPeriod;

$year = 2024;

// Create a CarbonPeriod for the entire year
$year_start = Carbon::create($year, 1, 1);
$year_end = Carbon::create($year, 12, 31);

$weekOpen = "";
$day = "";

$sql = "SELECT 
    Events.event_id,
    DAYNAME(Events.event_date) AS event_day_name,
    WEEK(Events.event_date, 1) AS event_week,
     DATE_FORMAT(
        DATE_SUB(Events.event_date, INTERVAL (WEEKDAY(Events.event_date)) DAY), '%Y-%m-%d'
    ) AS week_start,
    DATE_FORMAT(
        DATE_ADD(Events.event_date, INTERVAL (6 - WEEKDAY(Events.event_date)) DAY), '%Y-%m-%d'
    ) AS week_end,
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

// Organize events by week and day
$events_by_week = [];
$days_carbon = [];

if (mysqli_num_rows($result) == 0) {
    $content .= "<p>No data found!</p>";
} else {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($rows as $key => $row) {
        $week = $row['event_week'];
        $day = $row['event_day_name'];

        // Group events by week and then by day
        $events_by_week[$week][$day][] = $row;

        // Days range for each week
        $week_range[$week] = [
            'week_start' => $row['week_start'],
            'week_end' => $row['week_end'],
            'week_start_display' => Carbon::parse($row['week_start'])->format('F d'),
            'week_end_display' => Carbon::parse($row['week_end'])->format('F d')
        ];
    }

    foreach ($week_range as $week => $week_num) {
        $week_range_carbon = CarbonPeriod::create($week_num['week_start'], $week_num['week_end']);

        foreach ($week_range_carbon as $day_carbon) {
            $day_name = $day_carbon->format('l');
            $days_carbon[$week][$day_name] = [
                'date_short' => $day_carbon->format('d'),
                'date' => $day_carbon->format('d-m-Y'),
                'day_name' => $day_name,
                'month' => $day_carbon->format('F')
            ];
        }
    }
}

$days_of_week = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/slider.css">
</head>

<body>
    <?php require_once "./templates/navbar.php" ?>

    <?php
    echo '<pre>';
    // var_dump($week_range);
    // var_dump($days_carbon);
    echo '</pre>';
    ?>
    <main>
        <div class="slider">
            <div class="slides">
                <?php require_once "./templates/week-view.php" ?>
            </div>
            <button class="prev" onclick="prevSlide()">
                &#11164;</button>
            <button class="next" onclick="nextSlide()">&#11166;</button>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/slider.js"></script>
    <script src="./js/redirect.js"></script>
</body>

</html>