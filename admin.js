$(document).ready(function () {
    var productsVisible = false;

    $("#showProductsBtn").click(function () {
        $("#productsContainer").toggle();
        productsVisible = !productsVisible;

        if (productsVisible) {
            $(this).html("Hide Products");
        } else {
            $(this).html("Show Products");
        }
    });
});
