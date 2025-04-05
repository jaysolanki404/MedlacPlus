document.addEventListener("DOMContentLoaded", function () {
    const errorMessage = "License Number Not Match";

    // Show the toaster message using Noty library
    new Noty({
        text: errorMessage,
        type: "error",
        theme: "nest",
        timeout: 5000, // 5 seconds
    }).show();
});
