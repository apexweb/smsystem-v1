var size = 0;
var markup = 0;
var buyPrice = 0;


$(document).ready(function () {


    init();

    $('.buy-price').on('change', function () {
        console.log('buy price');
        buyPrice = Number($(this).val()).toFixed(2);
        calculate();

    });

    $('.size').on('change', function () {
        console.log('size');
        size = Number($(this).val()).toFixed(2);
        calculate();
    });

    $('.markup').on('change', function () {
        console.log('markup');
        markup = Number($(this).val()).toFixed(2);
        calculate();
    });

});

function init() {
    size = Number($('.size').val()).toFixed(2);
    markup = Number($('.markup').val()).toFixed(2);
    buyPrice = Number($('.buy-price').val()).toFixed(2);

    console.log('Size', size);
    console.log('Markup', markup);
    console.log('buy price', buyPrice);
    calculate();
}


function calculate() {
    var markedup = Number(buyPrice * (+markup + +100) / 100).toFixed(2);
    var pricePerUnit = Number(markedup / size).toFixed(2);


    $('.marked-up').val(markedup);
    $('.price-per-unit').val(pricePerUnit);
}



