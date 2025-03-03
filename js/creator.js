function showRelevantForm() {
    var listingType = document.getElementById('listing-type').value;
    document.getElementById('flight-details').style.display = 'none';
    document.getElementById('hotel-details').style.display = 'none';
    document.getElementById('package-details').style.display = 'none';

    if (listingType === 'flight') {
        document.getElementById('flight-details').style.display = 'block';
    } else if (listingType === 'hotel') {
        document.getElementById('hotel-details').style.display = 'block';
    } else if (listingType === 'package') {
        document.getElementById('package-details').style.display = 'block';
    }
}

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Call the function on page load to set the initial state
document.addEventListener('DOMContentLoaded', function () {
    showRelevantForm();
    document.querySelector('.tablinks').click();
});

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

    // Handle form submission
    document.getElementById('listing-form').addEventListener('submit', function (event) {
        const selectedType = listingType.value;
        listingDetails.forEach(detail => {
            if (detail.id !== selectedType + '-details') {
                detail.querySelectorAll('input, select, textarea').forEach(input => {
                    input.disabled = true;
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContentAreas = document.querySelectorAll('.tab-content');

    tabLinks.forEach(function (tabLink) {
        tabLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior (if it's an <a> tag)

            const tabId = this.dataset.tab; // Get the tab ID from the data-tab attribute

            // 1. Remove 'current' class from all tabs and content areas
            tabLinks.forEach(link => link.classList.remove('current'));
            tabContentAreas.forEach(content => content.classList.remove('current'));

            // 2. Add 'current' class to the clicked tab and corresponding content area
            this.classList.add('current');
            document.getElementById(tabId).classList.add('current');

            // Change background image with animation
            document.body.className = ''; // Reset class
            setTimeout(() => {
                document.body.classList.add('background-' + tabId);
            }, 100);
        });
    });

    // Trigger click on the first tab to set the initial background
    tabLinks[0].click();
});

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            const tabId = this.getAttribute('data-tab');

            tabs.forEach(t => t.classList.remove('current'));
            tabContents.forEach(tc => tc.classList.remove('current'));

            this.classList.add('current');
            document.getElementById(tabId + '-form').classList.add('current');
        });
    });
});
