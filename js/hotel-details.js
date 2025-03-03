document.addEventListener('DOMContentLoaded', function () {
    // Add any JavaScript interactions for the hotel details page here
});

function bookHotel(hotelID, hotelName, hotelLocation, pricePerNight) {
    // Send the booking information to the server
    fetch('book_hotel.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            hotelID,
            hotelName,
            hotelLocation,
            pricePerNight
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Log the response from the server
        if (data.success) {
            alert('Hotel booked successfully!');
            window.location.href = 'account.php';
        } else {
            alert('Failed to book hotel. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}
