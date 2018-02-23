

$(document).ready(function () {
    
    
    $('.btn-delete').on('click', function () {

        if (confirm('Are you sure?')) {
            var selectId = $(this).parent().prev().find('select').attr('id');


            $('.delete-form [name="id"]').val($('#' + selectId).val());


            $('.delete-form').submit();
        }


    });
    
});