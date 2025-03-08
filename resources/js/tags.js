var limit = parseInt($("#limit").val());
var t = $("#tags").val();
$(window).scroll(function() {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
        $.ajax({
            url: "/paginate/tags",
            type: "POST",
            data: {
                l: limit,
                t: t
            },
            success: function(data) {
                $("#feedPost").append(data);
            }
        });
        limit = limit + limit;
    }
});
