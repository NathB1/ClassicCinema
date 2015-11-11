function showHideDetails(){
	/**"use strict";
    var images, paragraphs, i, p;
        images = $(this).parent().find("img");
        for (i = 0; i < images.length; i += 1) {
            if (images[i].style.display === "none") {
                images[i].style.display = "inline";
            } else {
                images[i].style.display = "none";
            }
        }
        paragraphs = this.parentNode.getElementsByTagName("p");
        for (p = 0; p < paragraphs.length; p += 1) {
            if (paragraphs[p].style.display === "none") {
                paragraphs[p].style.display = "block";
            } else {
                paragraphs[p].style.display = "none";
            }
        }**/
    // $(this).siblings().toggle("easeOutQuart");
    $(this).siblings().toggle();

}

/*
The setup function needs to loop over all the films and add an
onclick event handler to their titles.
*/
function setup() {
	//"use strict";
//var
//films;
$("h3").click(showHideDetails);
    $("h3").css({cursor: "pointer"});
/**for (f = 0; f < films.length; f+=1) {
    **/

    //for(f in films){
    //    film = films[f];
    //    title = films[f].getElementsByTagName("h3")[0];
    //title = films.find("h3").text(); //<--- this doesn't work why?
    //title.onclick = showHideDetails;
    //title.style.cursor = "pointer";
    //$(this).siblings().hide();
    //}
}
$(document).ready(setup);