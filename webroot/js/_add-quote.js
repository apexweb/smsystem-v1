var productsCount = 0;
var productMAX = 29;
var productMIN = 0;

var midrailsCount = 0;
var midrailMax = 2;
var midrailMIN = 0;

var additionalsCount = 4;
var additionalMAX = 9;
var additionalMIN = 4;

var customitemsCount = 2;
var customitemMAx = 9;
var customitemMIN = 2;

var copyToMidrail = 1;


var productMcTableHtml = '';
var productResultTableHtml = '';

var midrailMcTableHtml = '';
var midrailResultTableHtml = '';

var isEdit = false;

var role, mfrole, markupRole;


var securityWindowMesh = 52;
var securityDoorMesh = 105;
var dgDoorMesh = 115;
var dgWindowMesh = 50;
var fibrDoorMesh = 0;
var fibrWindowMesh = 0;
var perfDoorMesh = 105;
var perfWindowMesh = 52;

var freightConsumables = 1.00;

//**** Hourly Rates ****//
var sdHrlyRate;// = 30.00;
var swHrlyRate;// = 30.00;
var ddHrlyRate;// = 30.00;
var dwHrlyRate;// = 30.00;
var fdHrlyRate;// = 30.00;
var fwHrlyRate;// = 30.00;
var pdHrlyRate;// = 30.00;
var pwHrlyRate;// = 30.00;


/*** Clean Ups ***/
var secWindowCleanUp;// = 30.00;
var secDoorCleanUp;//= 90.00;

var dgWindowCleanup;// = 25;
var dgDoorCleanup;// = 90;

var fibrWindowCleanup;// = 5;
var fibrDoorCleanup;// = 25;

var perfDoorCleanup;// = 80;
var perfWindowCleanup;// = 25;


/*** Product Markups ***/
var sdMarkup;
var swMarkup;
var ddMarkup;
var dwMarkup;
var fdMarkup;
var fwMarkup;
var pdMarkup;
var pwMarkup;


// **** Powder Coatings ****
var std;// = 0;
var spec1;// = 4.50;
var spec2;// = 5.50;
var spec3;// = 7.00;
var spec4;// = 8.00;


//**** Parts ****//
var sgSSMesh;// = 75.60;
var grille7mm;// = 21.51;
var petMesh;// = 10.55;
var insectMesh;// = 1.26;
var perfAliMesh;// = 82.82;


var secWinFrame;// = 4.14;
var secDoorFrame;// = 7.16;

var dgDoorFrame;// = 5.37;
var dgWindowFrame;// = 2.93;

var flyFrame;// = 1.48;

var winCnrStake;// = 0.51;
var doorCnrStake;// = 0.69;

var cnrStakeFFrame;// = 0.18; //Corner stake for F/Frame

var PVCLSeat;// = 2.37;
var PVCWedge;// = 4.69;

var rollerHinges;// = 2.15;

var singleLock;// = 23.74;
var tripleHngd;// = 66.34;
var tripleSliding;// = 66.34;

var spline;// = 0.11;

var perfSheetFixingBead;// = 3.79;


/**Midrail parts**/

var midrailPart;// = 5.09;
var crossBrace;// = 1.50;

// **********


/* Cost Variables */

var screensTotal = [];
var midrailsTotal = [];

//For Mfs:
var productsNoMarkup = [];
var midrailsNoMarkup = [];

var additionalMeters = [];
var additonalLengths = [];
var accessories = [];
var customitems = [];
var installations = [];


var SCREENS_TOTAL = 0;
var MIDRAILS_TOTAL = 0;
var SECTIONS_ACC_TOTAL = 0;
var TOTAL_BUY_PRICE = 0;


var DISCOUNT = 0;
var DISCOUNT_AMOUNT = 0;


var PRESET_INSTALLATION = 0;
var CUSTOM_INSTALLATION = 0;
var FREIGHTCOST = 0;
var INSTALLATION_TOTAL = 0;

var TOTAL_SELL_PRICE = 0;
var PROFIT = 0; // install not included
var CUSTOM_QUOTED_AMOUNT = 0;


function calculateScreensTotal() {
    SCREENS_TOTAL = (screensTotal.reduce(sum, 0) + Number(getCustomItemsTotal())).toFixed(2);
    console.log(SCREENS_TOTAL);
    $('#screens-total').val(SCREENS_TOTAL);
    calculateTotalBuy();
}

function calculateMidrailsTotal() {
    MIDRAILS_TOTAL = (midrailsTotal.reduce(sum, 0)).toFixed(2);
    console.log(MIDRAILS_TOTAL);
    $('#midrails-total').val(MIDRAILS_TOTAL);
    calculateTotalBuy();
}

function calculateAddtionalsTotal() {
    SECTIONS_ACC_TOTAL = (additionalMeters.reduce(sum, 0) + additonalLengths.reduce(sum, 0) + accessories.reduce(sum, 0) + Number(getCustomItemsTotal())).toFixed(2);
    $('#section-acc-total').val(SECTIONS_ACC_TOTAL);
    calculateTotalBuy();
}

function calculateProfit() {
    PROFIT = (markups.getTotalMarkups() - Number(DISCOUNT_AMOUNT)).toFixed(2);
    PROFIT = (Number(PROFIT) + Number(getCustomItemsMarkups())).toFixed(2);
    $('#profit').val(PROFIT);

}


function getCustomItemsMarkups() {
    var markup = 0;
    $.each(customitems, function (i, item) {
        markup += Number(item[2]);

    });
    return markup.toFixed(2);
}

function getCustomItemsTotal() {
    var total = 0;

    $.each(customitems, function (i, item) {

        if (item[0]) { // if Ticked
            total += Number(item[1]);
        }
    });
    return total.toFixed(2);
}

function getCustomItemsCharged() {
    var totalCharged = 0;

    $.each(customitems, function (i, item) {

        totalCharged += Number(item[3])
    });
    return totalCharged.toFixed(2);
}


function calculateCustomItems() {

    calculateScreensTotal();
    calculateAddtionalsTotal();

    $('#discount').trigger('change');
    calculateProfit();
}


function calculateTotalBuy() {
    TOTAL_BUY_PRICE = Number(Number(SCREENS_TOTAL) + Number(MIDRAILS_TOTAL) + Number(SECTIONS_ACC_TOTAL) - Number(getCustomItemsTotal())).toFixed(2);
    $('#total-buy-price').val(TOTAL_BUY_PRICE);
    calculateTotalSell();
}


function calculateTotalSell() {
    TOTAL_SELL_PRICE = (Number(TOTAL_BUY_PRICE) + Number(markups.getTotalMarkups()) - Number(DISCOUNT_AMOUNT) + Number(INSTALLATION_TOTAL)).toFixed(2);
    TOTAL_SELL_PRICE = (Number(TOTAL_SELL_PRICE) + Number(getCustomItemsCharged()) - Number(getCustomItemsTotal())).toFixed(2);
    $('#total-sell-price').val(TOTAL_SELL_PRICE);

    if (role == 'manufacturer') {
        calculateMfTotalCost();
    }
}


function calculateInstallation(productRow, index, isAdd) {
    var installation = 0;

    var qty = Number(productRow.find('.product-qty').val());


    if (qty > 0) {

        var secDgFibr = productRow.find('.product-sec-dg-fibr').val();
        var winDoor = productRow.find('.product-win-door').val();

        if (secDgFibr == 'Security' || secDgFibr == 'D/Grille') {
            if (winDoor == 'Window') {
                installation = 25 * qty;
            } else if (winDoor == 'Door') {
                installation = 55 * qty;
            }
        } else if (secDgFibr == 'Fibre') {
            if (winDoor == 'Window') {
                installation = 10 * qty;
            } else if (winDoor == 'Door') {
                installation = 25 * qty;
            }
        }
    }
    if (isAdd) {
        installations[index] = installation;
    } else {
        installations.splice(index, 1);
    }

    PRESET_INSTALLATION = Number(installations.reduce(sum, 0)).toFixed(2);
    $('input[name="installation_preset_amount"]').val(PRESET_INSTALLATION);
    calculateTotalInstallation();

}


function calculateTotalInstallation() {
    var installationType = $('input[name="installation_type"]:checked').val();
    var installationValue = 0;

    //console.log(installationType);

    if (installationType == 'preset amount') {
        installationValue = PRESET_INSTALLATION;
    } else if (installationType == 'custom amount') {
        installationValue = CUSTOM_INSTALLATION;
    }

    INSTALLATION_TOTAL = (Number(installationValue) + Number(FREIGHTCOST)).toFixed(2);

    $('input[name="installation_total_cost"]').val(INSTALLATION_TOTAL);
    $('input#installation-amount').val(INSTALLATION_TOTAL);
    calculateTotalSell();
}


function calculateMfTotalCost() {
    var totalCost = (Number(productsNoMarkup.reduce(sum, 0)) + Number(midrailsNoMarkup.reduce(sum, 0)) +
    Number(additionalMeters.reduce(sum, 0)) + Number(additonalLengths.reduce(sum, 0)) +
    Number(accessories.reduce(sum, 0)) + Number(getCustomItemsCharged())).toFixed(2);
    $('#mf-total-cost').val(totalCost);
}

// **********


