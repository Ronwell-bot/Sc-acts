document.addEventListener('DOMContentLoaded', function () {
    const listingType = document.getElementById('listing-type');
    const listingDetails = document.querySelectorAll('.listing-details');

    listingType.addEventListener('change', function () {
        listingDetails.forEach(detail => detail.style.display = 'none');
        document.getElementById(this.value + '-details').style.display = 'block';

        // Change background image with animation
        document.body.className = ''; // Reset class
        setTimeout(() => {
            document.body.classList.add('background-' + this.value);
        }, 100);
    });

    listingType.dispatchEvent(new Event('change'));
});
