<?php
require_once "./db_connect.php";

$event_id = $_POST['event_id'] ?? null;
$team1 = $_POST['team1'] ?? null;
$team2 = $_POST['team2'] ?? null;

if (!$event_id || !$team1 || !$team2 || $team1 == $team2) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid teams of evend ID']);
    exit;
}

try {
    $connect->begin_transaction();

    $stmt = $connect->prepare("INSERT INTO event_teams (event_id, team_id) VALUES (?, ?)");

    // add Team 1
    $stmt->bind_param('ii', $event_id, $team1);
    if (!$stmt->execute()) {
        throw new Exception("Error linking Team 1:" . $stmt->error);
    }

    // add Team 2
    $stmt->bind_param('ii', $event_id, $team2);
    if (!$stmt->execute()) {
        throw new Exception("Error linking Team 2:" . $stmt->error);
    }

    $connect->commit();

    echo json_encode(['status' => 'success', 'message' => 'Teams linked to event successfully.']);
} catch (Exception $e) {
    $connect->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
