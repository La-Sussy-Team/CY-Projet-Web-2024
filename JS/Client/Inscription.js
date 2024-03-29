$(document).ready(function() {
    $('#username').on('input', function() {
        var input=$(this);
        var re = /^[A-Za-z0-9]+$/;
        var is_alphanumeric=re.test(input.val());
        if(is_alphanumeric){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
    });
});