$(function () {
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    },);
    $("#patient").validate({
        rules: {
            first_name: {
                required: true,
                lettersonly: true
            },

            last_name: {
                required: true,
                lettersonly: true
            },
            gender: {
                required: true
            },
            blood_group: {
                required: true
            },
            dob: {
                required: true
            },
            phone: {
                required: "enter your number"
            },
            phone: {
                required: ture
            },
            address: {
                required: true
            },
            aadhar: {
                required: true
            },
            email: {
                required: true
            },

        },
        messages: {
            first_name: {
                required: " enter your first name",
                lettersonly: "Only alphabet are allowed"
            },
            last_name: {
                required: " enter your last name",
                lettersonly: " enter category name"
            },
            gender: {
                required: " select your gender"
            },
            dob: {
                required: " select your date of birth"
            },
            address: {
                required: " enter your address"
            },
            aadhar: {
                required: " enter your aadhar_number"
            },
            email: {
                required: " enter your email"
            },

        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});