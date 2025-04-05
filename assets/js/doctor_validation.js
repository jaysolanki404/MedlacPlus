$(document).ready(function () {
    // Add your custom validation methods here
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    });

    jQuery.validator.addMethod("licenseFormat", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]{6}$/.test(value);
    }, "License number must be 6 letters");

    jQuery.validator.addMethod("aadharFormat", function (value, element) {
        return this.optional(element) || /^[0-9]{12}$/.test(value);
    }, "Aadhar number must be 12 digits");

    jQuery.validator.addMethod("phoneFormat", function (value, element) {
        return this.optional(element) || /^[0-9]{10}$/.test(value);
    }, "Phone number must be 10 digits");

    // Initialize form validation
    $("#doctor").validate({
        rules: {
            profile: "required",
            first_name: {
                required: true,
                lettersonly: true
            },
            last_name: {
                required: true,
                lettersonly: true
            },
            gender: "required",
            dob: "required",
            phone: {
                required: true,
                phoneFormat: true
            },
              state: {
                required: true,
                stateRequired: true // Apply the new validation rule
            },
            city: "required",
            address: "required",
            hospital: "required",
            specialist: "required",
 qualification: {
                required: true,
                minlength: 1
            },
            license_number: {
                required: true,
                licenseFormat: true
            },
            license_photo: "required",
            aadhar: {
                required: true,
                aadharFormat: true
            },
            signature: "required",
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            profile: "Please upload your profile photo",
            first_name: {
                required: "Please enter first name",
                lettersonly: "Only alphabet characters are allowed"
            },
            last_name: {
                required: "Please enter last name",
                lettersonly: "Only alphabet characters are allowed"
            },
            gender: "Please select gender",
            dob: "Please enter date of birth",
            phone: {
                required: "Please enter Phone number",
                phoneFormat: "Phone number must be 10 digits"
            },
            state: "Please select your state",
            city: "Please select your City",
            address: "Please enter address",
            hospital: "Please enter hospital",
            specialist: "Please select specialist",
  qualification: {
                required: "Please select at least one qualification",
                minlength: "Please select at least one qualification"
            },
            license_number: {
                required: "Please enter license number",
                licenseFormat: "License number must be 6 letters"
            },
            license_photo: "Please upload license photo",
            aadhar: {
                required: "Please enter Aadhar number",
                aadharFormat: "Aadhar number must be 12 digits"
            },
            signature: "Please upload signature",
            email: {
                required: "Please enter email address",
                email: "Please enter a valid email address"
            }
        },
        submitHandler: function (form) {
            form.submit();
        },
        errorPlacement: function (error, element) {
            error.addClass("error-message");
            error.insertAfter(element);
        }
    });

    // Add an event listener for form submission
    $("#doctor").on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        $(this).validate().form(); // Trigger the validation
    });
});
