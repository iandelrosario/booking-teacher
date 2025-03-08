$(document).on("click", ".post-delete", function(e) {
    var s = $(this).attr("data-slug");
    $.ajax({
        url: "/posts/delete",
        type: "POST",
        data: {
            key: s
        },
        success: function(data) {
            window.location = "/";
        }
    });
});
$(document).on("click", ".post-view", function() {
    var s = $(this).attr("data-slug");
    $.ajax({
        url: "/view",
        type: "POST",
        data: {
            key: s
        }
    });
});
$(document).on("click", ".post-report", function(e) {
    var s = $(this).attr("data-slug");
    $("#report-id").val(s);
    $("#reason").val("");
    $(".btn-report").attr("disabled", "disabled");
    $(".report-reason").removeClass("btn-dark");
    $("#report-message").addClass("d-none");
});
$(document).on("click", ".post-bookmark", function(e) {
    var s = $(this).attr("data-slug");
    var v = $(this).attr("data-book");
    $.ajax({
        url: "/bookmark",
        type: "POST",
        data: {
            key: s
        }
    });
    if (v == "0") {
        $(this).html("<small>Remove bookmark</small>");
    } else {
        $(this).html("<small>Bookmark</small>");
    }
    e.preventDefault();
});
$(document).on("click", ".report-reason", function(e) {
    $(".report-reason").removeClass("btn-dark");
    $(this).addClass("btn-dark");
    $(".btn-report").removeAttr("disabled");
    $("#reason").val($(this).html());
});
$(document).on("click", ".btn-report", function(e) {
    var r = $("#reason").val();
    var s = $("#report-id").val();
    $.ajax({
        url: "/posts/report",
        type: "POST",
        data: {
            k: s,
            r: r
        },
        success: function(data) {
            $("#report-message").removeClass("d-none");
            $(".btn-report").attr("disabled", "disabled");
            $(".report-reason").removeClass("btn-dark");
            $("#report-message").html(data);
        }
    });
});
$(document).on("click", ".btn-unlike", function(e) {
    var s = $(this).attr("data-slug");
    $(this).removeClass("btn-unlike");
    $(this).addClass("text-dark");
    $(this).addClass("btn-like");
    $.ajax({
        url: "/like",
        type: "POST",
        data: {
            id: s
        },
        success: function(data) {
            $("." + s + "-count").html(data);
        }
    });
    e.preventDefault();
});
$(document).on("click", ".btn-like", function(e) {
    $(this).removeClass("text-dark");
    $(this).removeClass("btn-like");
    $(this).addClass("btn-unlike");
    $(this).addClass("hartpiece-color");
    var s = $(this).attr("data-slug");
    $.ajax({
        url: "/like",
        type: "POST",
        data: {
            id: s
        },
        success: function(data) {
            $("." + s + "-count").html(data);
        }
    });
    e.preventDefault();
});
