


$(document).ready(function () {
    $('.roles-dropdown').on('change', function () {
        var role = $(this).val();
        if (role != 'admin' && role != 'supplier' && role != 'manufacturer' && role != 'candidate') {
            $('.allmfs').show();
        } else {
            $('.allmfs').hide();
        }
		if(role == 'distributor' || role == 'manufacturer'){
			$('.system-platform').show();
		}else{
			$('.system-platform').hide();
		}
    });
});