<div class="week-container">
    <?php foreach ($events_by_week as $week => $events_by_day): ?>
        <div class="week-card">
            <h3 class="week-header">Week <?= $week ?></h3>
            <?php foreach ($days_of_week as $day): ?>
                <div class="day-container">
                    <h5 class="day"><?= $day; ?></h5>
                    <?php if (!empty($events_by_day[$day])): ?>
                        <div class="events-container">
                            <?php
                            $event_count = count($events_by_day[$day]); // Get total number of events for the day
                            $max_events = min($event_count, 2); // Limit to 2 events maximum

                            for ($i = 0; $i < $max_events; $i++):
                                $event = $events_by_day[$day][$i];
                            ?>
                                <div class="card my-card event">
                                    <div class="card-body my-card-body">
                                        <h5 class="sport-title"><?php echo htmlspecialchars($event['sport_name']); ?></h5>
                                        <div class="teams">
                                            <p class="my-card-text"><?php echo htmlspecialchars($event['team1_name']); ?></p>
                                            <p id="vs" class="my-card-text px-2">vs</p>
                                            <p class="my-card-text"><?php echo htmlspecialchars($event['team2_name']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php else: ?>

                        <div class="no-events">
                            <p>No Events</p>
                        </div>

                    <?php endif; ?>
                    <div class="more-btn-container">
                        <a href="" class="my-btn">show more</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>