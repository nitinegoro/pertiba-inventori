jQuery(function($) {
	$('#form_add_category').formValidation({
	    icon: {
	        valid: 'fa fa-ok',
	        invalid: 'fa fa-remove',
	        validating: 'fa fa-refresh'
	    },
	});

	$('.modal-delete-item').click( function() {
        var data_id = $(this).data('id');
        var data_content = $(this).data('category');
        $('#modal-item-delete-one').modal('show');
        $('a#button-delete').attr('href', base_url + '/inventori/delete_item/' + data_id);
		return false;
	});


	// delete category
    $('.modal-category-delete').click( function() {
        var data_id = $(this).data('id');
        var data_content = $(this).data('category');
        $('#modal-delete').modal('show');
        $('a#button-delete').attr('href', base_url + '/inventori/delete_category/' + data_id);
    });


    // delete all condition
    $('.open-condition-delete-all').click( function() {
    	if( $('input[type=checkbox]').is(':checked') != '' ) {
    		$('#modal-delete-condition-all').modal('show');
    	}
    	return false;
    });

    // delete condition
    $('.open-condition-delete').click( function() {
        var data_id = $(this).data('id');
        $('#modal-delete-condition').modal('show');
        $('a#button-delete').attr('href', base_url + '/inventori/delete_condition/' + data_id);
    });

    //$('#modal-id').modal('show');
});