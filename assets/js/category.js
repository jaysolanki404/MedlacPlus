//jquery for category form
$(function () {
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    },);
    $("#category").validate({
        rules: {
            category_name: {
                required: true,
                lettersonly: true
            },
            category_description: 'required'
        },
        messages: {
            category_name: {
                required: "Please enter category name",
                lettersonly: "Only alphabet are allowed"
            },
            category_description: "Please enter description"

        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});