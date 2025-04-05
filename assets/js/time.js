function populateTimeOptions(selectId) {
    var select = document.getElementById(selectId);

    for (var i = 0; i < 24 * 60; i += 15) {
        var hours = Math.floor(i / 60);
        var minutes = i % 60;

        var formattedHours = (hours < 10) ? "0" + hours : hours;
        var formattedMinutes = (minutes < 10) ? "0" + minutes : minutes;

        var timeOption = document.createElement("option");
        timeOption.value = formattedHours + ":" + formattedMinutes;
        timeOption.text = formattedHours + ":" + formattedMinutes;

        select.add(timeOption);
    }
}

// Example usage:
populateTimeOptions("timeSelect");
populateTimeOptions("timeSelect1");
