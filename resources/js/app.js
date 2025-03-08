$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$(function() {
    lazyImages();
    $(".global-search").keypress(function(e) {
        if (e.keyCode == 13) {
            var q = $(this).val();
            var u = $(this).attr("data-url");
            window.location = u + "?q=" + q.replace("#", "%23");
        }
    });
});
$(window).scroll(function() {
    lazyImages();
});

$(document).on("click", ".follow", function(e) {
    var u = $(this).attr("data-un");
    var v = $(this).html();
    $.ajax({
        url: "/follow",
        type: "POST",
        data: {
            username: u
        }
    });
    if (v === "Follow") {
        $(this).html("Unfollow");
    } else {
        $(this).html("Follow");
    }
});

function lazyImages() {
    $(".lazyImages").Lazy();
}

function changeDp(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#hartpiece-profile-image").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);

        $("#changeDp").submit();
    }
}
