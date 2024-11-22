<?php
require_once "./db_connect.php";

$event_date = $_POST['event_date'] ?? null;
$event_time = $_POST['event_time'] ?? null;
$event_description = $_POST['event_description'] ?? null;
$sport = $_POST['sport'] ?? null;
$location = $_POST['location'] ?? null;

if (!$event_date || !$event_time || !$event_description || !$sport || !$location) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit;
}

try {
    $connect->begin_transaction();

    $stmt = $connect->prepare("INSERT INTO events (event_date, event_time, event_description, sport_fk, location_fk) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssii', $event_date, $event_time, $event_description, $sport, $location);

    if (!$stmt->execute()) {
        throw new Exception("Error inserting event: " . $stmt->error);
    }

    $event_id = $connect->insert_id;
    $connect->commit();

    echo json_encode(['status' => 'success', 'event_id' => $event_id]);
} catch (Exception $e) {
    $connect->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
