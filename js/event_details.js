// Add an event listener to each event card
document.querySelectorAll('.event').forEach((card) => {
    card.addEventListener('click', function () {
        const eventId = this.getAttribute('data-event-id');

        // Remove 'active' class from all cards to ensure only one is highlighted
        document.querySelectorAll('.event').forEach((card) => card.classList.remove('active'));

        // Add 'active' class to the clicked card
        this.classList.add('active');

        // Make an AJAX request to fetch details for the clicked event
        fetch(`../components/fetch_event_details.php?event_id=${eventId}`)
            .then((response) => response.json())
            .then((data) => {
                // Update the details section with the received data
                document.querySelector('.details-container').innerHTML = `
                        <h3>Details</h3>
                        <div class="details event-description">
                            <p>${data.event_description}</p>
                        </div>
                        <div class="details event-location">
                            <p>Location: ${data.location_name}</p>
                            <p>Address: ${data.address}</p>
                        </div>
                        <div class="details event-time">
                            <p>Time: ${data.event_time}</p>
                        </div>
                    `;
            })
            .catch((error) => console.error('Error fetching event details:', error));
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const eventIdFromUrl = params.get('eventId');

    if (eventIdFromUrl) {
        // Find the event card that matches the eventId
        const eventCard = document.querySelector(`.event[data-event-id="${eventIdFromUrl}"]`);

        if (eventCard) {
            document.querySelectorAll('.event').forEach((card) => card.classList.remove('active'));
            // Add 'active' class to the matching card
            eventCard.classList.add('active');

            // Fetch and display the details for this event
            fetch(`../components/fetch_event_details.php?event_id=${eventIdFromUrl}`)
                .then((response) => response.json())
                .then((data) => {
                    // Update the details section with the received data
                    document.querySelector('.details-container').innerHTML = `
                        <h3>Details</h3>
                        <div class="details event-description">
                            <p>${data.event_description}</p>
                        </div>
                        <div class="details event-location">
                            <p>Location: ${data.location_name}</p>
                            <p>Address: ${data.address}</p>
                        </div>
                        <div class="details event-time">
                            <p>Time: ${data.event_time}</p>
                        </div>
                    `;
                })
                .catch((error) => console.error('Error fetching event details:', error));
        }
    }
});
