$(function () {

    $("#doctor").validate({
        errorPlacement: function (error, element) {
            var fieldName = element.attr("name");
            $("#" + fieldName + "-error").html(error);
        },
        rules: {
            profile:'required',
            first_name: {
                required: true,
                lettersonly: true
            },
            last_name: {
                required: true,
                lettersonly: true
            },
            gender: 'required',
            dob: 'required',
            phone: 'required',
            address: 'required',
            hospital: 'required',
            specialist: 'required',
            license_number: 'required',
            license_photo: 'required',
            aadhar: 'required',
            email: 'required'
        },
        messages: {
            profile:"Please upload profile",
            first_name: {
                required: "Please enter first name",
                lettersonly: "Only alphabet characters are allowed"
            },
            last_name: {
                required: "Please enter last name",
                lettersonly: "Only alphabet characters are allowed"
            },
            gender: "Please select a gender",
            dob: "Please enter date of birth",
            phone: "Please enter phone number",
            address: "Please enter address",
            hospital: "Please enter hospital",
            specialist: "Please select a specialist",
            license_number: "Please enter license number",
            license_photo: "Please upload a license photo",
            aadhar: "Please enter Aadhar card number",
            email: "Please enter your email"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