$(document).ready(function () {

    $('.created-date').val(getDate());

    $('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd/mm/yyyy",
    });

    initializePartsVariables();
    initializeTableVariables();
    initializeRole();


    $('input[name="installation_type"]').on('change', function () {
        var value = $(this).val();
        if (value == 'preset amount') {
            $('input[name="installation_preset_amount"]').show();
            $('input[name="installation_custom_amount"]').hide();
            $('.installation-label').text('Preset Amount:');

        } else if (value == 'custom amount') {
            $('input[name="installation_preset_amount"]').hide();
            $('input[name="installation_custom_amount"]').show();
            $('.installation-label').text('Custom Amount:');
        }
        calculateTotalInstallation();
    });

    $('input[name="installation_custom_amount"]').on('change', function () {
        CUSTOM_INSTALLATION = Number($(this).val());
        calculateTotalInstallation();
    });

    $('input[name="freight_cost"]').on('change', function () {
        FREIGHTCOST = Number($(this).val());
        calculateTotalInstallation();
    });


    $('.panel-heading a').on('click', function () {
        if ($(this).hasClass('collapsed')) {
            $(this).addClass('panel-open-a');
        } else {
            $(this).removeClass('panel-open-a');
        }
    });


    $('#add-product-btn').on('click', function () {

        if (productsCount >= productMAX) {
            return;
        }

        var options = $('#product-options-row-' + productsCount).html();
        var prices = $('#product-prices-row-' + productsCount).html();


        var numberOfTds = $('#product-options-row-' + productsCount + ' td').length;
        for (var i = 0; i < numberOfTds; i++) {
            options = options.replace('products[' + productsCount + ']', 'products[' + (productsCount + 1) + ']');
            options = options.replace('products-' + productsCount, 'products-' + (productsCount + 1));
            options = options.replace('selected="selected"', '');
            prices = prices.replace('products[' + productsCount + ']', 'products[' + (productsCount + 1) + ']');
            prices = prices.replace('products-' + productsCount, 'products-' + (productsCount + 1));
        }
        options = options.replace('visibility: hidden', 'visibility: visible');
        prices = prices.replace('row-' + productsCount, 'row-' + (productsCount + 1));


        $('.product-table').append('<tr id="product-options-row-' + (productsCount + 1) + '" class="product-options-row">' + options + '</tr>');
        $('.product-table').append('<tr id="product-prices-row-' + (productsCount + 1) + '" class="product-prices-row">' + prices + '</tr>');


        if (isEdit) {
            var newRow = $('.product-table').find('tr').last().prev();
            newRow.find('select').val('');
            newRow.find('input').val('');
            newRow.find('input[type="hidden"]').remove();
            newRow.next().find('input[type="checkbox"]').prop('checked', false);
            newRow.next().find('input.product-price-incl-gst').val('');
        }


        // Hidden the Last Row Delete button
        $('.product-table tr').eq(((productsCount + 1) * 2) - 1).find('td').last().find('button').css('visibility', 'hidden');
        //***************

        productsCount++;

        if (productsCount > 0) {
            var productMcTable = productMcTableHtml.replace('product-mc-0', 'product-mc-' + productsCount);
            var productResultTable = productResultTableHtml.replace('product-result-0', 'product-result-' + productsCount);
            $('#products-mc-container').append('<div class="clearfix"></div>');
            $('#products-mc-container').append(productMcTable);
            $('#products-mc-container').append(productResultTable);
        }

        if (productsCount >= productMAX) {
            $('.product-btns').css('visibility', 'hidden');
        }

    });


    $('body').on('click', '.product-delete', function () {
        var productRow = $(this).parents('tr');
        var pricesRow = productRow.next();
        var productIndex = findIndexById(productRow);
        var secdgfibr = productRow.find('.product-sec-dg-fibr').val();


        /** Get Master Calculator Tables (Must be removed) **/
        var productMc = $('#product-mc-' + productIndex).parent();
        var productRes = productMc.next();
        var productClrFix = productMc.prev();


        if (isEdit) {
            var id = $('[name="products[' + productIndex + '][id]"]').val();
            if (id) {
                $('input[name="products_to_delete"]').val(id + ',' + $('input[name="products_to_delete"]').val());
            }
        }

        productRow.remove();
        pricesRow.remove();

        productMc.remove();
        productRes.remove();
        productClrFix.remove();

        productsCount--;
        $('.product-btns').css('visibility', 'visible');


        // Show the Last Row Delete button
        if (productsCount > 0) {
            $('.product-table tr').eq(((productsCount + 1) * 2) - 1).find('td').last().find('button').css('visibility', 'visible');
        }
        //***************

        calculateInstallation(productRow, productIndex, false);

        productsNoMarkup.splice(productIndex, 1);
        screensTotal.splice(productIndex, 1);
        calculateScreensTotal();
        //calculateProductsMarkups();
        markups.deleteFromMarkup(secdgfibr, productIndex)
    });


    $('#copy-product-btn').on('click', function () {


        /* Addd New Item */
        $('#add-product-btn').trigger('click');


        /* Copy before last row's values to Last Row */
        var beforeLastRow = productsCount - 1;

        $('[name="products[' + productsCount + '][product_item_number]"]').val($('[name="products[' + beforeLastRow + '][product_item_number]"]').val());
        $('[name="products[' + productsCount + '][product_qty]"]').val($('[name="products[' + beforeLastRow + '][product_qty]"]').val());
        $('[name="products[' + productsCount + '][product_sec_dig_perf_fibr]"]').val($('[name="products[' + beforeLastRow + '][product_sec_dig_perf_fibr]"]').val());
        $('[name="products[' + productsCount + '][product_316_ss_gal_pet]"]').val($('[name="products[' + beforeLastRow + '][product_316_ss_gal_pet]"]').val());
        $('[name="products[' + productsCount + '][product_window_or_door]"]').val($('[name="products[' + beforeLastRow + '][product_window_or_door]"]').val());
        $('[name="products[' + productsCount + '][product_window_frame_type]"]').val($('[name="products[' + beforeLastRow + '][product_window_frame_type]"]').val());
        $('[name="products[' + productsCount + '][product_configuration]"]').val($('[name="products[' + beforeLastRow + '][product_configuration]"]').val());
        $('[name="products[' + productsCount + '][product_location_in_building]"]').val($('[name="products[' + beforeLastRow + '][product_location_in_building]"]').val());
        $('[name="products[' + productsCount + '][product_height]"]').val($('[name="products[' + beforeLastRow + '][product_height]"]').val());
        $('[name="products[' + productsCount + '][product_width]"]').val($('[name="products[' + beforeLastRow + '][product_width]"]').val());
        $('[name="products[' + productsCount + '][product_number_of_locks]"]').val($('[name="products[' + beforeLastRow + '][product_number_of_locks]"]').val());
        $('[name="products[' + productsCount + '][product_lock_type]"]').val($('[name="products[' + beforeLastRow + '][product_lock_type]"]').val());
        $('[name="products[' + productsCount + '][product_lock_handle_height]"]').val($('[name="products[' + beforeLastRow + '][product_lock_handle_height]"]').val());
        $('#products-' + productsCount + '-product-emergency-window').prop('checked', $('#products-' + beforeLastRow + '-product-emergency-window').is(':checked'));


        //Trigger 'Change' on copied product's QTY option to calculate the new copied product costs
        $('[name="products[' + productsCount + '][product_qty]"]').trigger('change');

    });

    $('body').on('click', '.copy-to-midrail-btn', function () {

        if (copyToMidrail > 3) {
            return;
        }

        var product = $(this).parents('tr').prev();

        var itemNo = Number(product.find('.product-item-no').val());
        var qty = Number(product.find('.product-qty').val());
        var secDigFibr = product.find('.product-sec-dg-fibr').val();
        var ssgalpet = product.find('.product-ss-gal-pet').val();
        var winDoor = product.find('.product-win-door').val();
        var height = Number(product.find('.product-height').val());
        var width = Number(product.find('.product-width').val());
        var conf = product.find('.product-conf').val();
        var frameType = product.find('.product-frame-type').val();


        /** Add New Midrail Row if Not exists **/
        if (!$('.midrail-table #midrail-options-row-' + (copyToMidrail - 1)).length) {
            $('#add-midrail-btn').trigger('click');

        }
        /***************************************/


        var midrail = $('.midrail-options-row').eq(copyToMidrail - 1);
        midrail.find('.midrail-item-no').val(itemNo);
        midrail.find('.midrail-qty').val(qty);
        midrail.find('.midrail-sec-dg-fibr').val(secDigFibr);
        midrail.find('.midrail-ss-gal-pet').val(ssgalpet);
        midrail.find('.midrail-win-door').val(winDoor);
        midrail.find('.midrail-frame-type').val(frameType);
        midrail.find('.midrail-conf').val(conf);
        midrail.find('.midrail-height').val(height);
        midrail.find('.midrail-width').val(width);
        midrail.find('.midrail-width').trigger('change');

        copyToMidrail++;


    });


    $('#add-midrail-btn').on('click', function () {

        if (midrailsCount >= midrailMax) {
            return;
        }

        var options = $('#midrail-options-row-' + midrailsCount).html();
        var prices = $('#midrail-prices-row-' + midrailsCount).html();


        var numberOfTds = $('#midrail-options-row-' + midrailsCount + ' td').length;
        for (var i = 0; i < numberOfTds; i++) {
            options = options.replace('midrails[' + midrailsCount + ']', 'midrails[' + (midrailsCount + 1) + ']');
            options = options.replace('midrails-' + midrailsCount, 'midrails-' + (midrailsCount + 1));
        }


        options = options.replace('visibility: hidden', 'visibility: visible');
        prices = prices.replace('row-' + midrailsCount, 'row-' + (midrailsCount + 1));
        prices = prices.replace('midrails[' + midrailsCount + '][midrail_cost]', 'midrails[' + (midrailsCount + 1) + '][midrail_cost]');
        prices = prices.replace('midrails-' + midrailsCount + '-midrail-cost', 'midrails-' + (midrailsCount + 1) + '-midrail-cost');


        $('.midrail-table').append('<tr id="midrail-options-row-' + (midrailsCount + 1) + '" class="midrail-options-row">' + options + '</tr>');
        $('.midrail-table').append('<tr id="midrail-prices-row-' + (midrailsCount + 1) + '" class="midrail-prices-row">' + prices + '</tr>');


        if (isEdit) {
            var newRow = $('.midrail-table').find('tr').last().prev();
            newRow.find('select').val('');
            newRow.find('input').val('');
            newRow.find('input[type="hidden"]').remove();
            newRow.next().find('input.midrail-price-incl-gst').val('');
        }


        // Hidden the Last Row Delete button
        $('.midrail-table tr').eq((midrailsCount + 1) * 2).find('td').last().find('button').css('visibility', 'hidden');
        //***************

        midrailsCount++;

        if (midrailsCount > 0) {
            var midrailMcTable = midrailMcTableHtml.replace('midrail-mc-0', 'midrail-mc-' + midrailsCount);
            var midrailResultTable = midrailResultTableHtml.replace('midrail-result-0', 'midrail-result-' + midrailsCount);
            $('#midrails-mc-container').append('<div class="clearfix"></div>');
            $('#midrails-mc-container').append(midrailMcTable);
            $('#midrails-mc-container').append(midrailResultTable);
        }

        if (midrailsCount >= midrailMax) {
            $('#add-midrail-btn').css('visibility', 'hidden');
        }

    });


    $('body').on('click', '.midrail-delete', function () {
        var midrailRow = $(this).parents('tr');
        var pricesRow = midrailRow.next();
        var midrailIndex = findIndexById(midrailRow);


        /** Get Master Calculator Tables (Must be removed) **/
        var midrailMc = $('#midrail-mc-' + midrailIndex).parent();
        var midrailRes = midrailMc.next();
        var midrailClrFix = midrailMc.prev();


        if (isEdit) {
            var id = $('[name="midrails[' + midrailIndex + '][id]"]').val();
            if (id) {
                $('input[name="midrails_to_delete"]').val(id + ',' + $('input[name="midrails_to_delete"]').val());
            }
        }


        midrailRow.remove();
        pricesRow.remove();

        midrailMc.remove();
        midrailRes.remove();
        midrailClrFix.remove();

        midrailsCount--;

        if (copyToMidrail > 1) {
            copyToMidrail--;
        }
        $('#add-midrail-btn').css('visibility', 'visible');


        // Show the Last Row Delete button
        if (midrailsCount > 0) {
            $('.midrail-table tr').eq((midrailsCount + 1) * 2).find('td').last().find('button').css('visibility', 'visible');
        }
        //***************

        midrailsNoMarkup.splice(midrailIndex, 1);
        midrailsTotal.splice(midrailIndex, 1);
        calculateMidrailsTotal();
    });


    $('#add-row-additional-m').on('click', function () {

        if (additionalsCount >= additionalMAX) {
            return;
        }

        var row = $('#additional-m-row-0').html();

        var numberOfTds = $('#additional-m-row-0 td').length;

        for (var i = 0; i < numberOfTds; i++) {
            row = row.replace('additionalpermeters[0]', 'additionalpermeters[' + (additionalsCount + 1) + ']');
            row = row.replace('additionalpermeters-0', 'additionalpermeters-' + (additionalsCount + 1));
            row = row.replace('selected="selected"', '');
        }
        row = row.replace('visibility: hidden', 'visibility: visible');


        // Hidden the Last Row Delete button
        $('.additional-m-table tr').last().find('td').last().find('button').css('visibility', 'hidden');
        //***************

        $('.additional-m-table').append('<tr id="additional-m-row-' + (additionalsCount + 1) + '">' + row + '</tr>');
        additionalsCount++;


        if (isEdit) {
            var newRow = $('.additional-m-table').find('tr').last();
            newRow.find('input').val('');
            newRow.find('select').val('');
            newRow.find('input[type="hidden"]').remove();
        }


        if (additionalsCount >= additionalMAX) {
            $(this).css('visibility', 'hidden');
        }
    });

    $('body').on('click', '.addtional-m-delete', function () {
        var additionalRow = $(this).parents('tr');
        var index = findIndexById(additionalRow);


        if (isEdit) {
            var id = $('[name="additionalpermeters[' + index + '][id]"]').val();
            if (id) {
                $('input[name="additional_m_to_delete"]').val(id + ',' + $('input[name="additional_m_to_delete"]').val());
            }
        }


        additionalRow.remove();
        additionalsCount--;
        $('#add-row-additional-m').css('visibility', 'visible');


        // Show the Last Row Delete button
        if (additionalsCount > 4) {
            $('.additional-m-table tr').last().find('td').last().find('button').css('visibility', 'visible');
        }
        //***************

        additionalMeters.splice(index, 1);
        calculateAddtionalsTotal();
    });


    $('#add-row-customitem').on('click', function () {

        if (customitemsCount >= customitemMAx) {
            return;
        }


        var row = $('#customitem-row-0').html();
        var numberOfTds = $('#customitem-row-0 td').length;

        for (var i = 0; i < numberOfTds; i++) {
            row = row.replace('customitems[0]', 'customitems[' + (customitemsCount + 1) + ']');
            row = row.replace('customitems-0', 'customitems-' + (customitemsCount + 1));
            row = row.replace('checked="checked"', '');
        }
        row = row.replace('visibility: hidden', 'visibility: visible');


        // Hidden the Last Row Delete button
        $('.customitem-table').last().find('td').last().find('button').css('visibility', 'hidden');
        //***************


        $('.customitem-table').append('<tr id="customitem-row-' + (customitemsCount + 1) + '">' + row + '</tr>');

        customitemsCount++;

        if (isEdit) {
            var newRow = $('.customitem-table').find('tr').last();
            newRow.find('input[type="hidden"]').remove();
            newRow.find('input').val('');
            newRow.find('input[type="checkbox"]').prop('checked', false);
        }

        if (customitemsCount >= customitemMAx) {
            $('#add-row-customitem').css('visibility', 'hidden');
        }

    });


    $('body').on('click', '.customitem-delete', function () {
        var customitemRow = $(this).parents('tr');
        var index = findIndexById(customitemRow);


        if (isEdit) {
            var id = $('[name="customitems[' + index + '][id]"]').val();
            if (id) {
                $('input[name="customitems_to_delete"]').val(id + ',' + $('input[name="customitems_to_delete"]').val());
            }
        }


        customitemRow.remove();
        customitemsCount--;
        $('#add-row-customitem').css('visibility', 'visible');


        // Show the Last Row Delete button
        if (customitemsCount > 2) {
            $('.customitem-table tr').last().find('td').last().find('button').css('visibility', 'visible');
        }
        //***************

        customitems.splice(index, 1);
        calculateCustomItems();
    });


    /*** Products On change Event => Calculator ***/
    $('body').on('change', '.product-options', function () {


        var product = $(this).parents('.product-options-row');
        var productOptions = product.next();
        var productId = product.attr('id');
        var productIndex = findIndexById(product);


        var qty = Number(product.find('.product-qty').val());
        var secDigFibr = product.find('.product-sec-dg-fibr').val();
        var ssgalpet = product.find('.product-ss-gal-pet').val();
        var winDoor = product.find('.product-win-door').val();
        var height = Number(product.find('.product-height').val());
        var width = Number(product.find('.product-width').val());
        var lockCounts = Number(product.find('.product-lock-count').val());
        var lockType = product.find('.product-lock-type').val();
        //var lockHeight = Number(product.find('.product-lock-height').val());
        var emergencyWindow = productOptions.find('.product-emergency').is(':checked');


        //**** Get Master Calculator Tables *****
        var productMc = $('table#product-mc-' + productIndex);
        var productResult = $('table#product-result-' + productIndex);


        var isSecDoor = false;
        var isSecWindow = false;
        var isDgDoor = false;
        var isDgWindow = false;
        var isFibrDoor = false;
        var isFibrWindow = false;
        var isPerfDoor = false;
        var isPerfWindow = false;


        /*Remove The Orange and Blue colors from the mc table*/

        productMc.find('tr.secdigfibr-container td').removeClass('door-style').removeClass('window-style');
        productMc.find('tr.windoor-container td:first').removeClass('door-style').removeClass('window-style');

        /***********************/


        if (secDigFibr == 'Security') {
            if (winDoor == 'Door') {

                isSecDoor = true;
                productMc.find('span.product-mc-secdigfibr').text('Security');
                productMc.find('span.product-mc-windoor').text('Doors');


            } else if (winDoor == 'Window') {

                isSecWindow = true;
                productMc.find('span.product-mc-secdigfibr').text('Security');
                productMc.find('span.product-mc-windoor').text('Windows');


            }
        } else if (secDigFibr == 'D/Grille') {
            if (winDoor == 'Door') {

                isDgDoor = true;
                productMc.find('span.product-mc-secdigfibr').text('D/Grille');
                productMc.find('span.product-mc-windoor').text('Doors');

            } else if (winDoor == 'Window') {

                isDgWindow = true;
                productMc.find('span.product-mc-secdigfibr').text('D/Grille');
                productMc.find('span.product-mc-windoor').text('Windows');
            }

        } else if (secDigFibr == 'Fibre') {
            if (winDoor == 'Door') {

                isFibrDoor = true;
                productMc.find('span.product-mc-secdigfibr').text('Fibre');
                productMc.find('span.product-mc-windoor').text('Doors');

            } else if (winDoor == 'Window') {

                isFibrWindow = true;
                productMc.find('span.product-mc-secdigfibr').text('Fibre');
                productMc.find('span.product-mc-windoor').text('Windows');
            }
        } else if (secDigFibr == 'Perf Ali') {
            if (winDoor == 'Door') {

                isPerfDoor = true;
                productMc.find('span.product-mc-secdigfibr').text('Perforated Aluminium');
                productMc.find('span.product-mc-windoor').text('Doors');


            } else if (winDoor == 'Window') {
                isPerfWindow = true;
                productMc.find('span.product-mc-secdigfibr').text('Perforated Aluminium');
                productMc.find('span.product-mc-windoor').text('Windows');
            }
        }


        /*Set the Orange color too Door mc table, and the Blue color to Window mc table*/

        if (isSecDoor || isDgDoor || isFibrDoor || isPerfDoor) {
            productMc.find('tr.secdigfibr-container td').addClass('door-style');
            productMc.find('tr.windoor-container td:first').addClass('door-style');
        } else if (isSecWindow || isDgWindow || isFibrWindow || isPerfWindow) {
            productMc.find('tr.secdigfibr-container td').addClass('window-style');
            productMc.find('tr.windoor-container td:first').addClass('window-style');
        }

        /**********************/


        // **** Hide or Show MC Tabels ****
        if (isSecDoor || isSecWindow || isDgDoor || isDgWindow || isFibrDoor || isFibrWindow || isPerfDoor || isPerfWindow) {
            productMc.show();
            productResult.show();
        } else {
            productMc.hide();
            productResult.hide();
        }
        /*****************/


        productMc.find('span.product-height').text(height);
        productMc.find('span.product-width').text(width);


        var pwdCoat = ((width + height) * 2 / 5000).toFixed(1);
        productMc.find('span.product-coat').text(pwdCoat);


        var productLmtr = ((width + height) * 2 / 1000).toFixed(1);
        productMc.find('span.product-lmtrs').text(productLmtr);


        //**** Common Variables (Window or Door) ****
        var heightMesh = 0;
        var widthMesh = 0;
        var frame = 0;
        var cnrStake = 0;
        var hingedCalculated = 0;
        var cleanUp = 0;
        var hrlyRate = 0;
        var sqmPart = 0;
        var markup = 0;

        var hasSpline = false;
        var hasInsectMesh = false;
        var hasComponentsHinges = false;
        var hasPvc = false;
        var hasPerfSheetFixing = false;


        if (isSecDoor) {
            heightMesh = Number(height - securityDoorMesh);
            widthMesh = Number(width - securityDoorMesh);
            productMc.find('span.product-winframe-name').text('Door Frame');
            productMc.find('span.product-win-cnrstake-name').text('Door Crn stake');
            frame = secDoorFrame;
            cnrStake = doorCnrStake;
            cleanUp = secDoorCleanUp;
            hrlyRate = sdHrlyRate;
            sqmPart = sgSSMesh;
            hasComponentsHinges = true;
            hasPvc = true;
            markup = sdMarkup;

        } else if (isSecWindow) {
            heightMesh = Number(height - securityWindowMesh);
            widthMesh = Number(width - securityWindowMesh);
            productMc.find('span.product-winframe-name').text('Window Frame');
            productMc.find('span.product-win-cnrstake-name').text('Window Crn Stake 11mm');
            frame = secWinFrame;
            cnrStake = winCnrStake;
            cleanUp = secWindowCleanUp;
            hrlyRate = swHrlyRate;
            sqmPart = sgSSMesh;
            hasPvc = true;
            markup = swMarkup;

        } else if (isDgDoor) {
            heightMesh = Number(height - dgDoorMesh);
            widthMesh = Number(width - dgDoorMesh);
            productMc.find('span.product-winframe-name').text('D/Grille Door Frame MF');
            productMc.find('span.product-win-cnrstake-name').text('Door Corner Stake 4');
            sqmPart = grille7mm;
            frame = secDoorFrame;
            cnrStake = doorCnrStake;
            hasSpline = true;
            cleanUp = dgDoorCleanup;
            hrlyRate = ddHrlyRate;
            hasComponentsHinges = true;
            hasInsectMesh = true;
            markup = ddMarkup;

        } else if (isDgWindow) {
            heightMesh = Number(height - dgWindowMesh);
            widthMesh = Number(width - dgWindowMesh);
            productMc.find('span.product-winframe-name').text('D/Grille Window Frame MF');
            productMc.find('span.product-win-cnrstake-name').text('Window Cnr stake 11mm');
            sqmPart = grille7mm;
            frame = secWinFrame;
            cnrStake = winCnrStake;
            cleanUp = dgWindowCleanup;
            hrlyRate = dwHrlyRate;
            hasSpline = true;
            hasInsectMesh = true;
            markup = dwMarkup;

        } else if (isFibrDoor) {
            heightMesh = height;
            widthMesh = width;
            productMc.find('span.product-winframe-name').text('D/Grille Window Frame MF');
            productMc.find('span.product-win-cnrstake-name').text('Corner stakes 4');
            hasComponentsHinges = true;
            frame = secDoorFrame;
            if (ssgalpet == 'Pet') {
                sqmPart = petMesh;
            } else {
                sqmPart = insectMesh;
            }
            cnrStake = winCnrStake;
            hasSpline = true;
            cleanUp = fibrDoorCleanup;
            hrlyRate = fdHrlyRate;
            markup = fdMarkup;

        } else if (isFibrWindow) {
            heightMesh = height;
            widthMesh = width;
            productMc.find('span.product-winframe-name').text('Fly Frame');
            productMc.find('span.product-win-cnrstake-name').text('Corner stakes 4');
            hasSpline = true;
            frame = flyFrame;
            if (ssgalpet == 'Pet') {
                sqmPart = petMesh;
            } else {
                sqmPart = insectMesh;
            }
            cnrStake = cnrStakeFFrame;
            cleanUp = fibrWindowCleanup;
            hrlyRate = fwHrlyRate;
            markup = fwMarkup;

        } else if (isPerfDoor) {

            heightMesh = Number(height - perfDoorMesh);
            widthMesh = Number(width - perfDoorMesh);
            productMc.find('span.product-winframe-name').text('D/Grille Door Frame');
            productMc.find('span.product-win-cnrstake-name').text('Door Cnr stake');
            sqmPart = perfAliMesh;
            frame = dgDoorFrame;
            cnrStake = doorCnrStake;
            cleanUp = perfDoorCleanup;
            hrlyRate = pdHrlyRate;
            hasComponentsHinges = true;
            hasPerfSheetFixing = true;
            markup = pdMarkup;

        } else if (isPerfWindow) {
            heightMesh = Number(height - perfWindowMesh);
            widthMesh = Number(width - perfWindowMesh);
            productMc.find('span.product-winframe-name').text('D/Grille  Window Frame');
            productMc.find('span.product-win-cnrstake-name').text('Window Crn stake 11mm');
            sqmPart = perfAliMesh;
            frame = dgWindowFrame;
            cnrStake = winCnrStake;
            cleanUp = perfWindowCleanup;
            hrlyRate = pwHrlyRate;
            hasPerfSheetFixing = true;
            markup = pwMarkup;
        }


        productMc.find('span.product-mesh-height').text(heightMesh);
        productMc.find('span.product-mesh-width').text(widthMesh);

        var sqm = (heightMesh * widthMesh / 1000000).toFixed(3);
        productMc.find('span.product-sqm').text(sqm);

        var sqmCalculated = (sqm * sqmPart).toFixed(2);
        productMc.find('span.product-sqm-calculated').text(sqmCalculated);

        productMc.find('span.product-winframe-price').text(frame);

        var frameCalculated = (frame * productLmtr).toFixed(2);
        productMc.find('span.product-winframe-calculated').text(frameCalculated);


        productMc.find('span.product-win-cnrstake-price').text(cnrStake);

        var cnrstakeCalculated = (cnrStake * 4).toFixed(2);
        productMc.find('span.product-win-cnrstake-calculated').text(cnrstakeCalculated);


        var lSeatCalculated = 0;
        var pvcCalculated = 0;
        var splineCalculated = 0;
        var perfSheetFixingCalculated = 0;
        var insectMeshCalculated = 0;

        if (hasSpline) {

            splineCalculated = (spline * productLmtr).toFixed(2);
            productMc.find('tr.spline-row').show();
            productMc.find('span.product-spline').text(spline);
            productMc.find('span.product-spline-calculated').text(splineCalculated);

        } else {
            productMc.find('tr.spline-row').hide();
        }

        if (hasInsectMesh) {
            productMc.find('tr.insect-mesh-row').show();

            if (ssgalpet == 'Insect') {
                insectMeshCalculated = (sqm * insectMesh).toFixed(2);
            } else {
                insectMeshCalculated = (sqm * petMesh).toFixed(2);
            }
            productMc.find('span.product-insect-mesh').text(insectMeshCalculated);
        } else {
            productMc.find('tr.insect-mesh-row').hide();
        }

        if (hasPvc) {
            productMc.find('tr.pvc-row').show();
            productMc.find('tr.lseat-row').show();
            productMc.find('span.product-lseat-price').text(PVCLSeat);

            lSeatCalculated = (PVCLSeat * productLmtr).toFixed(2);
            productMc.find('span.product-lseat-calculated').text(lSeatCalculated);

            productMc.find('span.product-pvc-wedge-price').text(PVCWedge);

            pvcCalculated = (PVCWedge * productLmtr).toFixed(2);
            productMc.find('span.product-pvc-wedge-calculated').text(pvcCalculated);

        } else {
            productMc.find('tr.pvc-row').hide();
            productMc.find('tr.lseat-row').hide();
        }

        if (hasComponentsHinges) {
            hingedCalculated = (rollerHinges * 4).toFixed(2);
            productMc.find('span.product-components-wheels-hinges').text(rollerHinges);
            productMc.find('span.product-components-wheels-hinges-calculated').text(hingedCalculated);
            productMc.find('tr.components-row').show();
        } else {
            productMc.find('tr.components-row').hide();
        }

        if (hasPerfSheetFixing) {

            productMc.find('tr.perf-sheet-row').show();
            productMc.find('span.product-perf-sheet-fixing').text(PVCLSeat);
            if (isPerfDoor) {
                perfSheetFixingCalculated = (PVCLSeat * perfSheetFixingBead).toFixed(2);
            } else if (isPerfWindow) {
                perfSheetFixingCalculated = (PVCLSeat * productLmtr).toFixed(2);
            }

            productMc.find('span.product-perf-sheet-fixing-calculated').text(perfSheetFixingCalculated);

        } else {
            productMc.find('tr.perf-sheet-row').hide();
        }


        productMc.find('span.product-freight-consumables').text(freightConsumables);


        var pwdCoatSpec1 = 0.00;
        var pwdCoatSpec2 = 0.00;
        var pwdCoatSpec3 = 0.00;
        var pwdCoatSpec4 = 0.00;


        //*** Calculates Powder Coats ****
        if ($('[name="color1_color"]').val() && $('[name="color1"]').is(':checked')) {
            pwdCoatSpec1 = (spec1 * pwdCoat).toFixed(2);
        }
        if ($('[name="color2_color"]').val() && $('[name="color2"]').is(':checked')) {
            pwdCoatSpec2 = (spec2 * pwdCoat).toFixed(2);
        }

        if ($('[name="color3_color"]').val() && $('[name="color3"]').is(':checked')) {
            pwdCoatSpec3 = (spec3 * pwdCoat).toFixed(2);
        }

        if ($('[name="color4_color"]').val() && $('[name="color4"]').is(':checked')) {
            pwdCoatSpec4 = (spec4 * pwdCoat).toFixed(2);
        }


        productMc.find('span.product-pwdcoat-spec-1').text(pwdCoatSpec1);
        productMc.find('span.product-pwdcoat-spec-2').text(pwdCoatSpec2);
        productMc.find('span.product-pwdcoat-spec-3').text(pwdCoatSpec3);
        productMc.find('span.product-pwdcoat-spec-4').text(pwdCoatSpec4);


        // Sum of All "Calculated" Values:
        var materialCost = 0.00;

        if (secDigFibr && winDoor) {
            materialCost = (Number(sqmCalculated) + Number(frameCalculated) + Number(perfSheetFixingCalculated)
            + Number(insectMeshCalculated)
            + Number(cnrstakeCalculated) + Number(lSeatCalculated) + Number(pvcCalculated)
            + Number(pwdCoatSpec1) + Number(pwdCoatSpec2) + Number(pwdCoatSpec3) + Number(pwdCoatSpec4)
            + Number(splineCalculated) + Number(freightConsumables) + Number(hingedCalculated)).toFixed(2);
        }

        productMc.find('span.product-material-cost').text(materialCost);


        var labourIncCutting = ((hrlyRate / 60) * cleanUp).toFixed(2);
        productMc.find('span.product-labour-incl-cutting').text(labourIncCutting);


        var totalCost = (Number(materialCost) + Number(labourIncCutting)).toFixed(2);
        var increasedTotalCost = (totalCost * (Number(markup) + Number(100)) / 100).toFixed(2);


        productMc.find('span.product-total-cost').text(totalCost);
        productResult.find('span.product-result-cost').text(increasedTotalCost);
        productResult.find('span.product-result-quantity').text(qty);


        var locksTotalCost = 0;
        if (lockType == 'Single') {
            locksTotalCost = (singleLock * lockCounts).toFixed(2);
        } else if (lockType == 'Trple Hngd') {
            locksTotalCost = (tripleHngd * lockCounts).toFixed(2);
        } else if (lockType == 'Trple Sldng') {
            locksTotalCost = (tripleSliding * lockCounts).toFixed(2);
        }


        calculateInstallation(product, productIndex, true);

        productResult.find('span.product-result-locks').text(locksTotalCost);

        var resultTotal = (Number(increasedTotalCost * qty) + Number(locksTotalCost)).toFixed(2);
        productResult.find('span.product-result-total').text(resultTotal);


        var masterMarkup = 0;
        switch (secDigFibr) {
            case 'Security':
            case 'Perf Ali':
                masterMarkup = Number($('.secperf-' + markupRole).text());
                break;
            case 'D/Grille':
            case 'Fibre':
                masterMarkup = Number($('.dgfibr-' + markupRole).text());
                break;
        }


        console.log(masterMarkup);

        var priceInclGst = Number(resultTotal * (Number(masterMarkup) + Number(100)) / 100).toFixed(2);
        var priceIncGstPlusEmergency = priceInclGst;
        if (emergencyWindow) {
            priceIncGstPlusEmergency = (Number(priceInclGst) + Number(140)).toFixed(2);
        }

        productsNoMarkup[productIndex] = resultTotal;
        screensTotal[productIndex] = priceIncGstPlusEmergency;

        productOptions.find('input.product-price-incl-gst').val(priceIncGstPlusEmergency);
        productOptions.find('input.price-incl-gst-not-emergency').val(priceInclGst); //Hidden Field

        calculateScreensTotal();


        //calculateProductsMarkups();

        var sellPrice = priceIncGstPlusEmergency;
        if (role != 'retailer' && mfrole != 'retailer') {
            if (secDigFibr) {
                var selector = getMarkupInputID(secDigFibr);
                sellPrice = ((priceInclGst * Number($(selector).val()) / 100) + Number(priceIncGstPlusEmergency)).toFixed(2);

            }
        }
        var profit = (Number(sellPrice) - Number(priceIncGstPlusEmergency)).toFixed(2);

        markups.addToMarkups(profit, productIndex, secDigFibr);


        productOptions.find('input.product-sell-price').val(sellPrice);
        productOptions.find('input.product-profit').val(profit);


    });


    $('body').on('change', '.product-emergency', function () {
        $(this).parents('tr').prev().find('.product-qty').trigger('change');
    });


    /* Midrails On change Event => Calculator */
    $('body').on('change', '.midrail-options', function () {

        var midrail = $(this).parents('.midrail-options-row');
        var midrailOption = midrail.next();
        var midrailIndex = findIndexById(midrail);

        //console.log('index is: ' + midrailIndex);


        var qty = Number(midrail.find('.midrail-qty').val());
        var secDigFibr = midrail.find('.midrail-sec-dg-fibr').val();
        //var ssgalpet = midrail.find('.midrail-ss-gal-pet').val();
        var winDoor = midrail.find('.midrail-win-door').val();
        var height = Number(midrail.find('.midrail-height').val());
        var width = Number(midrail.find('.midrail-width').val());


        //**** Get Master Calculator Tables *****
        var midrailMc = $('table#midrail-mc-' + midrailIndex);
        var midrailResult = $('table#midrail-result-' + midrailIndex);


        var isSecDoor = false;
        var isSecWindow = false;
        var isDgDoor = false;
        var isDgWindow = false;
        var isFibrDoor = false;
        var isFibrWindow = false;


        /*Remove The Orange and Blue colors from the mc table*/

        midrailMc.find('tr.secdgfibr-container td').removeClass('door-style').removeClass('window-style');
        midrailMc.find('tr.windoor-container td:eq(1)').removeClass('door-style').removeClass('window-style');

        /***********************/


        if (secDigFibr == 'Security') {
            if (winDoor == 'Door') {

                isSecDoor = true;
                midrailMc.find('span.midrail-mc-secdgfibr').text('Security');
                midrailMc.find('span.midrail-mc-windoor').text('Doors');


            } else if (winDoor == 'Window') {

                isSecWindow = true;
                midrailMc.find('span.midrail-mc-secdgfibr').text('Security');
                midrailMc.find('span.midrail-mc-windoor').text('Windows');


            }
        } else if (secDigFibr == 'D/Grille') {
            if (winDoor == 'Door') {

                isDgDoor = true;
                midrailMc.find('span.midrail-mc-secdgfibr').text('D/Grille');
                midrailMc.find('span.midrail-mc-windoor').text('Doors');

            } else if (winDoor == 'Window') {

                isDgWindow = true;
                midrailMc.find('span.midrail-mc-secdgfibr').text('D/Grille');
                midrailMc.find('span.midrail-mc-windoor').text('Windows');
            }

        } else if (secDigFibr == 'Fibre') {
            if (winDoor == 'Door') {

                isFibrDoor = true;
                midrailMc.find('span.midrail-mc-secdgfibr').text('Fibre');
                midrailMc.find('span.midrail-mc-windoor').text('Doors');

            } else if (winDoor == 'Window') {

                isFibrWindow = true;
                midrailMc.find('span.midrail-mc-secdgfibr').text('Fibre');
                midrailMc.find('span.midrail-mc-windoor').text('Windows');
            }
        }


        /*Set the Orange color too Door mc table, and the Blue color to Window mc table*/

        if (isSecDoor || isDgDoor || isFibrDoor) {
            midrailMc.find('tr.secdgfibr-container td').addClass('door-style');
            midrailMc.find('tr.windoor-container td:eq(1)').addClass('door-style');
        } else if (isSecWindow || isDgWindow || isFibrWindow) {
            midrailMc.find('tr.secdgfibr-container td').addClass('window-style');
            midrailMc.find('tr.windoor-container td:eq(1)').addClass('window-style');
        }

        /**********************/


        // **** Hide or Show midrail MC Tabels ****
        if (isSecDoor || isSecWindow || isDgDoor || isDgWindow || isFibrDoor || isFibrWindow) {
            midrailMc.show();
            midrailResult.show();
        } else {
            midrailMc.hide();
            midrailResult.hide();
        }
        /*****************/


        /*****/

        var midrailTimeAlloMins = 15;
        var midrailMarkUp = 0;
        var midrailConsumables = 2.00;

        /****/


        var railW = (width * 1).toFixed(0);
        var midrailLm = (railW / 1000).toFixed(3);

        midrailMc.find('span.midrail-mc-width').text(railW);
        midrailMc.find('span.midrail-mc-lm').text(midrailLm);


        var item1Name = '';
        var item2Name = '';
        var item3Name = '';

        var item1Price = 0.00;
        var item2Price = 0.00;
        var item3Price = 0.00;

        var item1Calculated = 0;
        var item2Calculated = 0;
        var item3Calculated = 0;


        /**** Calculates Midrail Items *****/

        if (isSecDoor || isSecWindow || isDgDoor || isDgWindow) {
            item1Name = 'Midrail';
            item1Price = midrailPart;
            item1Calculated = (item1Price * midrailLm).toFixed(2);
        }
        if (isDgDoor || isDgWindow) {
            item2Name = 'PVC L-Seat';
            item2Price = PVCLSeat;
            item2Calculated = (item2Price * midrailLm).toFixed(2);

            item3Name = 'PVC Wedge';
            item3Price = PVCWedge;
            item3Calculated = (item3Price * midrailLm).toFixed(2);
        }
        if (isSecDoor) {
            item2Name = 'PVC L-Seat';
            item2Price = PVCLSeat;
            item2Calculated = (item2Price * midrailLm).toFixed(2);

            item3Name = 'PVC Wedge';
            item3Price = PVCWedge;
            item3Calculated = (item3Price * midrailLm * 2).toFixed(2);
        }
        if (isFibrDoor) {
            midrailConsumables = 1;

            item1Name = 'Midrail';
            item1Price = secWinFrame;
            item1Calculated = (item1Price * midrailLm).toFixed(2);

            item2Name = 'Clips';
            item2Price = winCnrStake;
            item2Calculated = (item2Price * 2).toFixed(2);

            item3Name = '6MM Spline X 300M';
            item3Price = 0;
            item3Calculated = (item3Price * midrailLm).toFixed(2);
        }

        if (isFibrWindow) {
            midrailConsumables = 1;
            midrailTimeAlloMins = 5;

            item1Name = 'Midrail';
            item1Price = crossBrace;
            item1Calculated = (item1Price * midrailLm).toFixed(2);

            item2Name = 'Clips';
            item2Price = 0.1; //??
            item2Calculated = (item2Price * 2).toFixed(2);

            item3Name = '6MM Spline X 300M';
            item3Price = 0;
            item3Calculated = (item3Price * midrailLm).toFixed(2);
        }
        /**************************/


        /****** Set items to Midrail MC tables *****/

        midrailMc.find('span.midrail-mc-time-allocated-min').text(midrailTimeAlloMins);
        midrailMc.find('span.midrail-mc-markup').text(midrailMarkUp);
        midrailMc.find('span.mr-mc-consumables').text(midrailConsumables);

        if (item1Name) {
            midrailMc.find('span.midrail-mc-item-1-name').text(item1Name);
            midrailMc.find('span.midrail-mc-item-1').text(item1Price);
            midrailMc.find('span.midrail-mc-item-1-calculated').text(item1Calculated);
            midrailMc.find('tr.item-1-row').show();
        } else {
            midrailMc.find('tr.item-1-row').hide();
        }


        if (item2Name) {
            midrailMc.find('span.midrail-mc-item-2-name').text(item2Name);
            midrailMc.find('span.midrail-mc-item-2').text(item2Price);
            midrailMc.find('span.midrail-mc-item-2-calculated').text(item2Calculated);
            midrailMc.find('tr.item-2-row').show();
        } else {
            midrailMc.find('tr.item-2-row').hide();
        }


        if (item3Name) {
            midrailMc.find('span.midrail-mc-item-3-name').text(item3Name);
            midrailMc.find('span.midrail-mc-item-3').text(item3Price);
            midrailMc.find('span.midrail-mc-item-3-calculated').text(item3Calculated);
            midrailMc.find('tr.item-3-row').show();
        } else {
            midrailMc.find('tr.item-3-row').hide();
        }

        /***********************************/


        /****** Calculates and Set Powder Coatings *******/
        var pwdCoatSpec1 = 0.00;
        var pwdCoatSpec2 = 0.00;
        var pwdCoatSpec3 = 0.00;
        var pwdCoatSpec4 = 0.00;


        if ($('[name="color1_color"]').val() && $('[name="color1"]').is(':checked')) {
            pwdCoatSpec1 = (spec1 * midrailLm).toFixed(2);
        }
        if ($('[name="color2_color"]').val() && $('[name="color2"]').is(':checked')) {
            pwdCoatSpec2 = (spec2 * midrailLm).toFixed(2);
        }

        if ($('[name="color3_color"]').val() && $('[name="color3"]').is(':checked')) {
            pwdCoatSpec3 = (spec3 * midrailLm).toFixed(2);
        }

        if ($('[name="color4_color"]').val() && $('[name="color4"]').is(':checked')) {
            pwdCoatSpec4 = (spec4 * midrailLm).toFixed(2);
        }

        midrailMc.find('span.midrail-pwdcoat-spec-1').text(pwdCoatSpec1);
        midrailMc.find('span.midrail-pwdcoat-spec-2').text(pwdCoatSpec2);
        midrailMc.find('span.midrail-pwdcoat-spec-3').text(pwdCoatSpec3);
        midrailMc.find('span.midrail-pwdcoat-spec-4').text(pwdCoatSpec4);

        /******************************/

        var materialCost = 0;
        if (secDigFibr && winDoor) {
            materialCost = (Number(pwdCoatSpec1) + Number(pwdCoatSpec2) + Number(pwdCoatSpec3)
                + Number(pwdCoatSpec4) + Number(item1Calculated) + Number(item2Calculated) + Number(item3Calculated)
                + Number(midrailConsumables)
            ).toFixed(2);
        }


        var labourIncCutting = 0.00;
        if (isSecDoor || isSecWindow || isDgWindow || isFibrDoor || isFibrWindow) {
            labourIncCutting = (getHourlyRate(secDigFibr, winDoor) / 60 * midrailTimeAlloMins).toFixed(2);
        } else if (isDgDoor) {
            labourIncCutting = (getHourlyRate(secDigFibr, winDoor) / 60 * dgDoorCleanup).toFixed(2);
        }


        var totalCost = Number(materialCost) + Number(labourIncCutting);

        midrailMc.find('span.midrail-mc-material-cost').text(materialCost);
        midrailMc.find('span.midrail-mc-labour-incl-cutting').text(labourIncCutting);
        midrailMc.find('span.midrail-mc-total-cost').text(totalCost);


        /*** Calculates Midrail Increased Total Cost ***/

        var increasedCost = ((totalCost * midrailMarkUp / 100) + Number(totalCost)).toFixed(2);
        midrailMc.find('span.midrail-mc-cost-markedup').text(totalCost);

        /***********************/


        var resultTotal = (qty * increasedCost).toFixed(2);
        midrailResult.find('span.midrail-mc-result-cost').text(increasedCost);
        midrailResult.find('span.midrail-mc-result-quantity').text(qty);
        midrailResult.find('span.midrail-mc-result-total').text(resultTotal);


        var masterMarkup = 0;
        switch (secDigFibr) {
            case 'Security':
            case 'Perf Ali':
                masterMarkup = Number($('.secperf-' + markupRole).text());
                break;
            case 'D/Grille':
            case 'Fibre':
                masterMarkup = Number($('.dgfibr-' + markupRole).text());
                break;
        }

        midrailsNoMarkup[midrailIndex] = resultTotal;
        midrailsTotal[midrailIndex] = Number(resultTotal * (Number(masterMarkup) + Number(100)) / 100).toFixed(2);
        //midr
        midrailOption.find('.midrail-price-incl-gst').val(midrailsTotal[midrailIndex]);
        calculateMidrailsTotal();


    });


    /* ON Change Powder Coats Checkbox and Dropdowns */
    $('.color_s').on('change', function () {

        $('.product-options-row').each(function (i, el) {
            $(el).find('.product-qty').trigger('change');
        });
        $('.midrail-options-row').each(function (i, el) {
            $(el).find('.midrail-qty').trigger('change');
        });
    });


    /* Calculates Additional Sections Prices */

    $('body').on('change', '.additional-per-meters', function () {
        var additionalRow = $(this).parents('tr');
        var name = additionalRow.find('.additional-name').val();
        var index = findIndexById(additionalRow);

        if (name) {
            var price = additionalRow.find('.additional-name').find(':selected').data('price');
            var meter = additionalRow.find('.additional-meters').val();


            var totalPrice = Number(price * meter).toFixed(2);
            additionalRow.find('.additional-total-price').val(totalPrice);

            additionalMeters[index] = totalPrice;

        } else {
            additionalRow.find('.additional-total-price').val('');
            additionalMeters[index] = 0;
        }

        calculateAddtionalsTotal();
    });


    $('body').on('change', '.additional-per-length', function () {
        var additionalRow = $(this).parents('tr');
        var name = additionalRow.find('.additional-name').val();
        var index = findIndexById(additionalRow);

        if (name) {
            var price = additionalRow.find('.additional-name').find(':selected').data('price');
            var length = additionalRow.find('.additional-length').val();


            var totalPrice = Number(price * length).toFixed(2);
            additionalRow.find('.additional-total-price').val(totalPrice);
            additonalLengths[index] = totalPrice;
        } else {
            additionalRow.find('.additional-total-price').val('');
            additonalLengths[index] = 0;
        }

        calculateAddtionalsTotal();
    });


    $('body').on('change', '.accessories', function () {
        var additionalRow = $(this).parents('tr');
        var name = additionalRow.find('.accessory-name').val();
        var index = findIndexById(additionalRow);

        if (name) {
            var price = additionalRow.find('.accessory-name').find(':selected').data('price');
            var each = additionalRow.find('.accessory-each').val();


            var totalPrice = Number(price * each).toFixed(2);
            additionalRow.find('.accessory-total-price').val(totalPrice);
            accessories[index] = totalPrice;
        } else {
            additionalRow.find('.accessory-total-price').val('');
            accessories[index] = 0;
        }
        calculateAddtionalsTotal();
    });


    $('body').on('change', '.custom-items', function () {

        var customitemRow = $(this).parents('tr');
        var index = findIndexById(customitemRow);

        var qty = Number(customitemRow.find('.custom-item-qty').val());
        var cost = Number(customitemRow.find('.custom-item-price').val());
        var markup = Number(customitemRow.find('.custom-item-markup').val());
        var tick = customitemRow.find('.custom-item-tick').is(':checked');

        var total = Number(qty * cost).toFixed(2);
        var markedup = total * markup / 100;
        var totalCharged = (Number(total) + Number(markedup)).toFixed(2);
        customitemRow.find('.custom-item-charged').val(totalCharged);

        customitems[index] = [tick, total, markedup, totalCharged];
        calculateCustomItems();

    });


    //* Total Cost Section Inputs On Change *
    $('.markups-percent').on('change', function () {
        var inputId = $(this).attr('id');
        var markupAmount = Number($(this).val());

        //console.log(markupAmount);

        var secdgfibr = '';
        switch (inputId) {
            case 'ss-markup':
                secdgfibr = 'Security';
                break;
            case 'dg-markup':
                secdgfibr = 'D/Grille';
                break;
            case 'fibr-markup':
                secdgfibr = 'Fibre';
                break;
            case 'perf-markup':
                secdgfibr = 'Perf Ali';
                break;
        }


        $('.product-sec-dg-fibr').each(function (i, el) {
            if ($(el).val() == secdgfibr) {
                var product = $(el).parents('tr');
                var productOptions = product.next();
                var productIndex = findIndexById(product);
                var priceIncGstEmergency = Number(productOptions.find('input.product-price-incl-gst').val()).toFixed(2);
                var priceInclGst = Number(productOptions.find('input.price-incl-gst-not-emergency').val()).toFixed(2);
                var profit = Number(priceInclGst * Number(markupAmount) / 100).toFixed(2);
                var sellPrice = Number(Number(priceIncGstEmergency) + Number(profit)).toFixed(2);

                productOptions.find('input.product-sell-price').val(sellPrice);
                productOptions.find('input.product-profit').val(profit);


                markups.addToMarkups(profit, productIndex, secdgfibr, true);
            }
            markups._updateMarkups();

        });


    });


    $('#discount').on('change', function () {
        var percent = Number($(this).val());
        var discountedAmount = (percent * (Number(markups.getTotalMarkups()) + Number(SCREENS_TOTAL)) / 100).toFixed(2);
        $('#discount-amount').val(discountedAmount);
        DISCOUNT = percent;
        DISCOUNT_AMOUNT = discountedAmount;
        calculateProfit();
        calculateTotalSell();
    });

    /************************************/



    $('.save-quote-btn').on('click', function () {
        var self = $(this);
        if (validate()) {
            self.parents('form').submit();
        }
    });


    $('.convert-to-order-btn').on('click', function () {
        var self = $(this);
        if (validate('order')) {
            $('#is-ordered').val(true);
            if (confirm('Send installsheet to installer?')) {
                $('#sendtoinstaller').val(true);
            } else {
                $('#sendtoinstaller').val(false);
            }
            self.parents('form').submit();
        }
    });

    editPageFunctions();

    if (isEdit) {
        $('.new-quote-btn').on('click', function () {
            if (validate()) {
                $('#is-copied').val(true);
                $('#is-ordered').val(false);
                $(this).parents('form').submit();
            }
        });
    }


});

