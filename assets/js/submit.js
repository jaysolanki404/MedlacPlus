$(document).ready(function () {
    // Function to submit the form
    function submitForm() {
        $("#form").submit();
    }

    // Function to check if the email input is filled and submit the form
    function checkEmailAndSubmit() {
        const emailInputValue = $("#email").val().trim();
        if (emailInputValue !== "") {
            // Call the function to submit the form
            submitForm();
        }
    }

    // Listen for changes in the email input field
    $("#email").on("input", function () {
        checkEmailAndSubmit();
    });
});

