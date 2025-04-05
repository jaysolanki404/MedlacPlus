$(function () {
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    });

    jQuery.validator.addMethod("aadharFormat", function (value, element) {
        return this.optional(element) || /^[0-9]{12}$/.test(value);
    }, "Aadhar number must be 12 digits");

    jQuery.validator.addMethod("phoneFormat", function (value, element) {
        return this.optional(element) || /^[0-9]{10}$/.test(value);
    }, "Phone number must be 10 digits");

    $("#patient").validate({
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
            blood_group: "required",
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
            aadhar: {
                required: true,
                aadharFormat: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            profile: "Please upload your Profile Photo",
            first_name: {
                required: "Please enter first name",
                lettersonly: "Only alphabet are allowed"
            },
            last_name: {
                required: "Please enter last name",
                lettersonly: "Only alphabet are allowed"
            },
            gender: "Please select gender",
            blood_group: "Please select your blood",
            dob: "Please enter date of birth",
            phone: {
                required: "Please enter Phone number",
                phoneFormat: "Phone number must be 10 digits"
            },
            state: "Please select your state",
            city: "Please select your City",
            address: "Please enter address",
            aadhar: {
                required: "Please enter Aadhar number",
                aadharFormat: "Aadhar number must be 12 digits"
            },
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
});
