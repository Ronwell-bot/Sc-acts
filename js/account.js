document.addEventListener('DOMContentLoaded', function () {
    const showBookingsButton = document.getElementById('show-bookings-button');
    const bookingsPopup = document.getElementById('bookings-popup');
    const closeButtons = document.querySelectorAll('.close-button');
    const bookingsList = document.getElementById('bookings-list');

    const payNowButton = document.getElementById('pay-now-button');
    const paymentPopup = document.getElementById('payment-popup');
    const totalAmountElement = document.getElementById('total-amount');
    const paymentForm = document.getElementById('payment-form');

    const viewSummaryButton = document.getElementById('view-summary-button');

    // Assuming bookings array is fetched from the server
    let bookings = [];

    // Fetch the booked tickets from the server
    fetch('get_bookings.php')
        .then(response => response.json())
        .then(data => {
            bookings = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });

    payNowButton.addEventListener('click', function () {
        // Calculate the total amount
        let totalAmount = 0;
        bookings.forEach(booking => {
            totalAmount += parseFloat(booking.Price);
        });
        totalAmountElement.textContent = totalAmount.toFixed(2);

        paymentPopup.style.display = 'block';
    });

    viewSummaryButton.addEventListener('click', function () {
        fetch('view_summary.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ bookings })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.open('summary.php', '_blank');
            } else {
                alert('Failed to generate summary. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            bookingsPopup.style.display = 'none';
            paymentPopup.style.display = 'none';
        });
    });

    window.addEventListener('click', function (event) {
        if (event.target === bookingsPopup) {
            bookingsPopup.style.display = 'none';
        }
        if (event.target === paymentPopup) {
            paymentPopup.style.display = 'none';
        }
    });

    // Handle payment form submission
    paymentForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(paymentForm);
        const paymentDetails = {
            cardNumber: formData.get('card-number'),
            expiryDate: formData.get('expiry-date'),
            cvv: formData.get('cvv'),
            bookings
        };

        fetch('confirm_payment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(paymentDetails)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Payment confirmed and summary sent via email.');
                paymentPopup.style.display = 'none';
            } else {
                alert('Failed to confirm payment. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
});
