
$(document).ready(function () {


    $('.add-to-exising-list').on('click', function () {

        $('[name="new"]').val('');
        $(this).parents('form').submit();

    });

    $('.add-new').on('click', function () {
        $('[name="new"]').val(true);
        $(this).parents('form').submit();
    });

});