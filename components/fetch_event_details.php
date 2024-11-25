<?php
require_once "./db_connect.php";

if (isset($_GET['event_id'])) {
    $event_id = intval($_GET['event_id']);

    $sql = "SELECT 
                Events.event_id,
                Events.event_description,
                Events.event_time,
                Location.location_name,
                Location.address,
                DAYNAME(Events.event_date) AS event_day_name,
                WEEK(Events.event_date, 1) AS event_week
            FROM Events
            INNER JOIN Location ON Events.location_fk = Location.location_id
            WHERE Events.event_id = ?";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event_details = $result->fetch_assoc();

        // Send event details as a JSON response
        echo json_encode($event_details);
    } else {
        echo json_encode(["error" => "Event not found"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$connect->close();
