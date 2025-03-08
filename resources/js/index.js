var limit = parseInt($("#limit").val());
$(window).scroll(function() {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
        $.ajax({
            url: "/paginate/index",
            type: "POST",
            data: {
                l: limit
            },
            success: function(data) {
                $("#feedPost").append(data);
            }
        });
        limit = limit + limit; 
    }
});
