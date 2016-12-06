jQuery(function($) {
	$('#form_add_category').formValidation({
	    icon: {
	        valid: 'fa fa-ok',
	        invalid: 'fa fa-remove',
	        validating: 'fa fa-refresh'
	    },
	});
    $('.modal-category-delete').click( function() {
        var data_id = $(this).data('id');
        var data_content = $(this).data('category');
        $('#modal-delete').modal('show');
        $('a#button-delete').attr('href', base_url + '/inventori/delete_category/' + data_id);
    });


});