/* Products Markup Calculator */
var markups = {

    Security: [],
    DGrille: [],
    Fibre: [],
    PerfAli: [],


    addToMarkups: function (markup, index, secdgfibr, doesntNeedUpdate) {
        switch (secdgfibr) {
            case 'Security':
                this._addToSec(markup, index);
                break;
            case 'D/Grille':
                this._addToDg(markup, index);
                break;
            case 'Fibre':
                this._addToFibr(markup, index);
                break;
            case 'Perf Ali':
                this._addToPerf(markup, index);
                break;
            default:
                this.Security[index] = 0;
                this.DGrille[index] = 0;
                this.Fibre[index] = 0;
                this.PerfAli[index] = 0;

                //console.log('addToMarkups default');
                break;
        }

        if (!doesntNeedUpdate) {
            this._updateMarkups();
        }

    },


    _addToSec: function (markup, index) {
        this.Security[index] = markup;
        this.DGrille[index] = 0;
        this.Fibre[index] = 0;
        this.PerfAli[index] = 0;
    },
    _addToDg: function (markup, index) {
        this.DGrille[index] = markup;
        this.Security[index] = 0;
        this.Fibre[index] = 0;
        this.PerfAli[index] = 0;
    },
    _addToFibr: function (markup, index) {
        this.Fibre[index] = markup;
        this.Security[index] = 0;
        this.DGrille[index] = 0;
        this.PerfAli[index] = 0;
    },
    _addToPerf: function (markup, index) {
        this.PerfAli[index] = markup;
        this.Security[index] = 0;
        this.DGrille[index] = 0;
        this.Fibre[index] = 0;
    },


    deleteFromMarkup: function (secdgfibr, index) {
        switch (secdgfibr) {
            case 'Security':
                this._removeFromSec(index);
                break;
            case 'D/Grille':
                this._removeFromDg(index);
                break;
            case 'Fibre':
                this._removeFromFibr(index);
                break;
            case 'Perf Ali':
                this._removeFromPerf(index);
                break;
        }
        this._updateMarkups(secdgfibr);
    },


    _removeFromSec: function (index) {
        this.Security[index] = 0;
    },
    _removeFromDg: function (index) {
        this.DGrille[index] = 0;
    },
    _removeFromFibr: function (index) {
        this.Fibre[index] = 0;
    },
    _removeFromPerf: function (index) {
        this.PerfAli[index] = 0;
    },

    _updateMarkups: function () {
        var secTotal = (this.Security.reduce(sum, 0)).toFixed(2);
        var dgTotal = (this.DGrille.reduce(sum, 0)).toFixed(2);
        var fibrTotal = (this.Fibre.reduce(sum, 0)).toFixed(2);
        var perfTotal = (this.PerfAli.reduce(sum, 0)).toFixed(2);

        $('#ss-markup-amount').val(secTotal);
        $('#dg-markup-amount').val(dgTotal);
        $('#fibr-markup-amount').val(fibrTotal);
        $('#perf-markup-amount').val(perfTotal);

        //console.log('_updateMarkups default');
        $('#discount').trigger('change');

    },

    getTotalMarkups: function () {
        var secTotal = Number(this.Security.reduce(sum, 0)).toFixed(2);
        var dgTotal = Number(this.DGrille.reduce(sum, 0)).toFixed(2);
        var fibrTotal = Number(this.Fibre.reduce(sum, 0)).toFixed(2);
        var perfTotal = Number(this.PerfAli.reduce(sum, 0)).toFixed(2);

        return (Number(secTotal) + Number(dgTotal) + Number(fibrTotal) + Number(perfTotal)).toFixed(2);
    },
};


