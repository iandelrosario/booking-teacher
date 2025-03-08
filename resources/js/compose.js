$(document).ready(function() {
    $(".contentEditable").keyup(function(e) {
        $("#contentEditable").val($(this).html());

        var f = $("#content-file").val();
        var c = $("#contentEditable").val();

        if (f !== "" && c !== "") {
            $("#submit-post").removeAttr("disabled");
        } else {
            $("#submit-post").attr("disabled", "disabled");
        }
    });

    $("#content-file").change(function() {
        var f = $(this).val();
        var c = $("#contentEditable").val();
        if (f !== "" && c !== "") {
            $("#submit-post").removeAttr("disabled");
        }
    });
});
$("[contenteditable]").on("paste", function(e) {
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
        lines[l] = "<div>" + $.trim(lines[l]) + "</div><br>";
    }
    html = lines.join("\n");
    document.execCommand("inserthtml", false, html);
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

function contentImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $("#content-file-preview").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
