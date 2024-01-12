$(function () {
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

    $("#chemist").validate({
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
            age: "required",
            phone : "required",
            state: {
                required: true,
                stateRequired: true // Apply the new validation rule
            },
            city: "required",
            address: "required",
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
            profile: "Please upload your Profile Photo",
            first_name: {
                required: "Please enter first name",
                lettersonly: "Only alphabet are allowed"
            },
            last_name: {
                required: "Please enter last name",
                lettersonly: "Only alphabet are allowed"
            },
            age: "Please select gender",
            phone: "Please enter your phone numbet",
            state: "Please select your state",
            city: "Please select your City",
            address: "Please enter address",
            hospital: "Please enter hospital",
            specialist: "Please select specialist",
            license_number: {
                required: "Please enter license number",
                licenseFormat: "License number must be 6 latter"
            },
            license_photo: "Please upload license photo",
            aadhar: {
                required: "Please enter Aadhar number",
                aadharFormat: "Aadhar number must be 12 digits"
            },
            signature: "Please upload your Signature",
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