// * NOT USED ANYMORE * //
function calculateProductsMarkups() {
    var sellPrice = 0;
    var SsTotalProfit = 0;
    var DgTotalProfit = 0;
    var FibrTotalProfit = 0;
    var PerfTotalProfit = 0;
    var profit = 0;
    var productOptions;
    var priceInclGst;

    $('.product-sec-dg-fibr').each(function (i, el) {

        productOptions = $(el).parents('tr').next();
        priceInclGst = Number(productOptions.find('input.product-price-incl-gst').val());

        switch ($(el).val()) {
            case 'Security':
                sellPrice = (priceInclGst * (Number(100) + Number($('#ss-markup').val())) / 100).toFixed(2);
                profit = (Number(sellPrice) - Number(priceInclGst)).toFixed(2);
                SsTotalProfit += Number(profit);
                productOptions.find('span.product-sell-price').text(sellPrice);
                productOptions.find('span.product-profit').text(profit);
                break;
            case 'D/Grille':
                selector = 'dg-markup';
                sellPrice = (priceInclGst * (Number(100) + Number($('#dg-markup').val())) / 100).toFixed(2);
                profit = (Number(sellPrice) - Number(priceInclGst)).toFixed(2);
                DgTotalProfit += Number(profit);
                productOptions.find('span.product-sell-price').text(sellPrice);
                productOptions.find('span.product-profit').text(profit);
                break;
            case 'Fibre':
                selector = 'fibr-markup';
                sellPrice = (priceInclGst * (Number(100) + Number($('#fibr-markup').val())) / 100).toFixed(2);
                profit = (Number(sellPrice) - Number(priceInclGst)).toFixed(2);
                FibrTotalProfit += Number(profit);
                productOptions.find('span.product-sell-price').text(sellPrice);
                productOptions.find('span.product-profit').text(profit);
                break;
            case 'Perf Ali':
                selector = 'perf-markup';
                sellPrice = (priceInclGst * (Number(100) + Number($('#perf-markup').val())) / 100).toFixed(2);
                profit = (Number(sellPrice) - Number(priceInclGst)).toFixed(2);
                PerfTotalProfit += Number(profit);
                productOptions.find('span.product-sell-price').text(sellPrice);
                productOptions.find('span.product-profit').text(profit);
                break;
        }
    });

    $('#ss-markup-amount').val(SsTotalProfit);
    $('#dg-markup-amount').val(DgTotalProfit);
    $('#fibr-markup-amount').val(FibrTotalProfit);
    $('#perf-markup-amount').val(PerfTotalProfit);
}


