<div class="week-container">
    <?php foreach ($events_by_week as $week => $events_by_day): ?>
        <div class="week-card">
            <h3>Week <?= $week ?></h3>
            <?php foreach ($days_of_week as $day): ?>
                <div class="day-container">
                    <h5 class="day"><?= $day; ?></h5>
                    <?php if (!empty($events_by_day[$day])): ?>
                        <?php foreach ($events_by_day[$day] as $event): ?>
                            <div class="card my-card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($event['sport_name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($event['team1_name'] . " vs " . $event['team2_name']); ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($event['location_name']); ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($event['address']); ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($day . ", " . $event['event_date'] . ", " . $event['event_time']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No events</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>