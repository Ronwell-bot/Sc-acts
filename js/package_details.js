function bookNow(packageID, packageName, place, startDate, endDate, price, details) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "finalize_booking.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert("Booking successful!");
            } else {
                alert("Booking failed: " + response.message);
            }
        }
    };
    const data = JSON.stringify({ 
        packageID: packageID,
        packageName: packageName,
        place: place,
        startDate: startDate,
        endDate: endDate,
        price: price,
        details: details
    });
    xhr.send(data);
}