/** Get markup input ID by these strings => security, d/grille, fibre, perf ali **/
function getMarkupInputID(secdgfibr) {
    var selector = null;
    switch (secdgfibr) {
        case 'Security':
            selector = 'ss-markup';
            break;
        case 'D/Grille':
            selector = 'dg-markup';
            break;
        case 'Fibre':
            selector = 'fibr-markup';
            break;
        case 'Perf Ali':
            selector = 'perf-markup';
            break;
    }
    return '#' + selector;
}


function initializeTableVariables() {

    /* Initialize MC Tables (Products and Midrails) */

    productMcTableHtml = '<div class="col-md-6 col-sm-8 product-mc-container">' + $('.product-mc-container').html() + '</div>';
    productResultTableHtml = '<div class="col-md-2 col-sm-4 product-mc-res-container">' + $('.product-mc-res-container').html() + '</div>';

    midrailMcTableHtml = '<div class="col-md-6 col-sm-8 midrail-mc-container">' + $('.midrail-mc-container').html() + '</div>';
    midrailResultTableHtml = '<div class="col-md-2 col-sm-4 midrail-mc-res-container">' + $('.midrail-mc-res-container').html() + '</div>';
}


function initializeRole() {
    role = $('#role').val();
    mfrole = $('#mf-role').val();


    if (role == 'distributor' || mfrole == 'distributor') {
        $('span.product-mf-role').text('Dist.:');
        $('span.midrail-mf-role').text('Dist.:');
        markupRole = 'dist';

    } else if (role == 'wholesaler' || mfrole == 'wholesaler') {
        $('span.product-mf-role').text('Whsle.:');
        $('span.midrail-mf-role').text('Whsle.:');
        markupRole = 'whsl';

    } else if (role == 'retailer' || mfrole == 'retailer') {
        $('span.product-mf-role').text('Retail.:');
        $('span.midrail-mf-role').text('Retail.:');
        markupRole = 're';

        $('.markup-section').remove();
    }

    if (mfrole) {
        $('.total-cost-role').text(mfrole);
    } else {
        $('.total-cost-role').text(role);
    }

}


