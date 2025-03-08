$(function() {
    var lmt = parseInt($("#limit").val());
    var un = $("#un").val();
    var limit = lmt;
    $(window).scroll(function() {
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
            $.ajax({
                url: "/paginate/followers",
                type: "POST",
                data: {
                    l: limit,
                    u: un
                },
                success: function(data) {
                    $('#feedUser').append(data);
                }
            });
            limit = limit + lmt;
        }
    });
});
