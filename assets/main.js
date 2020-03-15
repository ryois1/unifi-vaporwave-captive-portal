$("#form").submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    $("#submit-div").html("<button class=\"btn float-right login_btn\" type=\"submit\" disabled><span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span></button>");
    $.ajax({
        type: "POST",
        url: "/login.php",
        data: form.serialize(),
        success: function(data) {
            if (data.error == false) {
                var url = $('#redirect-url').val();
                window.location.replace(url);
            }
            if (data.error == true) {
                $("#error-message").html(data.message)
                $("#submit-div").html("<button id=\"submit\" type=\"submit\" class=\"btn float-right login_btn\">Submit</button>");
            }
        }
    });
});