function initializePartsVariables() {
    sgSSMesh = Number($('.mc-list-1').text());
    perfAliMesh = Number($('.mc-list-2').text());
    grille7mm = Number($('.mc-list-3').text());
    secDoorFrame = Number($('.mc-list-4').text());
    secWinFrame = Number($('.mc-list-5').text());
    midrailPart = Number($('.mc-list-6').text());
    dgDoorFrame = Number($('.mc-list-7').text());
    dgWindowFrame = Number($('.mc-list-8').text());
    flyFrame = Number($('.mc-list-9').text());
    doorCnrStake = Number($('.mc-list-10').text());
    winCnrStake = Number($('.mc-list-11').text());
    perfSheetFixingBead = Number($('.mc-list-12').text());
    PVCLSeat = Number($('.mc-list-13').text());
    PVCWedge = Number($('.mc-list-14').text());
    insectMesh = Number($('.mc-list-15').text());
    petMesh = Number($('.mc-list-16').text());
    spline = Number($('.mc-list-17').text());
    cnrStakeFFrame = Number($('.mc-list-18').text());
    rollerHinges = Number($('.mc-list-19').text());

    singleLock = Number($('.mc-list-20').text());
    tripleHngd = Number($('.mc-list-21').text());
    tripleSliding = Number($('.mc-list-22').text());

    crossBrace = Number($('.mc-list-23').text());

    /** Hourly Rates **/
    sdHrlyRate = Number($('.hrly-sd').text());
    swHrlyRate = Number($('.hrly-sw').text());
    ddHrlyRate = Number($('.hrly-dd').text());
    dwHrlyRate = Number($('.hrly-dw').text());
    fdHrlyRate = Number($('.hrly-fd').text());
    fwHrlyRate = Number($('.hrly-fw').text());
    pdHrlyRate = Number($('.hrly-pd').text());
    pwHrlyRate = Number($('.hrly-pw').text());


    /** Cleanups **/
    secDoorCleanUp = Number($('.cleanup-sd').text());
    secWindowCleanUp = Number($('.cleanup-sw').text());
    dgDoorCleanup = Number($('.cleanup-dd').text());
    dgWindowCleanup = Number($('.cleanup-dw').text());
    fibrDoorCleanup = Number($('.cleanup-fd').text());
    fibrWindowCleanup = Number($('.cleanup-fw').text());
    perfDoorCleanup = Number($('.cleanup-pd').text());
    perfWindowCleanup = Number($('.cleanup-pw').text());


    /** Products Markup **/
    sdMarkup = Number($('.markup-sd').text());
    swMarkup = Number($('.markup-sw').text());
    ddMarkup = Number($('.markup-dd').text());
    dwMarkup = Number($('.markup-dw').text());
    fdMarkup = Number($('.markup-fd').text());
    fwMarkup = Number($('.markup-fw').text());
    pdMarkup = Number($('.markup-pd').text());
    pwMarkup = Number($('.markup-pw').text());

    /** Powder Coatings **/
    std = Number($('.std').text());
    spec1 = Number($('.spec1').text());
    spec2 = Number($('.spec2').text());
    spec3 = Number($('.spec3').text());
    spec4 = Number($('.spec4').text());
}


