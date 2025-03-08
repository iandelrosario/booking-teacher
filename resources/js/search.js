$(function() {
    var lmt = parseInt($("#limit").val());
    var typ = $("#type").val();
    var srch = $("#search").val();
    var limit = lmt;
    $(window).scroll(function() {
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
            $.ajax({
                url: "/paginate/search/" + typ,
                type: "POST",
                data: {
                    l: limit,
                    q: srch
                },
                success: function(data) {
                    if (typ == "people") {
                        $("#feedUser").append(data);
                    } else if (typ == "post" || typ == "tags") {
                        $("#feedPost").append(data);
                    }
                }
            });
            limit = limit + lmt;
        }
    });
});
