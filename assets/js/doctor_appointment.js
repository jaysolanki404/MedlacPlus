document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("patient");

    form.addEventListener("submit", function (event) {
        var doctorSelect = document.getElementById("doctor");
        var selectedDoctor = doctorSelect.options[doctorSelect.selectedIndex];

        var selectedDate = new Date(document.getElementById("datePicker").value);
        var selectedTime = document.getElementById("timeSelect").value;

        var workingDays = selectedDoctor.getAttribute("data-working-days").split(",");
        var workingFrom = selectedDoctor.getAttribute("data-working-from");
        var workingTill = selectedDoctor.getAttribute("data-working-till");

        // Check if the selected day is a working day
        if (workingDays.includes(selectedDate.getDay().toString())) {
            // Check if the selected time is within working hours
            var selectedDateTime = new Date(selectedDate.toDateString() + " " + selectedTime);
            var workingFromTime = new Date(selectedDate.toDateString() + " " + workingFrom);
            var workingTillTime = new Date(selectedDate.toDateString() + " " + workingTill);

            if (selectedDateTime >= workingFromTime && selectedDateTime <= workingTillTime) {
                // Continue with the form submission
                return true;
            } else {
                // Display an error message for invalid time
                alert("Please select a valid time within working hours.");
            }
        } else {
            // Display an error message for invalid day
            alert("Doctor is not available on selected day.");
        }

        // Prevent form submission if validation fails
        event.preventDefault();
    });
});
