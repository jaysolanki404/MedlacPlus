
// $(document).ready(function () {
//     new Noty({
//         type: 'error',
//         text: 'Unauthorized user!',
//         timeout: 3000,
//         progressBar: true
//     }).show();
// });



document.addEventListener("DOMContentLoaded", function () {
    const errorMessage = "Unauthorized person";

    // Show the toaster message using Noty library
    new Noty({
        text: errorMessage,
        type: "error",
        theme: "nest",
        timeout: 5000, // 5 seconds
    }).show();
});
