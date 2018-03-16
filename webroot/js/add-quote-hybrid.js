var productsCount = 0;
var productMAX = 29;
var productMIN = 0;
var midrailsCount = 0;
var midrailMax = 2;
var midrailMIN = 0;
var additionalsCount = 4;
var additionalMAX = 19;
var additionalMIN = 4;
var additionalsLengthCount = 4;
var additionalLengthMAX = 19;
var additionalLengthMIN = 4;
var customitemsCount = 2;
var customitemMAx = 19;
var customitemMIN = 2;
var cutsheetsCount = 2;
var copyToMidrail = 1;
var productMcTableHtml = '';
var productResultTableHtml = '';
var midrailMcTableHtml = '';
var midrailResultTableHtml = '';
var isEdit = false;
var role, mfrole, markupRole;
var flagSaveBtnClicked = false;

var securityWindowMesh;// = 52;
var securityDoorMesh;// = 105;
var dgDoorMesh;// = 115;
var dgWindowMesh;// = 50;
var fibrDoorMesh;// = 0;
var fibrWindowMesh;// = 0;
var perfDoorMesh;// = 105;
var perfWindowMesh;// = 52;
var perfSheetFixingBead;// = 3.79;
var freightConsumables = 1.00;
// //**** Parts ****//
 var sgSSMesh;// = 75.60;
var petMesh;// = 10.55;
var insectMesh;
var rollerHinges;// = 2.15;
var singleLockSld;// = 23.74;
var singleLockHng;// = 2.15;
var tripleLockSld;// = 23.74;
var tripleLockHng;// = 23.74;
var lockCyl;// = 23.74;
var spline;// = 0.11;
var splineName;
/* Cost Variables */

var screensTotal = [];
var midrailsTotal = [];
var productsNoMarkup = [];
var midrailsNoMarkup = [];
var additionalMeters = [];
var additonalLengths = [];
var accessories = [];
var customitems = [];
var additionalPerMeter = [];
var additionalPerLength = [];
var additionalPerEach = [];
var installations = [];
var incorporateInstallations = [];
var SCREENS_TOTAL = 0;
var MIDRAILS_TOTAL = 0;
var SECTIONS_ACC_TOTAL = 0;
var CUSTOM_ITEMS_TOTAL = 0;
var TOTAL_BUY_PRICE = 0;
var DISCOUNT = 0;
var DISCOUNT_AMOUNT = 0;
var PRESET_INSTALLATION = 0;
var CUSTOM_INSTALLATION = 0;
var INCORPORATE_INSTALLATION = 0;
var INCORPORATE_INSTALLATION_TOTAL = 0;
var FREIGHTCOST = 0;
var INSTALLATION_TOTAL = 0;
var TOTAL_SELL_PRICE = 0;
var PROFIT = 0; // install not included
var CUSTOM_QUOTED_AMOUNT = 0;

var isHybrid = false;


function calculateScreensTotal() {
    //OLD: SCREENS_TOTAL = (screensTotal.reduce(sum, 0) + Number(getCustomItemsTotal())).toFixed(2);
    SCREENS_TOTAL = (screensTotal.reduce(sum, 0)).toFixed(2);
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
    //OLD: SECTIONS_ACC_TOTAL = (additionalMeters.reduce(sum, 0) + additonalLengths.reduce(sum, 0) + accessories.reduce(sum, 0) + Number(getCustomItemsTotal())).toFixed(2);
    SECTIONS_ACC_TOTAL = (additionalMeters.reduce(sum, 0) + additonalLengths.reduce(sum, 0) + accessories.reduce(sum, 0)).toFixed(2);
    $('#section-acc-total').val(SECTIONS_ACC_TOTAL);
    calculateTotalBuy();
    calculateProfit();
}

function calculateCustomItemsTotal() {
    CUSTOM_ITEMS_TOTAL = Number(getCustomItemsTotal()).toFixed(2);
    $('#custom-items-total').val(CUSTOM_ITEMS_TOTAL);
    calculateTotalBuy();
    calculateProfit();
}

function calculateProfit() {
    PROFIT = (markups.getTotalMarkups() - Number(DISCOUNT_AMOUNT)).toFixed(2);
    PROFIT = (Number(PROFIT) + Number(getCustomItemsMarkups())).toFixed(2);
    PROFIT = (Number(PROFIT) + Number(getPerMeterMarkups()) + Number(getPerLengthMarkups()) ).toFixed(2);
    $('#profit').val(PROFIT);
}


function getPerMeterMarkups() {
    var markup = 0;
    
    $.each(additionalPerMeter, function (i, item) {
        if(typeof item !== "undefined"){
            if( Number(item[1]) >= 0)
                markup += Number(item[1]);
        }
    });
    if (markup) {
        return markup.toFixed(2);
    }
    return 0;

}

function getPerLengthMarkups() {
    var markup = 0;
    
    $.each(additionalPerLength, function (i, item) {
        if(typeof item !== "undefined"){
            if( Number(item[1]) >= 0)
                markup += Number(item[1]);
        }

    });
    if (markup) {
        return markup.toFixed(2);
    }
    return 0;
}
/* For Hybrid */
function getPerEachMarkups() {
    var markup = 0;
	$.each(additionalPerEach, function (i, item) {
        if(typeof item !== "undefined"){
            if( Number(item[1]) >= 0)
                markup += Number(item[1]);
        }

    });
    if (markup) {
        return markup.toFixed(2);
    }
    return 0;
}
/* End For Hybrid */
function getCustomItemsMarkups() {
    var markup = 0;
    $.each(customitems, function (i, item) {
        markup += Number(item[2]);

    });
    if (markup) {
        return markup.toFixed(2);
    }
    return 0;
}

function getCustomItemsTotal() {
    var total = 0;

    $.each(customitems, function (i, item) {

        if (item[0]) { // if Ticked
            total += Number(item[1]);
        }
    });
    if (total) {
        return total.toFixed(2);
    }
    return 0;

}

function getCustomItemsCharged() {
    var totalCharged = 0;

    $.each(customitems, function (i, item) {

        totalCharged += Number(item[3])
    });
    if (totalCharged) {
        return totalCharged.toFixed(2);
    }
    return 0;

}

//
// function calculateCustomItems() {
//
//     calculateScreensTotal();
//     calculateAddtionalsTotal();
//
//     $('#discount').trigger('change');
//     calculateProfit();
// }
function calculateTotalBuy() {
    TOTAL_BUY_PRICE = Number(Number(SCREENS_TOTAL) + Number(MIDRAILS_TOTAL) + Number(SECTIONS_ACC_TOTAL) + Number(CUSTOM_ITEMS_TOTAL)).toFixed(2);
    $('#total-buy-price').val(TOTAL_BUY_PRICE);
    calculateTotalSell();
}


function calculateTotalSell() {
	TOTAL_SELL_PRICE = (Number(TOTAL_BUY_PRICE) + Number(markups.getTotalMarkups()) - Number(DISCOUNT_AMOUNT) + Number(INSTALLATION_TOTAL)).toFixed(2);
    TOTAL_SELL_PRICE = (Number(TOTAL_SELL_PRICE) + Number(getCustomItemsCharged()) - Number(CUSTOM_ITEMS_TOTAL)).toFixed(2);
    
    TOTAL_SELL_PRICE = (Number(TOTAL_SELL_PRICE) + Number(getPerMeterMarkups()) + Number(getPerLengthMarkups())).toFixed(2);
    $('#total-sell-price').val(TOTAL_SELL_PRICE);


    if (role == 'manufacturer') {
        calculateMfTotalCost();
    }
}


function calculateInstallation(productRow, index, isAdd) {
    var installation = 0;


    var qty = Number(productRow.find('.product-qty').val());
    var installationType = $('input[name="installation_type"]:checked').val();


    if (qty > 0) {

        if (installationType == 'preset amount') {
            var secDgFibr = productRow.find('.product-sec-dg-fibr').val();
            var winDoor = productRow.find('.product-win-door').val();

            if (secDgFibr == '316 S/S' || secDgFibr == 'D/Grille' || secDgFibr == 'Perf') {
                if (winDoor == 'Window') {
                    installation = Number($('span.ins-ssperfdg-win').text()) * qty;
                } else if (winDoor == 'Door') {
                    installation = Number($('span.ins-ssperfdg-door').text()) * qty;
                }
            } else if (secDgFibr == 'Insect') {
                if (winDoor == 'Window') {
                    installation = Number($('span.ins-insect-win').text()) * qty;
                } else if (winDoor == 'Door') {
                    installation = Number($('span.ins-insect-door').text()) * qty;
                }
            }
            // if (installation) {
            if (isAdd) {
                installations[index] = installation;
            } else {
                installations[index] = 0;
            }

            PRESET_INSTALLATION = Number(installations.reduce(sum, 0)).toFixed(2);
            $('input[name="installation_preset_amount"]').val(PRESET_INSTALLATION);

        }else if(installationType == 'incorporate install'){
            installation = Number($('input[name="installation_incorporate_amount"]').val()) * qty;

            // if (installation) {
            if (isAdd) {
                incorporateInstallations[index] = installation;
            } else {
                incorporateInstallations[index] = 0;
            }

            //INCORPORATE_INSTALLATION_TOTAL = Number(incorporateInstallations.reduce(sum, 0)).toFixed(2);
            //$('input[name="installation_incorporate_amount"]').val(INCORPORATE_INSTALLATION);
        }
    }
   

    //console.log(INCORPORATE_INSTALLATION + 'INCORPORATE_INSTALLATION');
    calculateTotalInstallation();
    // }
}

