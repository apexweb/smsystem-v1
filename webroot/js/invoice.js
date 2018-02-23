
var price1 = 0;
var price2 = 0;


$(document).ready(function () {

    initializePrices();

    $('#invoice-second-1-price').on('change', function () {
        price1 = Number($(this).val());
        calculateFinalCost();
    });

    $('#invoice-second-2-price').on('change', function () {
        price2 = Number($(this).val());
        calculateFinalCost();
    });
});


function calculateFinalCost() {
    var totalCost = Number($('span#total-cost').text());
    var finalTotalCost = (Number(totalCost) + Number(price1) + Number(price2)).toFixed(0);
    $('span#final-cost').text(finalTotalCost);
}

function initializePrices() {
    price1 = Number($('#invoice-second-1-price').val());
    price2 = Number($('#invoice-second-2-price').val());
}