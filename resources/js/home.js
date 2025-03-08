var limit = parseInt($("#limit").val());
var un = $("#username").val();
$(window).scroll(function() {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
        $.ajax({
            url: "/paginate/home",
            type: "POST",
            data: {
                l: limit,
                u: un
            },
            success: function(data) {
                $('#feedPost').append(data);
            }
        });
        limit = limit + limit;
    }
});
