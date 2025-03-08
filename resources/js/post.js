$(".contentEditable").on("paste", function(e) {
    e.preventDefault();

    var text = (e.originalEvent || e).clipboardData.getData("text/html");
    var $result = $("<div></div>").append($(text));
    $result.children("style").remove();
    $result.children("meta").remove();
    $result.children("link").remove();

    var html = $result
        .html()
        .replace(/<\/?[^`]+?\/?>/gim, "\n")
        .replace(/\n[\s]*\n/gim, "\n");
    html = $.trim(html);
    var lines = html.split("\n");
    for (var l in lines) {
        lines[l] = "<div>" + $.trim(lines[l]) + "</div>";
    }
    html = lines.join("\n");
    $(this).html(html);
    $("#contentEditable").val($(this).html());
});
$(document).on("click", ".comment-cancel", function(e) {
    var i = $(this).attr("data-id");
    $(this).html("Delete");
    $(this).removeClass("comment-cancel");
    $(this).addClass("comment-delete");
    $("#comment-edit-" + i).html("Edit");
    $("#comment-edit-" + i).removeClass("comment-edit-submit");
    $("#comment-edit-" + i).addClass("comment-edit");
    var cce = $("#comment-content-" + i);
    cce.removeClass("border");
    cce.removeClass("border-secondary");
    cce.removeClass("hartpiece-rounded-corner");
    cce.removeClass("form-group");
    cce.removeAttr("style");
    e.preventDefault();
});
$(document).on("click", ".comment-edit-submit", function(e) {
    var i = $(this).attr("data-id");
    var v = $("#comment-content-" + i).html();
    var s = $(".contentEditable").attr("data-slug");
    $.ajax({
        url: "/comment/edit",
        type: "POST",
        data: {
            id: i,
            comment: v,
            key: s
        },
        success: function(data) {
            $("#comment-delete-" + i).click();
        }
    });
    e.preventDefault();
});
$(document).on("click", ".comment-edit", function(e) {
    var i = $(this).attr("data-id");
    var s = $(".contentEditable").attr("data-slug");
    var cce = $("#comment-content-" + i);
    cce.attr("contenteditable", true);
    cce.addClass("border");
    cce.addClass("border-secondary");
    cce.addClass("hartpiece-rounded-corner");
    cce.addClass("form-group");
    cce.css("outline", "none");
    cce.css("padding", "10px 15px");
    $(this).removeClass("comment-edit");
    $(this).addClass("comment-edit-submit");
    $(this).html("Save");
    $("#comment-delete-" + i).html("Cancel");
    $("#comment-delete-" + i).removeClass("comment-delete");
    $("#comment-delete-" + i).addClass("comment-cancel");
    e.preventDefault();
});
$(document).on("click", ".comment-delete", function(e) {
    var i = $(this).attr("data-id");
    var s = $(".contentEditable").attr("data-slug");
    $.ajax({
        url: "/comment/delete",
        type: "POST",
        data: {
            id: i,
            key: s
        },
        success: function(data) {
            $("." + s + "-comment").html(data);
            $("#comment-" + i).remove();
        }
    });
    e.preventDefault();
});
$(document).on("keypress", ".contentEditable", function(e) {
    if (e.keyCode == 13 && !e.shiftKey) {
        var v = $(this).html();
        var h = "";
        var i = $("#hartpiece-profile-image").attr("src");
        var n = $("#fullname").html();
        if (v === "") {
            return false;
        }
        var s = $(this).attr("data-slug");
        $.ajax({
            url: "/comment/add",
            type: "POST",
            data: {
                id: s,
                comment: v
            },
            success: function(data) {
                $(".contentEditable").empty();
                $("#comment-section").prepend(data);
            }
        });
    }
});

var limit = parseInt($("#limit").val());
var sl = $(".contentEditable").attr("data-slug");
$(window).scroll(function() {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
        $.ajax({
            url: "/paginate/comment",
            type: "POST",
            data: {
                l: limit,
                s: sl
            },
            success: function(data) {
                $("#comment-section").append(data);
            }
        });
        limit = limit + limit;
    }
});

$(document).ready(function() {
    $(".contentEditable").keydown(function(e) {
        if (e.ctrlKey || e.metaKey) {
            switch (e.keyCode) {
                case 66: //ctrl+B or ctrl+b
                case 98:
                    ret = false;
                    break;
                case 73: //ctrl+I or ctrl+i
                case 105:
                    ret = false;
                    break;
                case 85: //ctrl+U or ctrl+u
                case 117:
                    ret = false;
                    break;
                default:
                    ret = true;
                    break;
            }
            return ret;
        }
    });
});
