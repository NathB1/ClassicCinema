/**
 * Created by Nathan on 29/07/2015.
 */

var Checkout = (function () {
    "use strict";
    var pub = {};

    pub.setup = function () {
        var cart, cartTotal, i, cartList, cartTable;

        /** Hide Cart Contents.
         * Showing an empty cart and the form does not make much sense.
         * So we use .hide on the css to hide this.
         * We append a message to say that the cart is empty.
         */
        cart = JSON.parse(Cookie.get("MovieCart"));
        if(!cart || cart.length == 0){
            $("<p>Your cart is currently empty, please add something to you cart to continue</p>").appendTo("#message");
            $("#checkoutForm").hide();
        }else {
            cartTotal = 0;

            /* Show cart contents.
             * We show the cart contents by entering into an else statement so that
             * if cart.length is not equal to zero then we get to the else
             * which displays the contents of the cart in a table and shows the payment
             * details etc.
             */
            cartTable = $("#cartList");
            for (i = 0; i < cart.length; i += 1) {
                $("<tr><td>" +  cart[i].title + "</td><td>" + cart[i].price + "</td></tr>").appendTo(cartTable);

                cartTotal += parseFloat(cart[i].price);
            }
            //cartTable +="</table>";
            //document.getElementById("cartList").innerHTML = s;
            $("<h3>Total Price</h3>" + "<p>" + "$" + cartTotal.toFixed(2) + "</p>").appendTo("#cartTotal");
        }

    };


    return pub;
}());
$(document).ready(Checkout.setup);
