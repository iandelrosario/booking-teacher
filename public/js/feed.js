$(document).on("click",".post-delete",function(t){var a=$(this).attr("data-slug");$.ajax({url:"/posts/delete",type:"POST",data:{key:a},success:function(t){window.location="/"}})}),$(document).on("click",".post-view",function(){var t=$(this).attr("data-slug");$.ajax({url:"/view",type:"POST",data:{key:t}})}),$(document).on("click",".post-report",function(t){var a=$(this).attr("data-slug");$("#report-id").val(a),$("#reason").val(""),$(".btn-report").attr("disabled","disabled"),$(".report-reason").removeClass("btn-dark"),$("#report-message").addClass("d-none")}),$(document).on("click",".post-bookmark",function(t){var a=$(this).attr("data-slug"),e=$(this).attr("data-book");$.ajax({url:"/bookmark",type:"POST",data:{key:a}}),"0"==e?$(this).html("<small>Remove bookmark</small>"):$(this).html("<small>Bookmark</small>"),t.preventDefault()}),$(document).on("click",".report-reason",function(t){$(".report-reason").removeClass("btn-dark"),$(this).addClass("btn-dark"),$(".btn-report").removeAttr("disabled"),$("#reason").val($(this).html())}),$(document).on("click",".btn-report",function(t){var a=$("#reason").val(),e=$("#report-id").val();$.ajax({url:"/posts/report",type:"POST",data:{k:e,r:a},success:function(t){$("#report-message").removeClass("d-none"),$(".btn-report").attr("disabled","disabled"),$(".report-reason").removeClass("btn-dark"),$("#report-message").html(t)}})}),$(document).on("click",".btn-unlike",function(t){var a=$(this).attr("data-slug");$(this).removeClass("btn-unlike"),$(this).addClass("text-dark"),$(this).addClass("btn-like"),$.ajax({url:"/like",type:"POST",data:{id:a},success:function(t){$("."+a+"-count").html(t)}}),t.preventDefault()}),$(document).on("click",".btn-like",function(t){$(this).removeClass("text-dark"),$(this).removeClass("btn-like"),$(this).addClass("btn-unlike"),$(this).addClass("hartpiece-color");var a=$(this).attr("data-slug");$.ajax({url:"/like",type:"POST",data:{id:a},success:function(t){$("."+a+"-count").html(t)}}),t.preventDefault()});
