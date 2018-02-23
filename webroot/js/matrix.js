var list = [];

$(document).ready(function () {

    var widths = $('.widths').val();
    var heights = $('.heights').val();

    var matrix = $('.measures').val() || '[]';

    var incMidrail = $('.inc-midrail').val() || '[]';

    matrix = JSON.parse(matrix);
    widths = JSON.parse(widths);
    heights = JSON.parse(heights);
    heights.unshift(' ');


    //NEW
    incMidrail = JSON.parse(incMidrail);
    /*****/


    //Draw Matrix Table
    heights.forEach(function (h, index) {

        var tr = $('<tr></tr>');
        var tds = [];
        tds.push($('<td class="measures">' + h + '</td>'));

        widths.forEach(function (w) {
            if (index == 0) {
                tds.push($('<td class="measures">' + w + '</td>'));
            } else {
                var item = matrix.filter(function (obj) {
                    return obj.height == h && obj.width == w;
                })[0];

                var redClass = '';
                var incM = incMidrail.filter(function (obj) {
                    return obj.h == h && obj.w == w && obj.red == true;
                });
                if (incM.length > 0) {
                    redClass = 'inc-midrail-red';
                }

                if (item) {
                    tds.push('<td class="' + redClass + '"><input data-width="' + item.width + '" data-height="' + item.height +
                        '" class="price-field" type="text" value="' + item.price + '"></td>');
                } else {
                    tds.push('<td class="' + redClass + '"><input data-width="' + w + '" data-height="' + h +
                        '" class="price-field" type="text" ></td>');
                }
            }

        });
        tds.push($('<td class="measures">' + h + '</td>'));

        tr.append(tds);

        $('#table').append(tr);

    });


    /****** Save values *******/
    $('.update-values-btn').on('click', function () {
        var form = $(this).parent('form');
        var data = [];


        $('#table').find('input.price-field').each(function (i, item) {
            var width = $(item).data('width');
            var height = $(item).data('height');
            var price = $(item).val();


            var obj = {
                width: width,
                height: height,
                price: price
            };

            data.push(obj);

        });


        data = JSON.stringify(data);
        $('#data').val(data);
        form.submit();
    });


    $('.price-field ').on('focus', function () {
        highlightMeasures(this, true)
    });

    $('.price-field').on('focusout', function () {
        highlightMeasures(this, false)
    });


    //Import from an Array:
    var arrIndex = 0;
    $('.import-btn').on('click', function () {
        $('.matrix-table').find('td').each(function (i, item) {
            if (!$(item).hasClass('measures')) {
                $(item).find('input.price-field').val(Math.round(a[arrIndex]));
                arrIndex++;
            }
        })
    });
});


function highlightMeasures(input, highlight) {
    var w = $(input).data('width');
    var h = $(input).data('height');

    var wTd, hTd;
    $('table.matrix-table').find('tr:first').find('td').each(function (i, item) {
        if ($(item).text() == w) {
            wTd = $(item);
        }
    });
    $('.matrix-table').find('tr').find('td:first').each(function (i, item) {
        if ($(item).text() == h) {
            hTd = $(item);
        }
    });
    if (highlight) {
        wTd.addClass('td-highlited');
        hTd.addClass('td-highlited');
    } else {
        wTd.removeClass('td-highlited');
        hTd.removeClass('td-highlited');
    }

}


function a() {

    list = [];
    var finalH = 1600;
    var finalW = 2100;


    var hstart = 1600;
    var wstart = 2100;

    while (hstart <= 2500) {
        while (wstart <= 3000) {
            list.push(
                {
                    w: wstart,
                    h: hstart,
                    red: true
                }
            );
            wstart += 100;
        }
        hstart += 100;
        wstart = finalW;
        wstart -= 100;
        finalW = wstart;
    }

}












