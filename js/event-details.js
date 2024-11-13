// Add an event listener to each event card
document.querySelectorAll('.event').forEach((card) => {
    card.addEventListener('click', function () {
        const eventId = this.getAttribute('data-event-id');

        // Make an AJAX request to fetch details for the clicked event
        fetch(`../components/fetch-event-details.php?event_id=${eventId}`)
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
