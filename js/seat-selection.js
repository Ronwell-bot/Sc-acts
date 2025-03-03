document.addEventListener('DOMContentLoaded', function () {
    const seats = document.querySelectorAll('.seat-map li');
    const selectedSeatElement = document.getElementById('selected-seat');
    const bookButton = document.createElement('button');
    bookButton.classList.add('book-button');
    bookButton.textContent = 'Book Seat';
    bookButton.style.display = 'none';
    document.querySelector('.seat-picker').appendChild(bookButton);

    seats.forEach(seat => {
        seat.addEventListener('click', function () {
            // Remove 'selected' class from all seats
            seats.forEach(s => s.classList.remove('selected'));

            // Add 'selected' class to the clicked seat
            this.classList.add('selected');

            // Update the ticket information with the selected seat
            const selectedSeat = this.textContent.split(' - ')[0];
            selectedSeatElement.textContent = selectedSeat;

            // Show the book button
            bookButton.style.display = 'block';
        });
    });

    bookButton.addEventListener('click', function () {
        const flightNumber = document.querySelector('.ticket-info p:nth-child(2)').textContent.split(': ')[1];
        const departure = document.querySelector('.ticket-info p:nth-child(3)').textContent.split(': ')[1];
        const arrival = document.querySelector('.ticket-info p:nth-child(4)').textContent.split(': ')[1];
        const departureTime = document.querySelector('.ticket-info p:nth-child(5)').textContent.split(': ')[1];
        const arrivalTime = document.querySelector('.ticket-info p:nth-child(6)').textContent.split(': ')[1];
        const seat = selectedSeatElement.textContent;
        const price = document.querySelector('.ticket-info p:nth-child(8)').textContent.split(': ')[1];

        // Send the booking information to the server
        fetch('book_seat.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                flightNumber,
                departure,
                arrival,
                departureTime,
                arrivalTime,
                seat,
                price
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Seat booked successfully!');
                window.location.href = 'account.php';
            } else {
                alert('Failed to book seat. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
});
