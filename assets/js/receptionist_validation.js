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

    jQuery.validator.addMethod("passFormat", function (value, element) {
        return this.optional(element) || /^[0-9]{8}$/.test(value);
    }, "URN number must be 10 digits");

    $("#receptionist").validate({
        rules: {
            profile : "required",
            first_name: {
                required: true,
                lettersonly: true
            },
            last_name: {
                required: true,
                lettersonly: true
            },
            gender: "required",
            age: "required",
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
            pass: {
                required: true,
                passFormat: true
            },
            aadhar: {
                required: true,
                aadharFormat: true
            },
            email: {
                required: true,
                email: true
            },
            password: "required"
        },
        messages: {
            profile: "Please upload your profile photo",
            first_name: {
                required: "Please enter first name",
                lettersonly: "Only alphabet are allowed"
            },
            last_name: {
                required: "Please enter last name",
                lettersonly: "Only alphabet are allowed"
            },
            gender: "Please select gender",
            age: "Please enter age",
            phone: {
                required: "Please enter Phone number",
                phoneFormat: "Phone number must be 10 digits"
            },
            state: "Please select your state",
            city: "Please select your City",
            address: "Please enter address",
            pass: {
                required: "Please enter URN",
                passFormat: "UNS number must be 8 latter"
            },
            aadhar: {
                required: "Please enter Aadhar number",
                aadharFormat: "Aadhar number must be 12 digits"
            },
            email: {
                required: "Please enter email address",
                email: "Please enter a valid email address"
            },
            password: "Please enter Password"
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
