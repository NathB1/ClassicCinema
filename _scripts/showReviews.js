/**
 * Created by nblomfield on 8/12/15.
 */

var Reviews = (function() {
    var pub = {};

    function parseReviews(data, target) {
        if ($(target).empty()){
            console.log("here");
            console.log("Data: " + data);
            console.log("Target: " + target);
            $(target).empty().append("<ul>");
            var ul = $(target).children("ul");
            $(data).find("review").each( function() {
                    $(ul).append("<li>" + $(this).find("user")[0].textContent + ": " + $(this).find("rating")[0].textContent);
            });
            //$(target).append("</ul>");
            breakme: if (!$(data).find("review").text().length) {
                $(ul).empty().append("<li>" + "No Review");
            }else {
                break breakme;
            }

        }

    }

    function showReviews() {
        console.log("Show Reviews Called");
        var target = $(this).parent().find(".review")[0];
        console.log(target);
        var image = $(this).parent().find("img")[0];
        var formTarget = $(this).parent().find(".addReview")[0];
        var imageSrc = $(image).attr("src");
        var xmlSrc = imageSrc.replace("images", "_reviews").replace(".jpg", ".xml");
        console.log("SRC: " + xmlSrc);
        $.ajax({
            type: "GET",
            url: xmlSrc,
            cache: false,
            success: function(data) {
                parseReviews(data, target);
            },
            error: function(data) {
                parseReviews(data, target);
                //target.append("<p>" + "Sorry no file found");
            }
        });
        
    }

    pub.setup = function() {
        $(".showReviews").click(showReviews);
    }

    return pub;
}());
$(document).ready(Reviews.setup);