function findIndexById(el) {
    /*
     example: if id is addtional-row-12 , the index would be 12
     */

    var id = el.attr('id');
    var splitted = id.split('-');

    return splitted[splitted.length - 1];
}


function sum(a, b) {
    return Number(a) + Number(b);
}


function getHourlyRate(secdgfibr, winDoor) {
    var hourlyRate = 0;

    if (secdgfibr && winDoor) {
        if (secdgfibr == 'Security' && winDoor == 'Door') {
            hourlyRate = sdHrlyRate;
        }
        else if (secdgfibr == 'Security' && winDoor == 'Window') {
            hourlyRate = swHrlyRate;
        }
        else if (secdgfibr == 'D/Grille' && winDoor == 'Door') {
            hourlyRate = ddHrlyRate;
        }
        else if (secdgfibr == 'D/Grille' && winDoor == 'Window') {
            hourlyRate = dwHrlyRate;
        }
        else if (secdgfibr == 'Fibre' && winDoor == 'Door') {
            hourlyRate = fdHrlyRate;
        }
        else if (secdgfibr == 'Fibre' && winDoor == 'Window') {
            hourlyRate = fwHrlyRate;
        }
        else if (secdgfibr == 'Perf Ali' && winDoor == 'Door') {
            hourlyRate = pdHrlyRate;
        }
        else if (secdgfibr == 'Perf Ali' && winDoor == 'Window') {
            hourlyRate = pwHrlyRate;
        }
    }
    return hourlyRate;

}

