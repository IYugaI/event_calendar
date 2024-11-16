document.querySelectorAll('.event').forEach((card) => {
    card.addEventListener('click', function () {
        const eventId = this.getAttribute('data-event-id');

        document.querySelectorAll('.event').forEach((card) => card.classList.remove('active'));

        // Add 'active' class to the clicked card
        // this.classList.add('active');

        fetch(`../components/fetch-event-details.php?event_id=${eventId}`)
            .then((response) => response.json())
            .then((data) => {
                let week = data.event_week;
                let day = data.event_day_name;
                let id = data.event_id;
                // Update the details section with the received data
                window.location.href = `day-details.php?week=${week}&day=${day}&eventId=${id}`;
            })
            .catch((error) => console.error('Error fetching event details:', error));
    });
});