function calculateIncorporateInstallation(productRow) {
    var installation = 0;


    var qty = Number(productRow.find('.product-qty').val());


    if (qty > 0) {

        var secDgFibr = productRow.find('.product-sec-dg-fibr').val();
        var winDoor = productRow.find('.product-win-door').val();

        if (secDgFibr == '316 S/S' || secDgFibr == 'D/Grille' || secDgFibr == 'Perf') {
            if (winDoor == 'Window') {
                installation = Number($('span.ins-ssperfdg-win').text());
            } else if (winDoor == 'Door') {
                installation = Number($('span.ins-ssperfdg-door').text());
            }
        } else if (secDgFibr == 'Insect') {
            if (winDoor == 'Window') {
                installation = Number($('span.ins-insect-win').text());
            } else if (winDoor == 'Door') {
                installation = Number($('span.ins-insect-door').text());
            }
        }
    }
    productRow.find('.product_incorporate_install').val(installation);
    return installation;
}
function calculateTotalInstallation() {
    var installationType = $('input[name="installation_type"]:checked').val();
    var installationValue = 0;

    if (installationType == 'preset amount') {
        installationValue = PRESET_INSTALLATION;
    } else if (installationType == 'custom amount') {
        installationValue = CUSTOM_INSTALLATION;
    } else if (installationType == 'incorporate install') {

        var qnty = 0;
        $('.product-options-row').each(function (i, el) {   
            qnty = $(el).find('.product-qty').val();
            if (qnty > 0) {     
               
                installationValue = ( (Number(INCORPORATE_INSTALLATION) * qnty) + Number(installationValue)).toFixed(2);
            }        
        });
        
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
    window.onbeforeunload = null;

    $(window).on('beforeunload',function(){

        if (flagSaveBtnClicked) {
            return;
        }
        if (confirm('You are about to leave this page without saving any changes, All unsaved data will be lost. Are you sure?')) {
            return true;
        }
        return false;
    });

    $('.created-date').val(getDate());

    $('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd/mm/yyyy",
    });

    initializePartsVariables();
    initializeRole();
	initializeTableVariables();
    initializeMatrixTables();


     $('input[name="installation_type"]').on('change', function () {
        var value = $(this).val();
        if (value == 'preset amount') {
            $('input[name="installation_preset_amount"]').show();
            $('input[name="installation_custom_amount"]').hide();
            $('input[name="installation_incorporate_amount"]').hide();
            $('.installation-label').text('Preset Amount:');
            $('.freight-cost').text('Freight Cost');
            $('input[name="freight_cost"]').parents('tr').show();
        } else if (value == 'custom amount') {
            $('input[name="installation_preset_amount"]').hide();
            $('input[name="installation_custom_amount"]').show();
            $('input[name="installation_incorporate_amount"]').hide();
            $('.installation-label').text('Custom Amount:');
            $('.freight-cost').text('Freight Cost');
            $('input[name="freight_cost"]').parents('tr').show();
        }else if (value == 'incorporate install') {
            $('input[name="installation_preset_amount"]').hide();
            $('input[name="installation_custom_amount"]').hide();
            $('.installation-label').text('Incorporate Install Amount:');
            $('input[name="installation_incorporate_amount"]').show();
            $('.freight-cost').text('Additional Install Cost');
            $('input[name="freight_cost"]').parents('tr').show();            
        }
            //$('.product_incorporate_install').val(0);
        $('.product-options-row').each(function(){
                $(this).find('.product-qty').trigger('change');
        });
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

    $('input[name="installation_incorporate_amount"]').on('change', function () {
        INCORPORATE_INSTALLATION = Number($(this).val());
        $('.product-options-row').each(function(){
            $(this).find('.product-qty').trigger('change');
	    });
        calculateTotalInstallation();
    });


    $('.panel-heading a').on('click', function () {
        if ($(this).hasClass('collapsed')) {
            $(this).addClass('panel-open-a');
        } else {
            $(this).removeClass('panel-open-a');
        }
    });

    $('#add-row-cutsheet').on('click', function () {
        console.log('------hh');
        var row = $('.cutsheets-table tr:eq(2)').html();
        var numberOfTds = $('.cutsheets-table tr:eq(2) td').length;

        for (var i = 0; i < numberOfTds; i++) {
            row = row.replace('cutsheets[0]', 'cutsheets[' + (cutsheetsCount + 1) + ']');
            row = row.replace('cutsheets-0', 'cutsheets-' + (cutsheetsCount + 1));
        }

        $('.cutsheets-table').append('<tr id="cutsheets-row-' + (cutsheetsCount + 1) + '" class="cutsheets-rows">' + row + '</tr>');


        if (isEdit) {
            var newRow = $('.cutsheets-table').find('tr').last();
            newRow.find('input').val('');
            newRow.find('input[type="hidden"]').remove();
        }

        cutsheetsCount++;
    });


    $('body').on('click', '.cutsheet-delete-btn', function () {


        if (cutsheetsCount > 0) {
            var row = $(this).parents('tr');
            var index = findIndexById(row);

            if (isEdit) {
                var id = $('[name="cutsheets[' + index + '][id]"]').val();
                if (id) {
                    $('input[name="cutsheets_to_delete"]').val(id + ',' + $('input[name="cutsheets_to_delete"]').val());
                }
            }

            row.remove();
            // cutsheetsCount--;
        }

    });


    $('#add-product-btn').on('click', function () {

        if (productsCount >= productMAX) {
            return;
        }

        // var options = $('#product-options-row-' + productsCount).html();
        // var prices = $('#product-prices-row-' + productsCount).html();

        var options = $('.product-options-row:last').html();
        var prices = $('.product-prices-row:last').html();
        var index =  findIndexById($('.product-options-row:last'));

        var numberOfTds = $('.product-options-row:last').find('td').length;
        for (var i = 0; i <= numberOfTds; i++) {
            options = options.replace('products[' + index + ']', 'products[' + (productsCount + 1) + ']');
            options = options.replace('products-' + index, 'products-' + (productsCount + 1));
            options = options.replace('selected="selected"', '');
            prices = prices.replace('products[' + index + ']', 'products[' + (productsCount + 1) + ']');
            prices = prices.replace('products-' + index, 'products-' + (productsCount + 1));
            prices = prices.replace('products-' + index, 'products-' + (productsCount + 1));
        }
        options = options.replace('visibility: hidden', 'visibility: visible');
        prices = prices.replace('row-' + index, 'row-' + (productsCount + 1));


        $('.product-table').append('<tr id="product-options-row-' + (productsCount + 1) + '" class="product-options-row">' + options + '</tr>');
        $('.product-table').append('<tr id="product-prices-row-' + (productsCount + 1) + '" class="product-prices-row">' + prices + '</tr>');
        $('.product-prices-row:last > td').css('background-color', '#fff');
        $('.product-table').find('.product-win-door:last').css('background', '#fff');

        if (isEdit) {
            var newRow = $('.product-table').find('tr').last().prev();
            newRow.find('select').val('');
            newRow.find('input').val('');
            newRow.find('input[type="hidden"]').remove();
            newRow.next().find('input[type="checkbox"]').prop('checked', false);
            newRow.next().find('input.product-price-incl-gst').val('');
        }


        // Hidden the Last Row Delete button
        // $('.product-table tr').eq(((productsCount + 1) * 2) - 1).find('td').last().find('button').css('visibility', 'hidden');
        //***************

        productsCount++;
		
		/* For Hybrid */
		//if(isHybrid){
			if (productsCount > 0) {
				var productMcTable = productMcTableHtml.replace('product-mc-0', 'product-mc-' + productsCount);
				var productResultTable = productResultTableHtml.replace('product-result-0', 'product-result-' + productsCount);
				$('#products-mc-container').append('<div class="clearfix"></div>');
				$('#products-mc-container').append(productMcTable);
				$('#products-mc-container').append(productResultTable);
			}
		//}
		/* End For Hybrid */
        if (productsCount >= productMAX) {
            $('.product-btns').css('visibility', 'hidden');
        }

    });


    $('body').on('click', '.product-delete', function () {
        var productRow = $(this).parents('tr');
        var pricesRow = productRow.next();
        var productIndex = findIndexById(productRow);
        var secdgfibr = productRow.find('.product-sec-dg-fibr').val();


        if (isEdit) {
            var id = $('[name="products[' + productIndex + '][id]"]').val();
            if (id) {
                $('input[name="products_to_delete"]').val(id + ',' + $('input[name="products_to_delete"]').val());
            }
        }

        productRow.remove();
        pricesRow.remove();

        productMAX++;
        $('.product-btns').css('visibility', 'visible');


        // Show the Last Row Delete button
        // if (productsCount > 0) {
        //     $('.product-table tr').eq(((productsCount + 1) * 2) - 1).find('td').last().find('button').css('visibility', 'visible');
        // }
        //***************

        calculateInstallation(productRow, productIndex, false);

        productsNoMarkup[productIndex] = 0;
        screensTotal[productIndex] = 0;

        calculateScreensTotal();
        markups.deleteFromMarkup(secdgfibr, productIndex)
    });


    $('#copy-product-btn').on('click', function () {


        /* Addd New Item */
        $('#add-product-btn').trigger('click');


        /* Copy before last row's values to Last Row */
        var beforeLastRow = findIndexById($('.product-options-row').eq(-2));

        $('[name="products[' + productsCount + '][product_item_number]"]').val($('[name="products[' + beforeLastRow + '][product_item_number]"]').val());
        $('[name="products[' + productsCount + '][product_qty]"]').val($('[name="products[' + beforeLastRow + '][product_qty]"]').val());
        $('[name="products[' + productsCount + '][product_sec_dig_perf_fibr]"]').val($('[name="products[' + beforeLastRow + '][product_sec_dig_perf_fibr]"]').val());
        $('[name="products[' + productsCount + '][product_316_ss_gal_pet]"]').val($('[name="products[' + beforeLastRow + '][product_316_ss_gal_pet]"]').val());
        $('[name="products[' + productsCount + '][product_colour]"]').val($('[name="products[' + beforeLastRow + '][product_colour]"]').val());
        $('[name="products[' + productsCount + '][product_window_or_door]"]').val($('[name="products[' + beforeLastRow + '][product_window_or_door]"]').val());
        $('[name="products[' + productsCount + '][product_window_frame_type]"]').val($('[name="products[' + beforeLastRow + '][product_window_frame_type]"]').val());
        $('[name="products[' + productsCount + '][product_configuration]"]').val($('[name="products[' + beforeLastRow + '][product_configuration]"]').val());
        $('[name="products[' + productsCount + '][product_location_in_building]"]').val($('[name="products[' + beforeLastRow + '][product_location_in_building]"]').val());
        $('[name="products[' + productsCount + '][product_height]"]').val($('[name="products[' + beforeLastRow + '][product_height]"]').val());
        $('[name="products[' + productsCount + '][product_width]"]').val($('[name="products[' + beforeLastRow + '][product_width]"]').val());
        $('[name="products[' + productsCount + '][product_lock_qty]"]').val($('[name="products[' + beforeLastRow + '][product_lock_qty]"]').val());
        $('[name="products[' + productsCount + '][product_lock_type]"]').val($('[name="products[' + beforeLastRow + '][product_lock_type]"]').val());
        $('[name="products[' + productsCount + '][product_lock_handle_height]"]').val($('[name="products[' + beforeLastRow + '][product_lock_handle_height]"]').val());
        $('#products-' + productsCount + '-product-inc-midrail').prop('checked', $('#products-' + beforeLastRow + '-product-inc-midrail').is(':checked'));
        //$('#products-' + productsCount + '-product-no-lock').prop('checked', $('#products-' + beforeLastRow + '-product-no-lock').is(':checked'));


        //Trigger 'Change' on copied product's QTY option to calculate the new copied product costs
        $('[name="products[' + productsCount + '][product_qty]"]').trigger('change');

    });
    
    $('#copy-cutsheet-btn').on('click', function () {


        /* Addd New Item */
        $('#add-row-cutsheet').trigger('click');


        /* Copy before last row's values to Last Row */
        var beforeLastRow = findIndexById($('.cutsheets-rows').eq(-2));

        $('[name="cutsheets[' + cutsheetsCount + '][qty]"]').val($('[name="cutsheets[' + beforeLastRow + '][qty]"]').val());
        $('[name="cutsheets[' + cutsheetsCount + '][section]"]').val($('[name="cutsheets[' + beforeLastRow + '][section]"]').val());
        $('[name="cutsheets[' + cutsheetsCount + '][colour]"]').val($('[name="cutsheets[' + beforeLastRow + '][colour]"]').val());
        $('[name="cutsheets[' + cutsheetsCount + '][cut_to_size]"]').val($('[name="cutsheets[' + beforeLastRow + '][cut_to_size]"]').val());
        $('[name="cutsheets[' + cutsheetsCount + '][notes]"]').val($('[name="cutsheets[' + beforeLastRow + '][notes]"]').val());
        //$('#products-' + cutsheetsCount + '-product-inc-midrail').prop('checked', $('#products-' + beforeLastRow + '-product-inc-midrail').is(':checked'));
        //$('#products-' + productsCount + '-product-no-lock').prop('checked', $('#products-' + beforeLastRow + '-product-no-lock').is(':checked'));


        //Trigger 'Change' on copied product's QTY option to calculate the new copied product costs
        $('[name="cutsheets[' + cutsheetsCount + '][qty]"]').trigger('change');

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
        //console.log(numberOfTds);
        for (var i = 0; i < numberOfTds; i++) {
            options = options.replace('midrails[' + midrailsCount + ']', 'midrails[' + (midrailsCount + 1) + ']');
            options = options.replace('midrails-' + midrailsCount, 'midrails-' + (midrailsCount + 1));
        }


        options = options.replace('visibility: hidden', 'visibility: visible');
        prices = prices.replace('row-' + midrailsCount, 'row-' + (midrailsCount + 1));
        prices = prices.replace('midrails[' + midrailsCount + '][midrail_cost]', 'midrails[' + (midrailsCount + 1) + '][midrail_cost]');
        prices = prices.replace('midrails-' + midrailsCount + '-midrail-cost', 'midrails-' + (midrailsCount + 1) + '-midrail-cost');


        $('.midrail-table').append('<tr id="midrail-options-row-' + (midrailsCount + 1) + '" class="midrail-options-row" >' + options + '</tr>');
        $('.midrail-table').append('<tr id="midrail-prices-row-' + (midrailsCount + 1) + '" class="midrail-prices-row" >' + prices + '</tr>');


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


        if (midrailsCount >= midrailMax) {
            $('#add-midrail-btn').css('visibility', 'hidden');
        }

    });


    $('body').on('click', '.midrail-delete', function () {
        var midrailRow = $(this).parents('tr');
        var pricesRow = midrailRow.next();
        var midrailIndex = findIndexById(midrailRow);


        if (isEdit) {
            var id = $('[name="midrails[' + midrailIndex + '][id]"]').val();
            if (id) {
                $('input[name="midrails_to_delete"]').val(id + ',' + $('input[name="midrails_to_delete"]').val());
            }
        }


        midrailRow.remove();
        pricesRow.remove();

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
        additionalPerMeter.splice(index, 1);
        calculateAddtionalsTotal();
    });
    
        
    //Additional PER FULL LENGTH
    $('#add-row-additional-l').on('click', function () {

        if (additionalsLengthCount >= additionalLengthMAX) {
            return;
        }

        var row = $('#additional-l-row-0').html();

        var numberOfTds = $('#additional-l-row-0 td').length;

        for (var i = 0; i < numberOfTds; i++) {
            row = row.replace('additionalperlength[0]', 'additionalperlength[' + (additionalsLengthCount + 1) + ']');
            row = row.replace('additionalperlength-0', 'additionalperlength-' + (additionalsLengthCount + 1));
            row = row.replace('selected="selected"', '');
        }
        row = row.replace('visibility: hidden', 'visibility: visible');


        // Hidden the Last Row Delete button
        $('.additional-l-table tr').last().find('td').last().find('button').css('visibility', 'hidden');
        //***************

        $('.additional-l-table').append('<tr id="additional-l-row-' + (additionalsLengthCount + 1) + '">' + row + '</tr>');
        additionalsLengthCount++;


        if (isEdit) {
            var newRow = $('.additional-l-table').find('tr').last();
            newRow.find('input').val('');
            newRow.find('select').val('');
            newRow.find('input[type="hidden"]').remove();
        }


        if (additionalsLengthCount >= additionalLengthMAX) {
            $(this).css('visibility', 'hidden');
        }
    });

    $('body').on('click', '.addtional-l-delete', function () {
        var additionalRow = $(this).parents('tr');
        var index = findIndexById(additionalRow);


        if (isEdit) {
            var id = $('[name="additionalperlength[' + index + '][id]"]').val();
            if (id) {
                $('input[name="additional_l_to_delete"]').val(id + ',' + $('input[name="additional_l_to_delete"]').val());
            }
        }


        additionalRow.remove();
        additionalsLengthCount--;
        $('#add-row-additional-l').css('visibility', 'visible');


        // Show the Last Row Delete button
        if (additionalsLengthCount > 4) {
            $('.additional-l-table tr').last().find('td').last().find('button').css('visibility', 'visible');
        }
        //***************

        additonalLengths.splice(index, 1);
        additionalPerLength.splice(index, 1);
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
        calculateCustomItemsTotal();
    });

	/*$('body').on('change', '.product-sec-dg-fibr', function (evt, data) {
		var countProduct = $('.product-sec-dg-fibr').length;
		var count_product = countProduct-1;
		var productpm = [];
		for(var totalproduct=0;totalproduct<=count_product;totalproduct++){
			var selectname = $('[name="products[' + totalproduct + '][product_sec_dig_perf_fibr]"]').val();
			if (selectname == '316 S/S' || selectname == 'Perf') {
				productpm.push('hybrid-pm');
			}
			if (selectname == 'D/Grille' || selectname == 'Insect') {
				productpm.push('hybrid-mx');
			}
		}
		if(jQuery.inArray('hybrid-pm',productpm)){
			$('.hybrid-pm').css('display','block');
		}
		if(jQuery.inArray('hybrid-mx',productpm)){
			$('.hybrid-mx').css('display','block');
		}
	});*/
    /*** Products On change Event => Calculator ***/
    $('body').on('change', '.product-options', function (evt, data) {

        var product = $(this).parents('.product-options-row');
		var secDigFibr = product.find('.product-sec-dg-fibr').val();
		if (secDigFibr == '316 S/S' || secDigFibr == 'Perf') {
			isHybrid = true;
		}else{
			isHybrid = false;
		}
		if(isHybrid){
			var productOptions = product.next();
			var productIndex = findIndexById(product);
			var qty = 1;
			//*****Dom Elements*****:
			var $qty = product.find('.product-qty');
			var $lockCount = product.find('.product-lock-qty');
			var $lockType = product.find('.product-lock-type');
			//Values
			var newQty = Number(product.find('.product-qty').val());
			var secDigFibr = product.find('.product-sec-dg-fibr').val();
			var ssgalpet = product.find('.product-ss-gal-pet').val();
			var winDoor = product.find('.product-win-door').val();
			var height = Number(product.find('.product-height').val());
			var width = Number(product.find('.product-width').val());
			var lockCounts = Number($lockCount.val());
			var lockType = $lockType.val();
			var includeMidrailCheckbox = productOptions.find('.product-inc-midrail').is(':checked');
			var includeIncorporateInstallCheckbox = $('#installation-type-incorporate-install').is(':checked');
			var productConf = product.find('.product-conf').find('option:selected').attr('data-code');
			var productColour = product.find('.product-colour').val();
			var discountPercentage = Number($('input[name=discount]').val());
			//------ Change Dropdown Color on Window/Door change ------)
			var winDoorDropdown = product.find('.product-win-door');
			if (winDoor == 'Door') {
				winDoorDropdown.css('background', '#ffab26');
			} else if (winDoor == 'Window') {
				winDoorDropdown.css('background', 'lightblue');
			} else {
				//winDoorDropdown.css('background', 'none');
				winDoorDropdown.css('background', '#fff');
			}

			//---------- Disable Frame Type When Door is Selected --------------
			var productFrameType = product.find('.product-frame-type');
			var frameType = '';
			switch (productFrameType.val()) {
				case '9mm':
					frameType = 'mm9';
					break;
				case '11mm':
					frameType = 'mm11';
					break;
				default:
					frameType = 'default';
					break;            
			}
			if (product.find('.product-win-door').val() == 'Door') {
				productFrameType.prop('disabled', true);
				productFrameType.val('');
			} else {
				productFrameType.prop('disabled', false);
			}
	
			//------------------------


			/***********************/
			var hrlyRate = 0;
			var cleanUp = 0;
			var markup = 0;
			var tableName = '';
			var matrixArr = null;
			var petMeshMarkup = 0;
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
			var hasSpline = false;
			var hasInsectMesh = false;
			var hasComponentsHinges = false;
			var hasPvc = false;
			var hasPerfSheetFixing = false;
			
			//**** Common Variables (Window or Door) ****
			var heightMesh = 0;
			var widthMesh = 0;
			var sqmPart = 0;
			var frame = 0;
			var cnrStake = 0;
			var hingedCalculated = 0;
			if (secDigFibr == '316 S/S') {
				if (winDoor == 'Door') {
					heightMesh = Number(height - securityDoorMesh);
					widthMesh = Number(width - securityDoorMesh);
					isSecDoor = true;  
					hasComponentsHinges = true;
					hasPvc = true;
					matrixArr = JSON.parse($('input[data-name="S/S Hinged and Sliding Doors"]').val()); 
					pricingArr = JSON.parse($('input[data-name="secDoor"]').val()); 
					tableName = $('input[data-name="S/S Hinged and Sliding Doors"]').data('name');
					cleanUp = secDoorCleanUp;
					hrlyRate = sdHrlyRate;
					markup = sdMarkup;                
					sqmPart = pricingArr.sqmpart.price; //Confirm
					frame = pricingArr.frame.price;
					cnrStake = pricingArr.crnstake.price;
					productMc.find('span.product-mc-secdigfibr').text( pricingArr.secdigfibr );
					productMc.find('span.product-mc-windoor').text( pricingArr.windoor );
					productMc.find('span.product-winframe-name').text( pricingArr.frame.label );
					productMc.find('span.product-win-cnrstake-name').text( pricingArr.crnstake.label );                                                

				} else if (winDoor == 'Window') {
					
					heightMesh = Number(height - securityWindowMesh);
					widthMesh = Number(width - securityWindowMesh);
					isSecWindow = true;
					hasPvc = true;
					
					matrixArr = JSON.parse($('input[data-name="S/S Window Screens"]').val());
					pricingArr = JSON.parse($('input[data-name="secWindow"]').val());
					tableName = $('input[data-name="S/S Window Screens"]').data('name');
					cleanUp = secWindowCleanUp;
					hrlyRate = swHrlyRate;
					markup = swMarkup;
					
					sqmPart = pricingArr.sqmpart.price; //Confirm
					frame = pricingArr.frame[frameType].price; 
					cnrStake = pricingArr.crnstake[frameType].price;
								   
					productMc.find('span.product-mc-secdigfibr').text( pricingArr.secdigfibr );
					productMc.find('span.product-mc-windoor').text( pricingArr.windoor );
					productMc.find('span.product-winframe-name').text( pricingArr.frame[frameType].label );
					productMc.find('span.product-win-cnrstake-name').text( pricingArr.crnstake[frameType].label ); 
				}

				productOptions.find('td').css('background-color', '#FAEBE6');

			} else if (secDigFibr == 'Perf') {
				if (winDoor == 'Door') {
					heightMesh = Number(height - perfDoorMesh);
					widthMesh = Number(width - perfDoorMesh);
					
					isPerfDoor = true;
					hasPerfSheetFixing = true;
					hasComponentsHinges = true;
					
					matrixArr = JSON.parse($('input[data-name="Perf Hinged and Sliding Doors"]').val());
					tableName = $('input[data-name="Perf Hinged and Sliding Doors"]').data('name');
					pricingArr = JSON.parse($('input[data-name="perfDoor"]').val());
					
					cleanUp = perfDoorCleanup;
					hrlyRate = pdHrlyRate;
					markup = pdMarkup;
					
					sqmPart = pricingArr.sqmpart.price; //Confirm
					frame = pricingArr.frame.price;
					cnrStake = pricingArr.crnstake.price;               
					
					productMc.find('span.product-mc-secdigfibr').text( pricingArr.secdigfibr );
					productMc.find('span.product-mc-windoor').text( pricingArr.windoor );
					productMc.find('span.product-winframe-name').text( pricingArr.frame.label );
					productMc.find('span.product-win-cnrstake-name').text( pricingArr.crnstake.label );

				} else if (winDoor == 'Window') {
					heightMesh = Number(height - perfWindowMesh);
					widthMesh = Number(width - perfWindowMesh);
					
					isPerfWindow = true;
					hasPerfSheetFixing = true;
					
					matrixArr = JSON.parse($('input[data-name="Perf Windows"]').val());
					tableName = $('input[data-name="Perf Windows"]').data('name');
					pricingArr = JSON.parse($('input[data-name="perfWindow"]').val());
					
					cleanUp = perfWindowCleanup;
					hrlyRate = pwHrlyRate;
					markup = pwMarkup;
					
					
					sqmPart = pricingArr.sqmpart.price; //Confirm
					frame = pricingArr.frame[frameType].price; 
					cnrStake = pricingArr.crnstake[frameType].price;
								   
					productMc.find('span.product-mc-secdigfibr').text( pricingArr.secdigfibr );
					productMc.find('span.product-mc-windoor').text( pricingArr.windoor );
					productMc.find('span.product-winframe-name').text( pricingArr.frame[frameType].label );
					productMc.find('span.product-win-cnrstake-name').text( pricingArr.crnstake[frameType].label );
				}

				productOptions.find('td').css('background-color', '#eaf6ff');
			} else {
				productOptions.find('td').css('background-color', '#fff');
			}


			//**** Mesh Increasing Amounts *****
			if ((secDigFibr == 'Insect' || secDigFibr == 'D/Grille') && ssgalpet == 'Pet Mesh') {            
				productMc.find('tr.insect-mesh-row').show();
				if (winDoor == 'Door') {
					petMeshMarkup = Number($('#dg-ins-door-infill').text()).toFixed(2);
				} else if (winDoor == 'Window') {
					petMeshMarkup = Number($('#dg-ins-win-infill').text()).toFixed(2);
				}
			} else {
				productMc.find('tr.insect-mesh-row').hide();
			}
								   
			var lSeatCalculated = 0;
			var pvcCalculated = 0;
			var splineCalculated = 0;
			var perfSheetFixingCalculated = 0;
			var insectMeshCalculated = 0;
			
			productMc.find('span.product-mesh-height').text(heightMesh);
			productMc.find('span.product-mesh-width').text(widthMesh);
			
			productMc.find('span.product-height').text(height);
			productMc.find('span.product-width').text(width);
			
			var pwdCoat = ((width + height) * 2 / 5000).toFixed(1);
			productMc.find('span.product-coat').text(pwdCoat);

			var productLmtr = ((width + height) * 2 / 1000).toFixed(1);
			productMc.find('span.product-lmtrs').text(productLmtr);
			
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
			
		   
			if (hasSpline) {

				splineCalculated = (spline * productLmtr).toFixed(2);
				productMc.find('tr.spline-row').show();
				productMc.find('span.product-spline-name').text(splineName);
				productMc.find('span.product-spline').text(spline);
				productMc.find('span.product-spline-calculated').text(splineCalculated);

			} else {
				productMc.find('tr.spline-row').hide();
			}
			
			if (hasInsectMesh) {
				productMc.find('tr.insect-mesh-row').show();

				if (ssgalpet == 'Pet Mesh') {
					insectMeshCalculated = (sqm * petMesh).toFixed(2);
				} else {
					insectMeshCalculated = (sqm * insectMesh).toFixed(2);
				}
				productMc.find('span.product-insect-mesh').text(insectMeshCalculated);
			} else {
				productMc.find('tr.insect-mesh-row').hide();
			}
			
			if (hasPvc) {
				productMc.find('tr.pvc-row').show();
				productMc.find('tr.lseat-row').show();
				productMc.find('span.product-lseat-name').text(PVCLSeatName);
				productMc.find('span.product-lseat-price').text(PVCLSeat);
				
				lSeatCalculated = (PVCLSeat * productLmtr).toFixed(2);
				productMc.find('span.product-lseat-calculated').text(lSeatCalculated);
				
				productMc.find('span.product-pvc-wedge-price').text(PVCWedge);
				productMc.find('span.product-pvc-wedge-name').text(PVCWedgeName);
				
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
			
			// **** Hide or Show MC Tabels ****
			if (isSecDoor || isSecWindow || isDgDoor || isDgWindow || isFibrDoor || isFibrWindow || isPerfDoor || isPerfWindow) {
				productMc.show();
				productResult.show();
				
			} else {
				productMc.hide();
				productResult.hide();
			}
			/*****************/



			// Custom And Premium Color Costs
			var customColor = 0;
			var prColor = 0;
			var anodizedColor = 0;
			var specialColor = 0;
			
			if (productColour) {
				var productColourAttr = productColour.split('|');
				var productColourGroup = productColourAttr[0];
				var productColourOption = productColourAttr[1];
				
				if (winDoor == 'Door') {
					if (productColourGroup == 'Custom Colour')
						customColor = (qty * Number($('.custom-color-door').text())).toFixed(2);
					//if (productColourGroup == 'Standard Color')
						//customColor = (qty * Number($('.custom-color-door').text())).toFixed(2);
					if (productColourGroup == 'Anodized')
						anodizedColor = (qty * Number($('.anodized-color-door').text())).toFixed(2);
					if (productColourGroup == 'Premium Colour')
						prColor = (qty * Number($('.pr-color-door').text())).toFixed(2);
					if (productColourGroup == 'Special Colour')
						specialColor = (qty * Number($('.special-color-door').text())).toFixed(2);                    
				} else if (winDoor == 'Window') {
					if (productColourGroup == 'Custom Colour')
						customColor = (qty * Number($('.custom-color-win').text())).toFixed(2);
					//if (productColourGroup == 'Standard Color')
						//customColor = (qty * Number($('.custom-color-win').text())).toFixed(2);
					if (productColourGroup == 'Anodized')
						anodizedColor = (qty * Number($('.anodized-color-win').text())).toFixed(2);
					if (productColourGroup == 'Premium Colour')
						prColor = (qty * Number($('.pr-color-win').text())).toFixed(2);
					if (productColourGroup == 'Special Colour')
						specialColor = (qty * Number($('.special-color-win').text())).toFixed(2);               
				}            
			}else{
				if (winDoor == 'Door') {
					if ($('[name="color1_color"]').val() && $('[name="color1"]').is(':checked')) {
						customColor = (qty * Number($('.custom-color-door').text())).toFixed(2);
					}
					if ($('[name="color2_color"]').val() && $('[name="color2"]').is(':checked')) {
						prColor = (qty * Number($('.pr-color-door').text())).toFixed(2);
					}
					if ($('[name="color3_color"]').val() && $('[name="color3"]').is(':checked')) {
						anodizedColor = (qty * Number($('.anodized-color-door').text())).toFixed(2);
					}
					if ($('[name="color4_color"]').val() && $('[name="color4"]').is(':checked')) {
						specialColor = (qty * Number($('.special-color-door').text())).toFixed(2);
					}

				} else if (winDoor == 'Window') {
					if ($('[name="color1_color"]').val() && $('[name="color1"]').is(':checked')) {
						customColor = (qty * Number($('.custom-color-win').text())).toFixed(2);
					}
					if ($('[name="color2_color"]').val() && $('[name="color2"]').is(':checked')) {
						prColor = (qty * Number($('.pr-color-win').text())).toFixed(2);
					}
					if ($('[name="color3_color"]').val() && $('[name="color3"]').is(':checked')) {
						anodizedColor = (qty * Number($('.anodized-color-win').text())).toFixed(2);
					}
					if ($('[name="color4_color"]').val() && $('[name="color4"]').is(':checked')) {
						specialColor = (qty * Number($('.special-color-win').text())).toFixed(2);
					}
				}            
			}
					
			// Sum of All "Calculated" Values:
			var materialCost = 0.00;

			if (secDigFibr && winDoor) {
				materialCost = (Number(sqmCalculated) + Number(frameCalculated) + Number(perfSheetFixingCalculated)
				+ Number(insectMeshCalculated)
				+ Number(cnrstakeCalculated) + Number(lSeatCalculated) + Number(pvcCalculated)
				+ Number(customColor) + Number(prColor) + Number(anodizedColor) + Number(specialColor)
				+ Number(splineCalculated) + Number(freightConsumables) + Number(hingedCalculated)).toFixed(2);
			}
			
			productMc.find('span.product-material-cost').text(materialCost);
					

			var price = 0;
			var filteredArray = [];
			
			price = materialCost;

			//Labout inc Cutting Applied - Price multiplied by QTY
			var labourIncCutting = ((hrlyRate / 60) * cleanUp).toFixed(2);
			productMc.find('span.product-labour-incl-cutting').text(labourIncCutting);
			
			var priceWithLabourIncCutting = (Number(price) + Number(labourIncCutting)).toFixed(2);
			productMc.find('span.product-total-cost').text(priceWithLabourIncCutting);

			priceWithLabourIncCutting = (Number(priceWithLabourIncCutting) * (Number(petMeshMarkup) + Number(100)) / 100).toFixed(2);

			//var noMarkupCost = (Number(price) + Number(customColor) + Number(prColor)).toFixed(2);
			var noMarkupCost = (Number(price) + Number(customColor) + Number(prColor) +  Number(anodizedColor) + Number(specialColor)).toFixed(2);
			//var noMarkupCost = (Number(price)).toFixed(2);
			price = priceWithLabourIncCutting;
			
			
			//Product Markup Applied by SecDgFibre
			var resultTotal = (price * (Number(markup) + Number(100)) / 100).toFixed(2);
			
			var masterMarkup = getMasterMarkupByMatrixTable(tableName);
			//Master Markup Applied
			resultTotal = Number(resultTotal * (Number(masterMarkup) + Number(100)) / 100).toFixed(2);
			
			productResult.find('span.product-result-cost').text(resultTotal);
			productResult.find('span.product-result-quantity').text(newQty);
			

			calculateInstallation(product, productIndex, true);
			if (includeMidrailCheckbox) {
			   
				resultTotal = (Number(resultTotal) + Number(midrailAmount)).toFixed(2);
				noMarkupCost = (Number(noMarkupCost) +  Number(midrailCost)).toFixed(2);
			}
			

			noMarkupCost = (Number(noMarkupCost) * Number(newQty)).toFixed(2);
			resultTotal = (Number(resultTotal) * Number(newQty)).toFixed(2);

			var locksTotalCost = 0;
			//Calculate Lcoks
			if (winDoor == 'Door') {
				$lockCount.prop('disabled', false);
				$lockType.prop('disabled', false);
				
			   if (secDigFibr == 'Insect') {               
				   
					$lockType.find('option:last').hide();
				} else {
					$lockType.find('option:last').show();
				}


				var confRuled = product.attr('data-conf-rule');

				//Decrease cost when LOCK Type is Changed
							
				if (lockType == 'Single Sld' && lockCounts) {
					locksTotalCost = Number( Number(singleLockSld * lockCounts) + lockCyl ).toFixed(2);
					resultTotal = Number( Number(resultTotal) + Number(locksTotalCost)).toFixed(2);
					noMarkupCost = Number( Number(noMarkupCost) + Number(locksTotalCost) ).toFixed(2);
				} else if( lockType == 'Single Hng' && lockCounts){
					locksTotalCost = Number( Number( (singleLockHng * lockCounts) + lockCyl )).toFixed(2);
					resultTotal = Number(Number(resultTotal) + Number(locksTotalCost) ).toFixed(2);
					noMarkupCost = Number( Number(noMarkupCost) + Number(locksTotalCost) ).toFixed(2);
				} else if (lockType == 'Triple Sld' && lockCounts){
					locksTotalCost = Number( Number( (tripleLockSld * lockCounts) + lockCyl) ).toFixed(2);
					resultTotal = Number( Number(resultTotal) + Number(locksTotalCost) ).toFixed(2);
					noMarkupCost = Number( Number(noMarkupCost) + Number(locksTotalCost) ).toFixed(2);
				} else if (lockType == 'Triple Hng' && lockCounts){
					locksTotalCost = Number(Number( (tripleLockHng * lockCounts) + lockCyl)).toFixed(2);
					resultTotal = Number(Number(resultTotal) + Number(locksTotalCost) ).toFixed(2);
					noMarkupCost =  Number(Number(noMarkupCost) + Number(locksTotalCost) ).toFixed(2);
				}
								 

			} else if (winDoor == 'Window') {
				$lockCount.val('').prop('disabled', true);
				$lockType.val('').prop('disabled', true);
			}
			
			productResult.find('span.product-result-locks').text(locksTotalCost);
			productResult.find('span.product-result-total').text(resultTotal);
			//--------------
					
			
			productsNoMarkup[productIndex] = noMarkupCost;
			screensTotal[productIndex] = resultTotal;
			
			calculateScreensTotal();


			var sellPrice = resultTotal;
			if (role != 'retailer' && mfrole != 'retailer') {
				if (secDigFibr) {
					var selector = getMarkupInputID(secDigFibr);
					sellPrice = (resultTotal * Number($(selector).val()) / 100).toFixed(2);
					sellPrice = (Number(resultTotal) + Number(sellPrice)).toFixed(2);
				}
			}
			var profit = (Number(sellPrice) - Number(resultTotal)).toFixed(2);
			var profitPerProduct = profit;
			var sellPricePerProduct = sellPrice;
			if(discountPercentage > 0){
					var discountPrice = Number(sellPrice * Number(discountPercentage) / 100).toFixed(2);
					profitPerProduct =  Number(profit - discountPrice).toFixed(2);
					sellPrice = Number(sellPrice - discountPrice).toFixed(2);
			 }

			var inclGst = resultTotal;
			if (includeIncorporateInstallCheckbox) {
				sellPricePerProduct = (Number(sellPricePerProduct) + Number(INCORPORATE_INSTALLATION) * Number(newQty)).toFixed(2);
			}
			noMarkupCost = (Number(noMarkupCost) * Number(newQty)).toFixed(2);
			productOptions.find('input.product-price-incl-gst').val(inclGst);
			productOptions.find('input.product-sell-price').val(sellPricePerProduct);


			productOptions.find('input.product-profit').val(profitPerProduct);

			markups.addToMarkups(profit, productIndex, secDigFibr);
		}else{
			var productOptions = product.next();
			var productIndex = findIndexById(product);

			var qty = 1;

			//*****Dom Elements*****:
			var $qty = product.find('.product-qty');
			var $lockCount = product.find('.product-lock-qty');
			var $lockType = product.find('.product-lock-type');
			
			//Values
			var newQty = Number(product.find('.product-qty').val());
			var secDigFibr = product.find('.product-sec-dg-fibr').val();
			var ssgalpet = product.find('.product-ss-gal-pet').val();
			var winDoor = product.find('.product-win-door').val();
			var height = Number(product.find('.product-height').val());
			var width = Number(product.find('.product-width').val());
			var lockCounts = Number($lockCount.val());
			var lockType = $lockType.val();
			var includeMidrailCheckbox = productOptions.find('.product-inc-midrail').is(':checked');
			var includeIncorporateInstallCheckbox = $('#installation-type-incorporate-install').is(':checked');
			var productConf = product.find('.product-conf').find('option:selected').attr('data-code');
			var productColour = product.find('.product-colour').val();

			var discountPercentage = Number($('input[name=discount]').val());
					

			//------ Change Dropdown Color on Window/Door change ------)
			var winDoorDropdown = product.find('.product-win-door');

			if (winDoor == 'Door') {
				winDoorDropdown.css('background', '#ffab26');
			} else if (winDoor == 'Window') {
				winDoorDropdown.css('background', 'lightblue');
			} else {
				//winDoorDropdown.css('background', 'none');
				winDoorDropdown.css('background', '#fff');
			}


			//---------- Disable Frame Type When Door is Selected --------------
			var productFrameType = product.find('.product-frame-type');
			if (product.find('.product-win-door').val() == 'Door') {
				productFrameType.prop('disabled', true);
				productFrameType.val('');
			} else {
				productFrameType.prop('disabled', false);
			}
			//------------------------


			/***********************/
			var hrlyRate = 0;
			var cleanUp = 0;
			var markup = 0;
			var tableName = '';
			var matrixArr = null;
			var petMeshMarkup = 0;

			if (secDigFibr == '316 S/S') {
				if (winDoor == 'Door') {

					matrixArr = JSON.parse($('input[data-name="S/S Hinged and Sliding Doors"]').val());
					tableName = $('input[data-name="S/S Hinged and Sliding Doors"]').data('name');
					cleanUp = secDoorCleanUp;
					hrlyRate = sdHrlyRate;
					markup = sdMarkup;

				} else if (winDoor == 'Window') {
					matrixArr = JSON.parse($('input[data-name="S/S Window Screens"]').val());
					tableName = $('input[data-name="S/S Window Screens"]').data('name');
					cleanUp = secWindowCleanUp;
					hrlyRate = swHrlyRate;
					markup = swMarkup;
				}

				productOptions.find('td').css('background-color', '#FAEBE6');

			} else if (secDigFibr == 'D/Grille') {
				if (winDoor == 'Door') {
					matrixArr = JSON.parse($('input[data-name="DG Hinged and Sliding Doors"]').val());
					tableName = $('input[data-name="DG Hinged and Sliding Doors"]').data('name');
					cleanUp = dgDoorCleanup;
					hrlyRate = ddHrlyRate;
					markup = ddMarkup;

				} else if (winDoor == 'Window') {
					matrixArr = JSON.parse($('input[data-name="DG Windows"]').val());
					tableName = $('input[data-name="DG Windows"]').data('name');
					cleanUp = dgWindowCleanup;
					hrlyRate = dwHrlyRate;
					markup = dwMarkup;
				}

				productOptions.find('td').css('background-color', '#FCFCE1');

			} else if (secDigFibr == 'Insect') {
				if (winDoor == 'Door') {
					matrixArr = JSON.parse($('input[data-name="Insect Hinged and Sliding Doors"]').val());
					tableName = $('input[data-name="Insect Hinged and Sliding Doors"]').data('name');
					cleanUp = fibrDoorCleanup;
					hrlyRate = fdHrlyRate;
					markup = fdMarkup;

				} else if (winDoor == 'Window') {
					matrixArr = JSON.parse($('input[data-name="Insect Screens"]').val());
					tableName = $('input[data-name="Insect Screens"]').data('name');
					cleanUp = fibrWindowCleanup;
					hrlyRate = fwHrlyRate;
					markup = fwMarkup;
				}

				productOptions.find('td').css('background-color', '#F2F1EF');

			} else if (secDigFibr == 'Perf') {
				if (winDoor == 'Door') {
					matrixArr = JSON.parse($('input[data-name="Perf Hinged and Sliding Doors"]').val());
					tableName = $('input[data-name="Perf Hinged and Sliding Doors"]').data('name');
					cleanUp = perfDoorCleanup;
					hrlyRate = pdHrlyRate;
					markup = pdMarkup;

				} else if (winDoor == 'Window') {
					matrixArr = JSON.parse($('input[data-name="Perf Windows"]').val());
					tableName = $('input[data-name="Perf Windows"]').data('name');
					cleanUp = perfWindowCleanup;
					hrlyRate = pwHrlyRate;
					markup = pwMarkup;
				}

				productOptions.find('td').css('background-color', '#eaf6ff');
			} else {
				productOptions.find('td').css('background-color', '#fff');
			}


			//**** Mesh Increasing Amounts *****
			if ((secDigFibr == 'Insect' || secDigFibr == 'D/Grille') && ssgalpet == 'Pet Mesh') {
				if (winDoor == 'Door') {
					petMeshMarkup = Number($('#dg-ins-door-infill').text()).toFixed(2);
				} else if (winDoor == 'Window') {
					petMeshMarkup = Number($('#dg-ins-win-infill').text()).toFixed(2);
				}
			}




			// Custom And Premium Color Costs
			var customColor = 0;
			var prColor = 0;
			var anodizedColor = 0;
			var specialColor = 0;
			
			if (productColour) {
				var productColourAttr = productColour.split('|');
				var productColourGroup = productColourAttr[0];
				var productColourOption = productColourAttr[1];
				
				if (winDoor == 'Door') {
					if (productColourGroup == 'Custom Colour')
						customColor = (qty * Number($('.custom-color-door').text())).toFixed(2);
					//if (productColourGroup == 'Standard Color')
						//customColor = (qty * Number($('.custom-color-door').text())).toFixed(2);
					if (productColourGroup == 'Anodized')
						anodizedColor = (qty * Number($('.anodized-color-door').text())).toFixed(2);
					if (productColourGroup == 'Premium Colour')
						prColor = (qty * Number($('.pr-color-door').text())).toFixed(2);
					if (productColourGroup == 'Special Colour')
						specialColor = (qty * Number($('.special-color-door').text())).toFixed(2);                    
				} else if (winDoor == 'Window') {
					if (productColourGroup == 'Custom Colour')
						customColor = (qty * Number($('.custom-color-win').text())).toFixed(2);
					//if (productColourGroup == 'Standard Color')
						//customColor = (qty * Number($('.custom-color-win').text())).toFixed(2);
					if (productColourGroup == 'Anodized')
						anodizedColor = (qty * Number($('.anodized-color-win').text())).toFixed(2);
					if (productColourGroup == 'Premium Colour')
						prColor = (qty * Number($('.pr-color-win').text())).toFixed(2);
					if (productColourGroup == 'Special Colour')
						specialColor = (qty * Number($('.special-color-win').text())).toFixed(2);               
				}            
			}else{
				if (winDoor == 'Door') {
					if ($('[name="color1_color"]').val() && $('[name="color1"]').is(':checked')) {
						customColor = (qty * Number($('.custom-color-door').text())).toFixed(2);
					}
					if ($('[name="color2_color"]').val() && $('[name="color2"]').is(':checked')) {
						prColor = (qty * Number($('.pr-color-door').text())).toFixed(2);
					}
					if ($('[name="color3_color"]').val() && $('[name="color3"]').is(':checked')) {
						anodizedColor = (qty * Number($('.anodized-color-door').text())).toFixed(2);
					}
					if ($('[name="color4_color"]').val() && $('[name="color4"]').is(':checked')) {
						specialColor = (qty * Number($('.special-color-door').text())).toFixed(2);
					}

				} else if (winDoor == 'Window') {
					if ($('[name="color1_color"]').val() && $('[name="color1"]').is(':checked')) {
						customColor = (qty * Number($('.custom-color-win').text())).toFixed(2);
					}
					if ($('[name="color2_color"]').val() && $('[name="color2"]').is(':checked')) {
						prColor = (qty * Number($('.pr-color-win').text())).toFixed(2);
					}
					if ($('[name="color3_color"]').val() && $('[name="color3"]').is(':checked')) {
						anodizedColor = (qty * Number($('.anodized-color-win').text())).toFixed(2);
					}
					if ($('[name="color4_color"]').val() && $('[name="color4"]').is(':checked')) {
						specialColor = (qty * Number($('.special-color-win').text())).toFixed(2);
					}
				}            
			}
			
			var price = 0;
			var filteredArray = [];
			if (matrixArr) {
				filteredArray = matrixArr.filter(function (item) {
					return width <= item.width && height <= item.height;
				});
				if (filteredArray.length > 0) {
					price = Number(filteredArray[0]['price']);
				}
			}

			price = Number(price) * Number(qty);


			//Labout inc Cutting Applied - Price multiplied by QTY
			var labourIncCutting = ((hrlyRate / 60) * cleanUp).toFixed(2);
			var priceWithLabourIncCutting = (Number(price) + Number(labourIncCutting)).toFixed(2);

			priceWithLabourIncCutting = (Number(priceWithLabourIncCutting) * (Number(petMeshMarkup) + Number(100)) / 100).toFixed(2);

			//var noMarkupCost = (Number(price) + Number(customColor) + Number(prColor)).toFixed(2);
			var noMarkupCost = (Number(price) + Number(customColor) + Number(prColor) +  Number(anodizedColor) + Number(specialColor)).toFixed(2);

			price = priceWithLabourIncCutting;


			//Product Markup Applied by SecDgFibre
			var resultTotal = (price * (Number(markup) + Number(100)) / 100).toFixed(2);


			var masterMarkup = getMasterMarkupByMatrixTable(tableName);

			//Master Markup Applied
			resultTotal = Number(resultTotal * (Number(masterMarkup) + Number(100)) / 100).toFixed(2);

			calculateInstallation(product, productIndex, true);

			//Sum of price and Color costs
			//resultTotal = (Number(customColor) + Number(prColor) + Number(resultTotal)).toFixed(2);
			resultTotal = (Number(customColor) + Number(prColor) + Number(anodizedColor) + Number(specialColor) + Number(resultTotal)).toFixed(2);
			if (includeMidrailCheckbox) {
				resultTotal = (Number(resultTotal) + Number($('span.inc-midrail-amount').text())).toFixed(2);
			}
			if (includeIncorporateInstallCheckbox) {
				//resultTotal = (Number(resultTotal) + Number(calculateIncorporateInstallation(product)));
			}
			noMarkupCost = (Number(noMarkupCost) * Number(newQty)).toFixed(2);
			resultTotal = (Number(resultTotal) * Number(newQty)).toFixed(2);


			//Calculate Lcoks
			if (winDoor == 'Door') {
				$lockCount.prop('disabled', false);
				$lockType.prop('disabled', false);
				if (secDigFibr == 'Insect') {
					resultTotal = (Number(resultTotal) - Number(singleLock * newQty)).toFixed(2);
					noMarkupCost = (Number(noMarkupCost) - Number(singleLock * newQty)).toFixed(2);
					$lockType.find('option:last').hide();
				} else {
					resultTotal = (Number(resultTotal) - Number(tripleLock * newQty)).toFixed(2);
					noMarkupCost = (Number(noMarkupCost) - Number(tripleLock * newQty)).toFixed(2);
					$lockType.find('option:last').show();
				}


				var confRuled = product.attr('data-conf-rule');
				
				//Decrease cost when LOCK Type is Changed
				if (lockType == 'Single' && lockCounts) {
					resultTotal = (Number(resultTotal) + Number(lockCounts * singleLock)).toFixed(2);
					noMarkupCost = (Number(noMarkupCost) + Number(lockCounts * singleLock)).toFixed(2);
				} else if (lockType == 'Triple' && lockCounts) {
					resultTotal = (Number(resultTotal) + Number(lockCounts * tripleLock)).toFixed(2);
					noMarkupCost = (Number(noMarkupCost) + Number(lockCounts * tripleLock)).toFixed(2);
				}

			} else if (winDoor == 'Window') {
				$lockCount.val('').prop('disabled', true);
				$lockType.val('').prop('disabled', true);
			}
			//--------------
			   
			productsNoMarkup[productIndex] = noMarkupCost;
			screensTotal[productIndex] = resultTotal;
			calculateScreensTotal();


			var sellPrice = resultTotal;
			if (role != 'retailer' && mfrole != 'retailer') {
				if (secDigFibr) {
					var selector = getMarkupInputID(secDigFibr);
					sellPrice = (resultTotal * Number($(selector).val()) / 100).toFixed(2);
					sellPrice = (Number(resultTotal) + Number(sellPrice)).toFixed(2);
				}
			}
			var profit = (Number(sellPrice) - Number(resultTotal)).toFixed(2);
			var profitPerProduct = profit;
			var sellPricePerProduct = sellPrice;
			if(discountPercentage > 0){
					var discountPrice = Number(sellPrice * Number(discountPercentage) / 100).toFixed(2);
					profitPerProduct =  Number(profit - discountPrice).toFixed(2);
					sellPrice = Number(sellPrice - discountPrice).toFixed(2);
			 }

			var inclGst = resultTotal;
			if (includeIncorporateInstallCheckbox) {
				//inclGst = (Number(inclGst) - (Number(calculateIncorporateInstallation(product)) * Number(newQty))).toFixed(2);
				sellPricePerProduct = (Number(sellPricePerProduct) + Number(INCORPORATE_INSTALLATION) * Number(newQty)).toFixed(2);
			}
			noMarkupCost = (Number(noMarkupCost) * Number(newQty)).toFixed(2);
			productOptions.find('input.product-price-incl-gst').val(inclGst);
			productOptions.find('input.product-sell-price').val(sellPricePerProduct);


			productOptions.find('input.product-profit').val(profitPerProduct);

			markups.addToMarkups(profit, productIndex, secDigFibr);
			
			var includeMidrail = $('.midrail-inc[data-table="' + tableName + '"]').val();

			var incMidrail = false;
			if (includeMidrail) {
				includeMidrail = JSON.parse(includeMidrail);
				if (includeMidrail && filteredArray.length > 0) {
					var filteredIncMidrail = includeMidrail.filter(function (item) {
						return item.w == filteredArray[0].width && item.h == filteredArray[0].height && item.red;

					});

					if (filteredIncMidrail.length > 0) {
						incMidrail = true;
						productOptions.find('.inc-midrail-alert').show();
					}
				}
			}
			if (!incMidrail) {
				productOptions.find('.inc-midrail-alert').hide();
			}
		}

    });


    $('body').on('change', '.product-inc-midrail', function () {
        $(this).parents('tr').prev().find('.product-qty').trigger('change');
    });

    /* Midrails On change Event => Calculator */
    $('body').on('change', '.midrail-options', function () {

        var midrail = $(this).parents('.midrail-options-row');
        var midrailOption = midrail.next();
        var midrailIndex = findIndexById(midrail);


        var qty = Number(midrail.find('.midrail-qty').val());
        var secDigFibr = midrail.find('.midrail-sec-dg-fibr').val();
        var winDoor = midrail.find('.midrail-win-door').val(); //Is Always Window or empty for midrails
        var midrailType = midrail.find('.midrail-type').val();
        var height = Number(midrail.find('.midrail-height').val());
        var width = Number(midrail.find('.midrail-width').val());


        //var midrailMatrixTable = $('table[data-table="' + midrailType + '"]');
        var matrixArr = $('input[data-name="' + midrailType + '"]').val();

        if (matrixArr && winDoor && secDigFibr) {
            matrixArr = JSON.parse(matrixArr);
        } else {
            matrixArr = null;
        }


        /****** Calculates Powder Coatings *******/

        // var customColor = 0;
        // var prColor = 0;
        //
        // if (winDoor == 'Window') {
        //     if ($('[name="color1_color"]').val() && $('[name="color1"]').is(':checked')) {
        //         customColor = (qty * Number($('.custom-color-win').text())).toFixed(2);
        //     }
        //     if ($('[name="color2_color"]').val() && $('[name="color2"]').is(':checked')) {
        //         prColor = (qty * Number($('.pr-color-win').text())).toFixed(2);
        //     }
        // }

        /*************************/

        var price = 0;
        if (matrixArr) {
            var filteredArray = matrixArr.filter(function (item) {
                return width <= item.width && height <= item.height;
            });
            if (filteredArray.length > 0) {
                price = Number(filteredArray[0]['price']);
            }
        }


        price = Number(price) * Number(qty);

        var masterMarkup = getMasterMarkupByMatrixTable(midrailType);
        var markedUpPrice = Number(price * (Number(masterMarkup) + Number(100)) / 100).toFixed(2);

        //Sum of price and Colors
        // var totalCostNoMarkup = (Number(price) + Number(customColor) + Number(prColor)).toFixed(2);
        // var totalCost = (Number(customColor) + Number(prColor) + Number(markedUpPrice)).toFixed(2);

        /*************************/


        // switch (midrailType) {
        //     case 'Double Sliding Window':
        //         masterMarkup = $('.dsw-' + markupRole).text();
        //         break;
        //     case 'Inward Opening Escapes [Side & Top Hung]':
        //         masterMarkup = $('.ioe-' + markupRole).text();
        //         break;
        //     case 'Outward Opening Escapes [Side & Top Hung]':
        //         masterMarkup = $('.ooe-' + markupRole).text();
        //         break;
        // }


        midrailsNoMarkup[midrailIndex] = price;
        midrailsTotal[midrailIndex] = markedUpPrice;

        midrailOption.find('.midrail-price-incl-gst').val(midrailsTotal[midrailIndex]);
        calculateMidrailsTotal();

    });


    /* ON Change Powder Coats Checkbox and Dropdowns */
    $('.color_s').on('change', function () {

        $('.product-options-row').each(function (i, el) {
            $(el).find('.product-qty').trigger('change');
        });
        // $('.midrail-options-row').each(function (i, el) {
        //     $(el).find('.midrail-qty').trigger('change');
        // });
    });
    
    $('.coating').on('click', function () {
        $('.coating').prop ('checked', false);
        $(this).prop ('checked', true);  
    });


    /* Calculates Additional Sections Prices */

    $('body').on('change', '.additional-per-meters', function () {
        var additionalRow = $(this).parents('tr');
        var name = additionalRow.find('.additional-name').val();
        var index = findIndexById(additionalRow);

        if (name) {
            var price = additionalRow.find('.additional-name').find(':selected').data('price');
            var meter = additionalRow.find('.additional-meters').val();
            var markup = Number(additionalRow.find('.additional-markup').val());
      
            var totalPrice = Number(price * meter).toFixed(2);
            var markedup = totalPrice * markup / 100;
            var totalCharged = (Number(totalPrice) + Number(markedup)).toFixed(2);      
            additionalRow.find('.additional-total-price').val(totalPrice);
            additionalRow.find('.additional-charged').val(totalCharged);
            
            additionalMeters[index] = totalPrice;
            additionalPerMeter[index] = [totalPrice, markedup, totalCharged];

        } else {
            additionalRow.find('.additional-total-price').val('');
            additionalRow.find('.additional-charged').val('');
            additionalMeters[index] = 0;
            additionalPerMeter[index] = [];
        }
        
        

        calculateAddtionalsTotal();
    });

    
    $('body').on('change', '.cutsheets-additional-section', function () {
        //var selected = $('option:selected', this).attr('class');
        //var optionText = $('.editable').text();    
        var additionalRow = $(this).parents('tr');
        var name = additionalRow.find('.additional-select-name').val();
        var select_name = additionalRow.find('.additional-select-name').attr('name');
        var input_name = additionalRow.find('.additional-input-name').attr('name');
        if (name) {
            if(name == 'Other'){
                additionalRow.find('.additional-input-name').show();
                additionalRow.find('.additional-input-name').focus();
                additionalRow.find('.additional-select-name').attr('name', select_name.replace('section', 'sect_ion'));
                additionalRow.find('.additional-input-name').attr('name', input_name.replace('sect_ion', 'section'));
                
            }else{
                additionalRow.find('.additional-input-name').hide();
                additionalRow.find('.additional-select-name').attr('name', select_name.replace('sect_ion', 'section')); 
                additionalRow.find('.additional-input-name').attr('name', input_name.replace('section', 'sect_ion'));
            }
        }else{
            additionalRow.find('.additional-input-name').hide(); 
            additionalRow.find('.additional-select-name').attr('name', select_name.replace('sect_ion', 'section'));
            additionalRow.find('.additional-input-name').attr('name', input_name.replace('section', 'sect_ion'));            
        }
    });
    
    $('body').on('change', '.cutsheets-additional-colour', function () {
        //var selected = $('option:selected', this).attr('class');
        //var optionText = $('.editable').text();    
        var additionalRow = $(this).parents('tr');
        var name = additionalRow.find('.additional-select-colour').val();
        var select_name = additionalRow.find('.additional-select-colour').attr('name');
        var input_name = additionalRow.find('.additional-input-colour').attr('name');
        if (name) {
            if(name == 'Other'){
                additionalRow.find('.additional-input-colour').show();
                additionalRow.find('.additional-input-colour').focus();
                additionalRow.find('.additional-select-colour').attr('name', select_name.replace('colour', 'col_our'));
                additionalRow.find('.additional-input-colour').attr('name', input_name.replace('col_our', 'colour'));
                
            }else{
                additionalRow.find('.additional-input-colour').hide();
                additionalRow.find('.additional-select-colour').attr('name', select_name.replace('col_our', 'colour')); 
                additionalRow.find('.additional-input-colour').attr('name', input_name.replace('colour', 'col_our'));
            }
        }else{
            additionalRow.find('.additional-input-colour').hide(); 
            additionalRow.find('.additional-select-colour').attr('name', select_name.replace('col_our', 'colour'));
            additionalRow.find('.additional-input-colour').attr('name', input_name.replace('colour', 'col_our'));            
        }
    });
    
    $('body').on('change', '.additional-per-length', function () {
        var additionalRow = $(this).parents('tr');
        var name = additionalRow.find('.additional-name').val();
        var index = findIndexById(additionalRow);

        if (name) {
            var price = additionalRow.find('.additional-name').find(':selected').data('price');
            var length = additionalRow.find('.additional-length').val();
            var markup = Number(additionalRow.find('.additional-markup').val());

            var totalPrice = Number(price * length).toFixed(2);
            var markedup = totalPrice * markup / 100;
            var totalCharged = (Number(totalPrice) + Number(markedup)).toFixed(2); 
            
            additionalRow.find('.additional-total-price').val(totalPrice);
            additionalRow.find('.additional-charged').val(totalCharged);
            additonalLengths[index] = totalPrice;
            
            additionalPerLength[index] = [totalPrice, markedup, totalCharged];
            
        } else {
            additionalRow.find('.additional-total-price').val('');
            additionalRow.find('.additional-charged').val(totalCharged);
            additionalPerLength[index] = [];
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
            var markup = Number(additionalRow.find('.accessory-markup').val());

            var totalPrice = Number(price * each).toFixed(2);
            
            var markedup = totalPrice * markup / 100;
            var totalCharged = (Number(totalPrice) + Number(markedup)).toFixed(2); 
            additionalRow.find('.accessory-total-price').val(totalPrice);
            additionalRow.find('.accessory-charged').val(totalCharged);
            accessories[index] = totalPrice;
			additionalPerEach[index] = [totalPrice, markedup, totalCharged];
        } else {
            additionalRow.find('.accessory-total-price').val('');
            additionalRow.find('.accessory-charged').val('');
            
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
        calculateCustomItemsTotal();

    });


    //* Total Cost Section Inputs On Change *
    $('.markups-percent').on('change', function () {
        var inputId = $(this).attr('id');
        var markupAmount = Number($(this).val());
        var discountPercentage = Number($('input[name=discount]').val());
        //console.log(markupAmount);
        //console.log(discountPercentage);
        
        var secdgfibr = '';
        switch (inputId) {
            case 'ss-markup':
                secdgfibr = '316 S/S';
                break;
            case 'dg-markup':
                secdgfibr = 'D/Grille';
                break;
            case 'fibr-markup':
                secdgfibr = 'Insect';
                break;
            case 'perf-markup':
                secdgfibr = 'Perf';
                break;
        }


        $('.product-sec-dg-fibr').each(function (i, el) {
            if ($(el).val() == secdgfibr) {
                var product = $(el).parents('tr');
                var productOptions = product.next();
                var productIndex = findIndexById(product);
                var priceInclGst = Number(productOptions.find('input.product-price-incl-gst').val()).toFixed(2);
                var newQty = Number(product.find('.product-qty').val());
                if ($('#installation-type-incorporate-install').is(':checked')) {
                    priceInclGst = (Number(priceInclGst) + (Number(calculateIncorporateInstallation(product)) * Number(newQty))).toFixed(2);
                }
                var profit = Number(priceInclGst * Number(markupAmount) / 100).toFixed(2);
                var sellPrice = Number(Number(priceInclGst) + Number(profit)).toFixed(2);
                
                var profitAfterDiscount = profit;
                var sellPriceAfterDiscount = sellPrice;
                                
                if(discountPercentage > 0){
                    var discountPrice = Number(sellPrice * Number(discountPercentage) / 100).toFixed(2);
                    profitAfterDiscount =  Number(profit - discountPrice).toFixed(2);
                    sellPriceAfterDiscount = Number(sellPrice - discountPrice).toFixed(2);
                }
                productOptions.find('input.product-sell-price').val(sellPriceAfterDiscount);
                productOptions.find('input.product-profit').val(profitAfterDiscount);
                markups.addToMarkups(profit, productIndex, secdgfibr, true);
                
               
                /*productOptions.find('input.product-sell-price').val(sellPrice);
                productOptions.find('input.product-profit').val(profit);
                markups.addToMarkups(profit, productIndex, secdgfibr, true);*/

                
            }
            markups._updateMarkups();

        });
    });


    $('#discount').on('change', function (event, param) {
        var percent = Number($(this).val());
        var discountedAmount = (percent * (Number(markups.getTotalMarkups()) + Number(SCREENS_TOTAL)) / 100).toFixed(2);
        $('#discount-amount').val(discountedAmount);
        DISCOUNT = percent;
        DISCOUNT_AMOUNT = discountedAmount;
        calculateProfit();
        calculateTotalSell();        
        
        if(!param){
            updateOrderTablePrice();
        }
    });

    /************************************/
    function updateOrderTablePrice() {
      var discountPercentage = Number($('input[name=discount]').val());
      
      $('.product-sec-dg-fibr').each(function (i, el) {
            var producType = $(el).val();
            if (producType) {
                var markupId = '';
                switch (producType) {
                  case '316 S/S':
                      var markupId = 'ss-markup';
                      break;
                  case 'D/Grille':
                      var markupId = 'dg-markup';
                      break;
                  case 'Insect':
                      var markupId = 'fibr-markup';
                      break;
                  case 'Perf':
                      var markupId = 'perf-markup';
                      break;
                }
                var markupAmount = Number($('#'+markupId).val());

                var product = $(el).parents('tr');
                var productOptions = product.next();
                var productIndex = findIndexById(product);
                var priceInclGst = Number(productOptions.find('input.product-price-incl-gst').val()).toFixed(2);
                //console.log(priceInclGst);
                var newQty = Number(product.find('.product-qty').val());
                if ($('#installation-type-incorporate-install').is(':checked')) {
                    priceInclGst = (Number(priceInclGst) + (Number(calculateIncorporateInstallation(product)) * Number(newQty))).toFixed(2);
                }
                var profit =  0;
                var sellPrice = 0;
                var profitAfterDiscount = 0;
                var sellPriceAfterDiscount = 0;
                
                var profit = Number(priceInclGst * Number(markupAmount) / 100).toFixed(2);
                var sellPrice = Number(Number(priceInclGst) + Number(profit)).toFixed(2);

                var profitAfterDiscount = profit;
                var sellPriceAfterDiscount = sellPrice;
                //alert(discountPercentage); 

                if(discountPercentage > 0){
                    var discountPrice = Number(sellPrice * Number(discountPercentage) / 100).toFixed(2);
                    profitAfterDiscount =  Number(profit - discountPrice).toFixed(2);
                    sellPriceAfterDiscount = Number(sellPrice - discountPrice).toFixed(2);
                }

                productOptions.find('input.product-sell-price').val(sellPriceAfterDiscount);
                productOptions.find('input.product-profit').val(profitAfterDiscount);
            }
        });
        markups._updateMarkups();
    }

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
            $('#sendtoinstaller').val(false);
            /*if (confirm('Send installsheet to installer?')) {
                $('#sendtoinstaller').val(true);
            } else {
                $('#sendtoinstaller').val(false);
            }*/
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
    Insect: [],
    PerfAli: [],


    addToMarkups: function (markup, index, secdgfibr, doesntNeedUpdate) {
        switch (secdgfibr) {
            case '316 S/S':
                this._addToSec(markup, index);
                break;
            case 'D/Grille':
                this._addToDg(markup, index);
                break;
            case 'Insect':
                this._addToFibr(markup, index);
                break;
            case 'Perf':
                this._addToPerf(markup, index);
                break;
            default:
                this.Security[index] = 0;
                this.DGrille[index] = 0;
                this.Insect[index] = 0;
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
        this.Insect[index] = 0;
        this.PerfAli[index] = 0;
    },
    _addToDg: function (markup, index) {
        this.DGrille[index] = markup;
        this.Security[index] = 0;
        this.Insect[index] = 0;
        this.PerfAli[index] = 0;
    },
    _addToFibr: function (markup, index) {
        this.Insect[index] = markup;
        this.Security[index] = 0;
        this.DGrille[index] = 0;
        this.PerfAli[index] = 0;
    },
    _addToPerf: function (markup, index) {
        this.PerfAli[index] = markup;
        this.Security[index] = 0;
        this.DGrille[index] = 0;
        this.Insect[index] = 0;
    },


    deleteFromMarkup: function (secdgfibr, index) {
        switch (secdgfibr) {
            case '316 S/S':
                this._removeFromSec(index);
                break;
            case 'D/Grille':
                this._removeFromDg(index);
                break;
            case 'Insect':
                this._removeFromFibr(index);
                break;
            case 'Perf':
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
        this.Insect[index] = 0;
    },
    _removeFromPerf: function (index) {
        this.PerfAli[index] = 0;
    },

    _updateMarkups: function () {
        var secTotal = (this.Security.reduce(sum, 0)).toFixed(2);
        var dgTotal = (this.DGrille.reduce(sum, 0)).toFixed(2);
        var fibrTotal = (this.Insect.reduce(sum, 0)).toFixed(2);
        var perfTotal = (this.PerfAli.reduce(sum, 0)).toFixed(2);

        $('#ss-markup-amount').val(secTotal);
        $('#dg-markup-amount').val(dgTotal);
        $('#fibr-markup-amount').val(fibrTotal);
        $('#perf-markup-amount').val(perfTotal);

        //console.log('_updateMarkups default');
        $('#discount').trigger('change',[true]);

    },

    getTotalMarkups: function () {
        var secTotal = Number(this.Security.reduce(sum, 0)).toFixed(2);
        var dgTotal = Number(this.DGrille.reduce(sum, 0)).toFixed(2);
        var fibrTotal = Number(this.Insect.reduce(sum, 0)).toFixed(2);
        var perfTotal = Number(this.PerfAli.reduce(sum, 0)).toFixed(2);

        return (Number(secTotal) + Number(dgTotal) + Number(fibrTotal) + Number(perfTotal)).toFixed(2);
    },
};


/** Get markup input ID by these strings => security, d/grille, insect, perf ali **/
function getMarkupInputID(secdgfibr) {
    var selector = null;
    switch (secdgfibr) {
        case '316 S/S':
            selector = 'ss-markup';
            break;
        case 'D/Grille':
            selector = 'dg-markup';
            break;
        case 'Insect':
            selector = 'fibr-markup';
            break;
        case 'Perf':
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


function initializeMatrixTables() {
    var matrix = {};
    $('.price-per-measures').each(function (i, item) {
        //console.log();
        try {
            matrix[$(item).attr('data-name') + ''] = JSON.parse($(item).val());
        } catch (e) {
            console.log(e.message);
        }
    });


    //********* Draw tables ***********//
    for (var obj in matrix) {
        var table = $('.matrix-table').find('[data-table="' + obj + '"]');

        var masterMarkupPercent = getMasterMarkupByMatrixTable(obj);

        var incMidrail = [];
        try {
            incMidrail = JSON.parse($('.midrail-inc[data-table="' + obj + '"]').val());
        } catch (e) {
            console.log(e.message);
        }

        var values = matrix[obj];
        var widths = values.map(function (value) {
            return value.width;
        });

        var heights = values.map(function (value) {
            return value.height;
        });
        widths = removeDublications(widths);
        heights = removeDublications(heights);
        heights.unshift(' ');

        heights.forEach(function (h, index) {
            var tr = $('<tr></tr>');
            var tds = [];
            tds.push($('<td class="measures">' + h + '</td>'));

            widths.forEach(function (w) {
                if (index === 0) {
                    tds.push($('<td class="measures">' + w + '</td>'));
                } else {
                    var item = values.filter(function (obj) {
                        return obj.height === h && obj.width === w;
                    })[0];
                    var redClass = '';
                    if (incMidrail) {
                        var incM = incMidrail.filter(function (obj) {
                            return obj.w === w && obj.h === h;
                        })[0];
                        if (incM) {
                            redClass = 'inc-midrail-red';
                        }
                    }

                    /*************************************/
                    if (item) {
                        var markedUpPrice = Number(item.price * Number(masterMarkupPercent + 100) / 100).toFixed(0);

                        tds.push('<td class="' + redClass + '"><span data-width="' + item.width + '" data-height="' + item.height +
                            '" class="price-field">' + markedUpPrice + '</span></td>');
                    } else {
                        tds.push('<td class="' + redClass + '"><span data-width="' + w + '" data-height="' + h +
                            '" class="price-field" ></span></td>');
                    }
                }

            });
            tds.push($('<td class="measures">' + h + '</td>'));

            tr.append(tds);

            $('[data-table="' + obj + '"]').append(tr);

        });
    }
}


function getMasterMarkupByMatrixTable(tableName) {
    var masterMarkupInput = '';
    switch (tableName) {
        case 'S/S Hinged and Sliding Doors':
            masterMarkupInput = 'sd';
            break;
        case 'S/S Window Screens':
            masterMarkupInput = 'sw';
            break;
        case 'Perf Hinged and Sliding Doors':
            masterMarkupInput = 'pd';
            break;
        case 'Perf Windows':
            masterMarkupInput = 'pw';
            break;
        case 'Double Sliding Window':
            masterMarkupInput = 'dsw';
            break;
        case 'DG Hinged and Sliding Doors':
            masterMarkupInput = 'dd';
            break;
        case 'Insect Hinged and Sliding Doors':
            masterMarkupInput = 'id';
            break;
        case 'DG Windows':
            masterMarkupInput = 'dw';
            break;
        case 'Insect Screens':
            masterMarkupInput = 'iw';
            break;
        case 'Inward Opening Escapes [Side & Top Hung]':
            masterMarkupInput = 'ioe';
            break;
        case 'Outward Opening Escapes [Side & Top Hung]':
            masterMarkupInput = 'ooe';
            break;
    }

    return Number($('.' + masterMarkupInput + '-' + markupRole).text());
}


function removeDublications(arr) {
    var unique = arr.filter(function (elem, index, self) {
        return index == self.indexOf(elem);
    });
    return unique;
}


function initializePartsVariables() {
	partPrice = JSON.parse($('input[data-name="partVariables"]').val());
    
    insectMesh = Number(partPrice.insectMesh.price);//Number($('.mc-list-15').text());
    petMesh = Number(partPrice.petMesh.price);//Number($('.mc-list-16').text());
    spline = Number(partPrice.spline.price);
    splineName =  partPrice.spline.label;
    rollerHinges = Number(partPrice.rollerHinges.price);//Number($('.mc-list-19').text());
        
    sgSSMesh = Number(partPrice.sgSSMesh.price);perfSheetFixingBead = Number(partPrice.perfSheetFixingBead.price);;
    PVCLSeat = Number(partPrice.PVCLSeat.price);
    PVCLSeatName = partPrice.PVCLSeat.label;
    PVCWedge = Number(partPrice.PVCWedge.price);
    PVCWedgeName = partPrice.PVCWedge.label;
       
    
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
    
    
    midrailMarkup = Number($('span.inc-midrail-markup').text());
    midrailCost = Number($('span.inc-midrail-cost').text());
    midrailAmount = Number($('span.inc-midrail-amount').text());

    /** Powder Coatings **/
    singleLock = Number($('.mc-list-1').text());
    tripleLock = Number($('.mc-list-2').text());
    //NEED TO CROSS CHECK HOW LOCK PRICE DEDUCTION WAS IMPLEMENTED @TODO
    singleLockSld = Number(partPrice.singleLockSld.price);
    singleLockHng = Number(partPrice.singleLockHng.price);
    tripleLockSld = Number(partPrice.tripleLockSld.price);
    tripleLockHng = Number(partPrice.tripleLockHng.price);
    
    lockCyl = Number(partPrice.lockCyl.price);
    
    /** Mesh Deduction **/
    securityWindowMesh = Number($('#sw-deduction').text());
    securityDoorMesh = Number($('#sd-deduction').text());
    dgDoorMesh = Number($('#dd-deduction').text());
    dgWindowMesh = Number($('#dw-deduction').text());
    fibrDoorMesh = Number($('#id-deduction').text());
    fibrWindowMesh = Number($('#iw-deduction').text());
    perfDoorMesh = Number($('#pd-deduction').text());
    perfWindowMesh = Number($('#pw-deduction').text());
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

//Not Used
function getHourlyRate(secdgfibr, winDoor) {
    var hourlyRate = 0;

    if (secdgfibr && winDoor) {
        if (secdgfibr == '316 S/S' && winDoor == 'Door') {
            hourlyRate = sdHrlyRate;
        }
        else if (secdgfibr == '316 S/S' && winDoor == 'Window') {
            hourlyRate = swHrlyRate;
        }
        else if (secdgfibr == 'D/Grille' && winDoor == 'Door') {
            hourlyRate = ddHrlyRate;
        }
        else if (secdgfibr == 'D/Grille' && winDoor == 'Window') {
            hourlyRate = dwHrlyRate;
        }
        else if (secdgfibr == 'Insect' && winDoor == 'Door') {
            hourlyRate = fdHrlyRate;
        }
        else if (secdgfibr == 'Insect' && winDoor == 'Window') {
            hourlyRate = fwHrlyRate;
        }
        else if (secdgfibr == 'Perf' && winDoor == 'Door') {
            hourlyRate = pdHrlyRate;
        }
        else if (secdgfibr == 'Perf' && winDoor == 'Window') {
            hourlyRate = pwHrlyRate;
        }
    }
    return hourlyRate;

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
    INCORPORATE_INSTALLATION = Number($('#installation-incorporate-amount').val());
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

        $(el).find('.product-qty').trigger('change', {onEditLoad: true});
        $(el).find('td:last').find('button').css('visibility', 'visible');

    });

    $('.midrail-options-row').each(function (i, el) {

        // if (i > 0) {
        //     midrailsCount++;
        //     var midrailMcTable = midrailMcTableHtml.replace('midrail-mc-0', 'midrail-mc-' + midrailsCount);
        //     var midrailResultTable = midrailResultTableHtml.replace('midrail-result-0', 'midrail-result-' + midrailsCount);
        //     $('#midrails-mc-container').append('<div class="clearfix"></div>');
        //     $('#midrails-mc-container').append(midrailMcTable);
        //     $('#midrails-mc-container').append(midrailResultTable);
        // }

        $(el).find('.midrail-qty').trigger('change');
        //TODO Midrail Type Bug Edit mode
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
        var lockType = $(el).find('.product-lock-type').val();
        var lockHeight = $(el).find('.product-lock-height').val();


        if (!error) {
            if (lockType && !lockHeight) {
                errorMsg += 'Lock handle height is empty. \n';
            }
        }


    });
    // return false;

    error = false;

    // Check if "Covert To Order" Button is Clicked
    if (type == 'order') {
        $('.product-options-row').each(function(i, el) {
            var winDoor = $(el).find('.product-win-door').val();
            if (winDoor == 'Window' ) {//|| !error
                if (!$(el).find('.product-frame-type').val()) {
                    errorMsg += 'You are not allowed to convert to order without having the frame type selected. \n';
                    error = true;
                }
            }
        });

        if (!$('[name="required_date"]').val()) {
            errorMsg += 'Do you want to request a Required Completion Date? \n';
        }
    }


    if (errorMsg) {
        //A title with a text under Pops up
        swal("", errorMsg);
        return false;
    }

    flagSaveBtnClicked = true;
    return true;


}
jQuery(document).ready(function (e) {

    $("#uploadForm").on('submit',(function(e){
            
        e.preventDefault();
        jQuery("#message").empty();
        jQuery('#loading').show();
        var quote_id = jQuery('#hdn_quote_id').val();
        jQuery.ajax({
            url: ajaxurl + "quotes/sendattachment?quote_id=" + quote_id, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(res)   // A function to be called if request succeeds
            {
                res = JSON.parse(res);
                jQuery('#loading').hide();
                if(res.response){                    
                    jQuery("#message").html(res.message);
                }else{
                    jQuery("#message").html(res.message);
                }
            }
        });
        
    }));
    function autoSaveQuote(){
        var myForm = document.getElementById('add-quote-form');
        if(myForm){
            jQuery.ajax({
                url: ajaxurl + "quotes/autosavequote", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data: new FormData(myForm), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(response)   // A function to be called if request succeeds
                {
                    response = JSON.parse(response);
                    if(response.result) {
                        jQuery("#draftid").val(response.id); 
						$('.save-quote-btn, .new-quote-btn').attr("disabled", false);
                    }
                }
            });
        }
    }

    setInterval(function(){
        autoSaveQuote(), $('.save-quote-btn, .new-quote-btn').attr("disabled", true)}, 30000);
    


});

/*************************/