function getCleanup(secdgfibr, winDoor) {
    var cleanup = 0;
    if (secdgfibr && winDoor) {
        if (secdgfibr == 'Security' && winDoor == 'Door') {
            cleanup = secDoorCleanUp;
        }
        else if (secdgfibr == 'Security' && winDoor == 'Window') {
            cleanup = secWindowCleanUp;
        }
        else if (secdgfibr == 'D/Grille' && winDoor == 'Door') {
            cleanup = dgDoorCleanup;
        }
        else if (secdgfibr == 'D/Grille' && winDoor == 'Window') {
            cleanup = dgWindowCleanup;
        }
        else if (secdgfibr == 'Fibre' && winDoor == 'Door') {
            cleanup = fibrDoorCleanup;
        }
        else if (secdgfibr == 'Fibre' && winDoor == 'Window') {
            cleanup = fibrWindowCleanup;
        }
        else if (secdgfibr == 'Perf Ali' && winDoor == 'Door') {
            cleanup = perfDoorCleanup;
        }
        else if (secdgfibr == 'Perf Ali' && winDoor == 'Window') {
            cleanup = perfWindowCleanup;
        }
    }
    return cleanup;
}


function getDate() {
    var currentdate = new Date();
    var datetime = currentdate.getDate() + "/"
        + (currentdate.getMonth() + 1) + "/"
        + currentdate.getFullYear();
    return datetime;
}


/*** EDIT PAGE ***/

function editPageFunctions() {
    if ($('#editpage').val() != 'editpage') {
        return;
    }
    isEdit = true;


    /** Inialize Variables **/
    CUSTOM_INSTALLATION = Number($('#installation-custom-amount').val());
    FREIGHTCOST = Number($('#freight-cost').val());


    PROFIT = Number($('#profit').val());
    DISCOUNT = Number($('#discount').val());
    DISCOUNT_AMOUNT = Number($('#discount-amount').val());
    //

    /** Edit Page Functions (need to run after page loaded) **/
    $('.product-options-row').each(function (i, el) {

        if (i > 0) {
            productsCount++;
            var productMcTable = productMcTableHtml.replace('product-mc-0', 'product-mc-' + productsCount);
            var productResultTable = productResultTableHtml.replace('product-result-0', 'product-result-' + productsCount);
            $('#products-mc-container').append('<div class="clearfix"></div>');
            $('#products-mc-container').append(productMcTable);
            $('#products-mc-container').append(productResultTable);
        }

        $(el).find('.product-qty').trigger('change');

    });

    $('.midrail-options-row').each(function (i, el) {

        if (i > 0) {
            midrailsCount++;
            var midrailMcTable = midrailMcTableHtml.replace('midrail-mc-0', 'midrail-mc-' + midrailsCount);
            var midrailResultTable = midrailResultTableHtml.replace('midrail-result-0', 'midrail-result-' + midrailsCount);
            $('#midrails-mc-container').append('<div class="clearfix"></div>');
            $('#midrails-mc-container').append(midrailMcTable);
            $('#midrails-mc-container').append(midrailResultTable);
        }

        $(el).find('.midrail-qty').trigger('change');
    });

    $('.additional-m-table tr').each(function (i, el) {
        $(el).find('.additional-meters').trigger('change');

        //Ignores first tr row (head row)
        if (i > 5) {
            additionalsCount++;
        }

    });

    $('.additional-l-table tr').each(function (i, el) {
        $(el).find('.additional-length').trigger('change');
    });

    $('.accessories-table tr').each(function (i, el) {
        $(el).find('.accessory-each').trigger('change');
    });

    $('.customitem-table tr').each(function (i, el) {
        $(el).find('.custom-item-qty').trigger('change');

        //Ignores first tr row (head row)
        if (i > 3) {
            customitemsCount++;
        }
    });

    hideOrShowBtns();


}


function hideOrShowBtns() {

    /****** Decides which Add and Delete buttons need to hide or show *******/

    //PRODUCTS
    var count = $('.product-options-row').length - 1; //Index
    if (count >= productMAX) {
        $('.product-btns').css('visibility', 'hidden');
    }
    if (count > productMIN) {
        $('.product-options-row').last().find('button').css('visibility', 'visible');
    }

    //MIDRAILS
    count = $('.midrail-options-row').length - 1;
    if (count >= midrailMax) {
        $('#add-midrail-btn').css('visibility', 'hidden');
    }
    if (count > midrailMIN) {
        $('.midrail-options-row').last().find('button').css('visibility', 'visible');
    }


    //ADDITIONAL PER METERS
    count = $('.additional-m-table tr').length - 2;
    if (count >= additionalMAX) {
        $('#add-row-additional-m').css('visibility', 'hidden');
    }
    if (count > additionalMIN) {
        $('.additional-m-table tr').last().find('button').css('visibility', 'visible');
    }

    //CUSTOM ITEMS
    count = $('.customitem-table tr').length - 2;
    if (count >= customitemMAx) {
        $('#add-row-customitem').css('visibility', 'hidden');
    }
    if (count > customitemMIN) {
        $('.customitem-table tr').last().find('button').css('visibility', 'visible');
    }

}


function validate(type) {
    var errorMsg = '';

    var error = false;

    $('.product-options-row').each(function (i, el) {

        var winDoor = $(el).find('.product-win-door').val();
        var lockCounts = Number($(el).find('.product-lock-count').val());
        var lockType = $(el).find('.product-lock-type').val();
        var lockHeight = Number($(el).find('.product-lock-height').val());

        if (!error) {
            if (winDoor == 'Door') {
                if (!lockType) {
                    errorMsg += 'Lock type is not selected. \n';
                    error = true;
                }
                if (!lockCounts) {
                    errorMsg += 'Door needs a lock. \n';
                    error = true;
                }
                if (!lockHeight) {
                    errorMsg += 'Lock handle height is empty. \n';
                    error = true;
                }
            }
        }

    });

    error = false;

    // Check if "Covert To Order" Button is Clicked
    if (type == 'order') {

        if (!$('[name="standard"]').is(':checked') && !$('[name="color1"]').is(':checked') && !$('[name="color2"]').is(':checked')
            && !$('[name="color3"]').is(':checked') && !$('[name="color4"]').is(':checked')) {

            errorMsg += 'Colour not Chosen. \n';

        }

        if (!$('[name="required_date"]').val()) {
            errorMsg += 'Do you want to request a Required Completion Date? \n';
        }
    }


    if (errorMsg) {
        //A title with a text under
        swal("", errorMsg);
        return false;
    }

    return true;


}

/*************************/
