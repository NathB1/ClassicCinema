/**
 * Created by nblomfield.
 */

var Cart = (function() {
    "use strict";
    var button, b, pub = {}, filmList, movie, movieAdd = {};

    function cartAlert(){
        movie = $(this).parent().parent();
        //movieAdd.price = parseFloat(movie.getElementsByClassName("price")[0].innerHTML);

        /**
         * gets all elements from class test
         **/
        movieAdd.price = parseFloat($(movie).find(".price")[0].textContent);
        //movieAdd.title = movie.getElementsByTagName("h3")[0].innerHTML;
        movieAdd.title = movie.find("h3")[0].textContent;

        filmList = Cookie.get("MovieCart");
        if (filmList) {
            filmList = $.parseJSON(filmList);
        } else{
            filmList = [];
        }
        filmList.push(movieAdd);
        Cookie.set("MovieCart", JSON.stringify(filmList));
    }

    pub.setup = function() {
        $(".buy").click(cartAlert);
    }
    return pub;

}());
$(document).ready(Cart.setup);