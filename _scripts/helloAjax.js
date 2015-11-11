/**
 * Created by Nathan on 11/08/2015.
 */
function doAjax() {
    $("#helloResult").load("ajaxResponse.html");
}
function setup() {
    $("#helloButton").click(doAjax);
}
$(document).ready(setup);